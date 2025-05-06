<?php

namespace App\Interface\Admin;
use App\Http\Requests\Admin\AdminHomeworkRequest;

interface AdminHomeworkInterface
{
    public function index();
    public function create();
    public function store(AdminHomeworkRequest $request);
    public function destroy($id);
    public function edit($id); 
    public function update (AdminHomeworkRequest $request, $id);
}