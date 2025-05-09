<?php

namespace App\Observers;

use App\Models\HomeworkSubmission;
use App\Models\HomeworkQuestion;
use App\Models\StudentHomeworkResult;

class HomeworkSubmissionObserver
{
    /**
     * Handle the HomeworkSubmission "created" event.
     */
    public function created(HomeworkSubmission $homeworkSubmission): void
    {
        //
    }

    /**
     * Handle the HomeworkSubmission "updated" event.
     */
    public function updated(HomeworkSubmission $submission)
    {
        // Agar topshiriq qabul qilingan bo'lsa
        if ($submission->is_accepted) {
            // Foydalanuvchi javoblarini olish
            $answers = is_array($submission->answers) ? $submission->answers : json_decode($submission->answers, true);

            if (!is_array($answers)) {
                throw new \Exception("Answers JSON formatida emas yoki noto'g'ri.");
            }

            // Savolni olish
            $homeworkQuestion = HomeworkQuestion::where('homework_id', $submission->homework_id)->first();

            if (!$homeworkQuestion) {
                throw new \Exception("Homework question topilmadi.");
            }

            // To'g'ri javoblarni olish
            $correctAnswers = is_array($homeworkQuestion->correct_answers)
                ? $homeworkQuestion->correct_answers
                : json_decode($homeworkQuestion->correct_answers, true);

            if (!is_array($correctAnswers)) {
                throw new \Exception("Homework question correct_answers JSON formatida noto'g'ri.");
            }

            // Savollarni taqqoslash
            $totalQuestions = count($correctAnswers);
            $correctCount = 0;
            $incorrectAnswers = [];

            foreach ($answers as $key => $userAnswer) {
                if (!isset($correctAnswers[$key])) {
                    continue;
                }

                if ($this->compareAnswers($userAnswer, $correctAnswers[$key])) {
                    $correctCount++;
                } else {
                    $incorrectAnswers[] = [
                        'question' => $key,
                        'user_answer' => $userAnswer,
                        'correct_answer' => $correctAnswers[$key] ?? ''
                    ];
                }
            }

            // Ballni hisoblash
            $score = ($correctCount / max($totalQuestions, 1)) * 100;

            // Natijani saqlash
            StudentHomeworkResult::create([
                'student_id' => $submission->student_id,
                'homework_id' => $submission->homework_id,
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctCount,
                'score' => round($score),
                'incorrect_answers' => $incorrectAnswers
            ]);
        }
    }
    private function compareAnswers($userAnswer, $correctAnswer)
    {
        return trim(strtolower($userAnswer)) === trim(strtolower($correctAnswer));
    }


    /**
     * Handle the HomeworkSubmission "deleted" event.
     */
    public function deleted(HomeworkSubmission $homeworkSubmission): void
    {
        //
    }

    /**
     * Handle the HomeworkSubmission "restored" event.
     */
    public function restored(HomeworkSubmission $homeworkSubmission): void
    {
        //
    }

    /**
     * Handle the HomeworkSubmission "force deleted" event.
     */
    public function forceDeleted(HomeworkSubmission $homeworkSubmission): void
    {
        //
    }
}
