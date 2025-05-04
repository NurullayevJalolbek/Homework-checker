<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentVocabularyPracticeController extends Controller
{
    public function index(){
        return view('students.vocabulary-practise.index');
    }
}
