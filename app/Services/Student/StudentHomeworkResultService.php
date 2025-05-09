<?php
namespace App\Services\Student;

use App\Interface\Student\StudentHomeworkResultInterface;
use App\Models\StudentHomeworkResult;
class StudentHomeworkResultService implements StudentHomeworkResultInterface
{
    protected string $modelClass = StudentHomeworkResult::class;

    public function index()
    {
        $datas = $this->modelClass::query()
        ->with('homework')
        ->where('student_id' , auth()->user()->id)
        ->when(request('due_date') === 'future', function ($query) {
            $query->whereHas('homework', function ($homeworkQuery) {
                $homeworkQuery->where('due_date', '>', now());
            });
        })
        ->whereHasEqual('homework', 'exercise_id')
        ->orderByDesc('id')->paginate();
      


        return view('students.homework-results.index', compact('datas'));
    }
}