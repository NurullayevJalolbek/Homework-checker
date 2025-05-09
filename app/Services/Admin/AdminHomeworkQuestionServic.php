<?php

namespace App\Services\Admin;

use App\Interface\Admin\AdminHomeworkQuestionInterface;
use App\Traits\Crud;
use App\Models\HomeworkQuestion;
use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\Homework;
use Illuminate\Support\Facades\Http;

use App\Http\Requests\Admin\AdminHomeworkQuestionStoreRequest;

class AdminHomeworkQuestionServic implements AdminHomeworkQuestionInterface
{
    use Crud;
    protected string $modelClass = HomeworkQuestion::class;


    public function index()
    {
        $datas = $this->modelClass::query()->with('homework')->orderByDesc('id')->paginate();

        return view('admin.homework-questions.index', compact('datas'));
    }

    public function create()
    {
        $homeworks = Homework::all();
        return view('admin.homework-questions.create', compact('homeworks'));
    }

    public function processImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10480',
        ]);

        $lastNumber = (int) $request->input('last_number', 0);

        $image = $request->file('image');
        $tempPath = $image->getRealPath();

        $ocr = new TesseractOCR($tempPath);
        $text = $ocr->lang('eng')->psm(6)->run();

        $formattedText = $this->parseOcrText($text, $lastNumber);
        return response()->json([
            'success' => true,
            'text' => implode("\n", $formattedText),
        ]);
    }

    private function parseOcrText($text, $lastNumber = 0)
    {
        $lines = explode("\n", $text);
        $formattedText = [];
        $counter = $lastNumber + 1;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (preg_match('/^\d+[\.\)\-]/', $line)) {
                $formattedText[] = ucfirst($line);
                continue;
            }

            if (preg_match('/^[A-D][\)\.\-]/', $line)) {
                $formattedText[] = $line;
                continue;
            }

            $line = "{$counter}. " . ucfirst(preg_replace('/\d+\.$/', '', $line));
            $counter++;

            if (!preg_match('/[.?]$/', $line)) {
                $line .= '.';
            }

            $formattedText[] = $line;
        }

        return $formattedText;
    }

    public function generateCorrectAnswers(Request $request)
    {
        $request->validate([
            'homework_id' => 'required',
            'questions' => 'required',
        ]);

        $homework = Homework::find($request->input('homework_id'));

        if (!$homework) {
            return response()->json([
                'success' => false,
                'message' => 'Homework topilmadi',
            ]);
        }
        $taskCondition = $homework->task_condition;
        $question = $request->input('questions');

        $answerPrompt = "Please answer the following question strictly based on the provided homework condition without any additional information or context. 
                    Your answer should be concise, clear, and to the point. No extra explanations or details.
                    Homework condition: \"$taskCondition\"
                    Question: \"$question\"
                    Your answer should be concise and only provide the correct response, no extra explanations.";

        $tipPrompt = "Provide a brief and clear tip related to the following question in both Uzbek and English languages. 
                    Your tip should be simple, clear, and concise. Avoid unnecessary details. 
                    Question: \"$question\"
                    Your response should be a JSON object with two keys: 'uz' for the Uzbek tip and 'en' for the English tip. 
                    Each tip should not exceed 3 words. Example format: {\"uz\":\"Faoliyatni belgilash\", \"en\":\"Identify the action\"}.";



        $apiKey = env('OPENROUTER_API_KEY');
        $url =  "https://openrouter.ai/api/v1/chat/completions";

        // $apiKey = env('GEMINI_API_KEY');
        // $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent?key=$apiKey";

        $answerResponse = Http::withHeaders([
            'Authorization' => "Bearer $apiKey", 
            'Content-Type' => 'application/json',
        ])->post($url, [
            'model' => "deepseek/deepseek-r1-distill-llama-70b:free",
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $answerPrompt,  
                ]
            ]
        ]);

        $tipResponse = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",  
            'Content-Type' => 'application/json',
        ])->post($url, [
            "model" => "deepseek/deepseek-r1:free",
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $tipPrompt,  
                ]
            ]
        ]);

        // $answerResponse = Http::withOptions([
        //     'Content-Type' => 'application/json',
        //     'verify' => false,
        // ])->post($url, [
        //     "contents" => [["parts" => [["text" => $answerPrompt]]]]
        // ]);

        // $tipResponse = Http::withOptions([
        //     'Content-Type' => 'application/json',
        //     'verify' => false,
        // ])->post($url, [
        //     "contents" => [["parts" => [["text" => $tipPrompt]]]]
        // ]);

        $answerData = $answerResponse->json();
        $tipData = $tipResponse->json();




        $answer = $answerData['choices'][0]['message']['content'] ? $answerData['choices'][0]['message']['content'] : 'No answer generated.';
        $tipJson = $tipData['choices'][0]['message']['content'] ? $tipData['choices'][0]['message']['content'] : '{"uz":"", "en":""}';

        // $answer = $answerData['candidates'][0]['content']['parts'][0]['text'] ?? 'No answer generated.';
        // $tipJson = $tipData['candidates'][0]['content']['parts'][0]['text'] ?? '{"uz":"", "en":""}';

        $tip = json_decode($tipJson, true);
        $uzTip = $tip['uz'] ?? '';

        $firstTemplate = explode("\n", $answer)[0] ?? '';

        return response()->json([
            'correct_answers' => trim($answer),
            'tip' => $uzTip,
            'answer_template' => trim($firstTemplate)
        ]);
    }


    public function store(AdminHomeworkQuestionStoreRequest $request)
    {
        $questionsArray = explode("\n", trim($request->questions));
        $answersArray = explode("\n", trim($request->correct_answers));

        $formattedQuestions = [];
        $formattedAnswers = [];


        foreach ($questionsArray as $index => $question) {
            $taskKey = "Task " . ($index + 1) . ":";
            $formattedQuestions[$taskKey] = trim($question);
        }

        foreach ($answersArray as $index => $answer) {
            $taskKey = "Task " . ($index + 1) . ":";
            $formattedAnswers[$taskKey] = trim($answer);
        }

        $tip = $request->tip ? $request->tip : null;
        $answerTemplate = $request->answer_template ? $request->answer_template : null;

        if ($request->tip && $tip === null) {
            return redirect()->back()->with('error', "Tip noto'g'ri JSON formatda.");
        }

        if ($request->answer_template && $answerTemplate === null) {
            return redirect()->back()->with('error', "Answer Template noto'g'ri JSON formatda.");
        }

       $response =  HomeworkQuestion::create([
            'homework_id' => $request->homework_id,
            'questions' => $formattedQuestions,
            'correct_answers' => $formattedAnswers,
            'tip' => $tip,
            'answer_template' => $answerTemplate,
        ]);

        if (!$response) {
            return redirect()->back()->with('error', 'Homework questions not saved successfully!');
        }else{
            return redirect()->back()->with('success', 'Homework questions saved successfully!');
        }

    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $this->customDelete($id);
        return redirect()->route('admin.homework-questions.index')->with('success', 'Homework Question successfully deleted!');
    }
}
