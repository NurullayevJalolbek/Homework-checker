<?php 

namespace App\Services\Student;
use App\Http\Controllers\Controller;
use App\Models\HomeworkQuestion;
use App\Models\User;
use App\Traits\Scopes;
use Illuminate\Http\Request;
use App\Interface\Student\StudentHomeworkInterface;


class StudentHomeworkService implements StudentHomeworkInterface
{
    use Scopes;

    protected string $modelClass = HomeworkQuestion::class;

    public function index()
    {
        request()->merge(['student_id' => Auth()->id()]);
        $datas = $this->modelClass::with(['homework.homeworkSubmission'])
            ->when(request('due_date') === 'future', function ($query) {
                $query->whereHas('homework', function ($homeworkQuery) {
                    $homeworkQuery->where('due_date', '>', formatDateTime(now()));
                });
            })
            ->whereHasEqual('homework', 'exercise_id')
            ->orderByDesc('id')
            ->paginate();
            
        return view('students.homework.index', [
            'datas' => $datas,
        ]);
    }
}