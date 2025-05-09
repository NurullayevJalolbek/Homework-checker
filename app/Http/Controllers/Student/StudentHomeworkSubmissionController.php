<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Student\StudentHomeworkSubmissionService;
class StudentHomeworkSubmissionController extends Controller
{
    protected $homeworkSubmissionService;

    public function __construct(StudentHomeworkSubmissionService $homeworkSubmissionService){
        $this->homeworkSubmissionService = $homeworkSubmissionService;
    }
    public function index (){
        return $this->homeworkSubmissionService->index();
    }

    public function create(){
        return $this->homeworkSubmissionService->create();
    }

    public function store(Request $request){
        return $this->homeworkSubmissionService->store($request);
    }

    public function accept($id){
        return $this->homeworkSubmissionService->accept($id);
    }
}
