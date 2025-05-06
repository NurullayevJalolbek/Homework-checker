<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminHomeworkService;

use App\Http\Requests\Admin\AdminHomeworkRequest;
class AdminHomeworkController extends Controller
{
    protected $adminHomeworkService;
    public function __construct(AdminHomeworkService $adminHomeworkService){
        $this->adminHomeworkService = $adminHomeworkService;
    }
    public function index(){
        return $this->adminHomeworkService->index();
    }

    public function create(){
        return $this->adminHomeworkService->create();
    }

    public function store(AdminHomeworkRequest $request){
        return $this->adminHomeworkService->store($request);
    }

    public function destroy($id){
     return $this->adminHomeworkService->destroy($id);   
    }

    public function edit($id){
        return $this->adminHomeworkService->edit($id);
    }
    public function update(AdminHomeworkRequest $request, $id){
        return $this->adminHomeworkService->update($request, $id);
    }
}
