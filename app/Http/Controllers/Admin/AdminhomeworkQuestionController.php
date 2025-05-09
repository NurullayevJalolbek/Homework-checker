<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminHomeworkQuestionServic;
use App\Http\Requests\Admin\AdminHomeworkQuestionStoreRequest;

class AdminhomeworkQuestionController extends Controller
{
    protected $adminHomeworkQuestionService;

    public function __construct(AdminHomeworkQuestionServic $adminHomeworkQuestionService){
        $this->adminHomeworkQuestionService = $adminHomeworkQuestionService;
    }
    public function index(){
        return $this->adminHomeworkQuestionService->index();
    }

    public function create(){
        return $this->adminHomeworkQuestionService->create();
    }

    public function processImage(Request $request){
        return $this->adminHomeworkQuestionService->processImage($request);
    }

    public function generateCorrectAnswers(Request $request){
        return $this->adminHomeworkQuestionService->generateCorrectAnswers($request);
    }

    public function store(AdminHomeworkQuestionStoreRequest $request){
        return $this->adminHomeworkQuestionService->store($request);
    }

    // public function edit($id){
    //     return $this->adminHomeworkQuestionService->edit($id);
    // }


    public function destroy($id){
        return $this->adminHomeworkQuestionService->destroy($id);
    }
   
}
