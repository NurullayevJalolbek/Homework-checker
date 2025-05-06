<?php
namespace App\Services\Student;

use App\Interface\Student\StudentHomeworkResultInterface;

class StudentHomeworkResultService implements StudentHomeworkResultInterface
{
    public function index()
    {
        return view('students.homework-results.index');
    }
}