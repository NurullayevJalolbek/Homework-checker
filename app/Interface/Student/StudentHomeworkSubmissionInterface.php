<?php
namespace App\Interface\Student;

use Illuminate\Http\Request;

interface StudentHomeworkSubmissionInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function accept($id);

    
}