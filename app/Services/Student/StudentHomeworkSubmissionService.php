<?php

namespace App\Services\Student;

use App\Interface\Student\StudentHomeworkSubmissionInterface;
use App\Models\HomeworkSubmission;
use App\Traits\Crud;
use App\Traits\Scopes;
use App\Models\HomeworkQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentHomeworkSubmissionService implements StudentHomeworkSubmissionInterface
{
    use Crud, Scopes;

    protected string $modelClass = HomeworkSubmission::class;

    public function  index()
    {
        $datas = $this->modelClass::query()
            ->where("student_id", Auth::user()->id)
            ->when(request('due_date') === 'future', function ($query) {
                $query->whereHas('homework', function ($homeworkQuery) {
                    $homeworkQuery->where('due_date', '>', now());
                });
            })
            ->whereHasEqual('homework', 'exercise_id')
            ->orderByDesc('id')
            ->paginate();
        return view('students.homework-submissions.index', [
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $questions = HomeworkQuestion::query()
            ->with(['homework.homeworkTypes'])
            ->whereEqual('homework_id')
            ->whereHas('homework', function ($query) {
                $query->where('due_date', '>', now()->format('Y-m-d H:i:s'));
            })
            ->whereHas('homework', function ($query) {
                $query->whereDoesntHave('homeworkSubmission', function ($q) {
                    $q->where('student_id', auth()->id());
                });
            })
            ->get();

        return view('students.homework-submissions.create', compact('questions'));
    }

    public function store(Request $request)
    {


        $questionAnswer = $request->input('answers');

        if (empty($questionAnswer)) {
            return redirect()->back()->with('error', 'Javoblar kiritilmagan');
        }

        $homeworkQuestions = HomeworkQuestion::whereIn('homework_id', array_keys($questionAnswer))->get()->groupBy('homework_id');

        foreach ($questionAnswer as $homeworkId => $answers) {
            if (empty($answers) || !isset($homeworkQuestions[$homeworkId])) {
                continue;
            }
            $submission = HomeworkSubmission::create([
                'student_id' => Auth::id(),
                'homework_id' => $homeworkId,
                'answers' => $answers
            ]);

        }
        return redirect()->route('students.homework-submissions.index');




        return $this->customStore($request);
    }

    public function accept($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->is_accepted = true;
        $model->status = 'accepted';
        $model->save();


        return redirect()->back()->with('success', 'Updated successfully');
    }


    // protected function updateSubmission(HomeworkSubmission $submission, $homeworkQuestions)
    // {
    //     $existingAnswers = is_array($submission->answers) ? $submission->answers : json_decode($submission->answers, true) ?? [];

    //     $newAnswers = request()?->input('answers', []);

    //     foreach ($homeworkQuestions as $question) {
    //         $taskName = $question->task_name;

    //         if (isset($newAnswers[$taskName])) {
    //             $existingAnswers[$taskName] = $newAnswers[$taskName];
    //         }
    //     }

    //     $submission->update([
    //         'answers' => $existingAnswers
    //     ]);
    // }
}
