<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentHomeworkSubmissionController extends Controller
{
    public function index (){
        return view('students.homework-submissions.index');
    }
}
