<?php

namespace App\Interface\Admin;

use App\Http\Requests\Admin\AdminHomeworkTypeStoreRequest;
interface AdminHomeworkTypeInterface
{
    public function index();
    public function create();
    public function store(AdminHomeworkTypeStoreRequest $request);
    public function edit($id);
    public function update(AdminHomeworkTypeStoreRequest $request, $id);
    public function destroy($id);
}