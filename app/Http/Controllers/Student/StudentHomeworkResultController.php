<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Student\StudentHomeworkResultService;

class StudentHomeworkResultController extends Controller
{
    protected $studentHomeworkResultService;

    public function __construct(StudentHomeworkResultService $studentHomeworkResultService){
        $this->studentHomeworkResultService = $studentHomeworkResultService;
    }
    public function index(){
        return $this->studentHomeworkResultService->index();
    }
}
