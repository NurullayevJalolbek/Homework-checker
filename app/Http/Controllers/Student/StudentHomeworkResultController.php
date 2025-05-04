<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentHomeworkResultController extends Controller
{
    public function index(){
        return view('students.homework-results.index');
    }
}
