<?php

namespace App\Interface\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminHomeworkQuestionStoreRequest;

interface AdminHomeworkQuestionInterface
{
    public function index();
    public function create();
    public function processImage(Request $request);
    public function generateCorrectAnswers(Request $request);
    public function store(AdminHomeworkQuestionStoreRequest $request);
    public function destroy($id);
    // public function edit($id);
    // public function update(Request $request, $id);
}