<?php

namespace App\Services\Admin;

use App\Interface\Admin\AdminStudentResultInterface;

use App\Models\StudentHomeworkResult;
use Illuminate\Http\Request;

class AdminStudentResultService implements AdminStudentResultInterface
{
    public $modelClass = StudentHomeworkResult::class;

    public function index()
    {

        $datas = $this->modelClass::selectRaw('
        student_id,
        DATE(created_at) as submission_date,
        COUNT(*) as total_submissions,
        ANY_VALUE(id) as id,
        ANY_VALUE(homework_id) as homework_id,
        ANY_VALUE(score) as score,
        ANY_VALUE(correct_answers) as correct_answers,
        ANY_VALUE(incorrect_answers) as incorrect_answers,
        ANY_VALUE(created_at) as created_at
    ')
            ->with('student')
            ->groupBy('student_id', 'submission_date')
            ->orderByDesc('submission_date')
            ->paginate();


        return view('admin.student-results.index', compact('datas'));
    }

}
