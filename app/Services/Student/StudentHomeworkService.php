<?php 

namespace App\Services\Student;
use App\Interface\Student\StudentHomeworkInterface;

class StudentHomeworkService implements StudentHomeworkInterface
{
    public function index()
    {
        return view('students.homework.index');
    }
}