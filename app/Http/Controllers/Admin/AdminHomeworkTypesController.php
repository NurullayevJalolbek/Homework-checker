<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminHomeworkTypeService;
use App\Http\Requests\Admin\AdminHomeworkTypeStoreRequest;

class AdminHomeworkTypesController extends Controller
{
    protected $homeworkTypeService;

    public function __construct(AdminHomeworkTypeService $homeworkTypeService)
    {
        $this->homeworkTypeService = $homeworkTypeService;
    }
    public function index(){
        return $this->homeworkTypeService->index();
    }

    public function create(){
        return $this->homeworkTypeService->create();
    }

    public function store(AdminHomeworkTypeStoreRequest $request){
        return $this->homeworkTypeService->store($request);
    }

    public function edit($id){
        return $this->homeworkTypeService->edit($id);
    }

    public function update(AdminHomeworkTypeStoreRequest $request, $id){
        return $this->homeworkTypeService->update($request, $id);
    }

    public function destroy($id){
        return $this->homeworkTypeService->destroy($id);
    }
}
