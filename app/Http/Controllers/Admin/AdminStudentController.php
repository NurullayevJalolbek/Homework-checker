<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminStudentService;

class AdminStudentController extends Controller
{
    protected $adminStudentService;

    public function __construct(AdminStudentService $studentService)
    {
        $this->adminStudentService = $studentService;
        
    }
    public function index(){
        return $this->adminStudentService->index();
    }

    public function edit($id)
    {
        return $this->adminStudentService->edit($id);
    }
    public function update(Request $request, $id){
        return $this->adminStudentService->update($request, $id);
    }
    public function  export(Request $request){
        return $this->adminStudentService->export($request);
    }
}
