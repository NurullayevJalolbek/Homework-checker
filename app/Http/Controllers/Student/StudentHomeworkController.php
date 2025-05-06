<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Student\StudentHomeworkService;

class StudentHomeworkController extends Controller
{
    protected $studentHomeworkService;

    public function __construct( StudentHomeworkService $studentHomeworkService)
    {
        $this->studentHomeworkService = $studentHomeworkService;
        
    }
    public function index(){
        return $this->studentHomeworkService->index();
    }
}
