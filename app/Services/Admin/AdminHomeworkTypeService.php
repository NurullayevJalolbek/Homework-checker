<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\AdminHomeworkTypeStoreRequest;
use App\Interface\Admin\AdminHomeworkTypeInterface;
use App\Models\HomeworkType;
use App\Traits\Crud;

class AdminHomeworkTypeService implements AdminHomeworkTypeInterface
{

    use Crud;

    protected string $modelClass = HomeworkType::class;


    public function index()
    {
        $datas = $this->modelClass::query()->orderByDesc('id')->paginate();
        return view('admin.homework-types.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.homework-types.create');
    }

    public function store(AdminHomeworkTypeStoreRequest $request)
    {
        $result = $this->customStore($request);
        return redirect()->route('admin.homework-types.index')->with('success', 'Homework Type successfully created!');
    }

    public function edit($id)
    {
        $homework_type = $this->modelClass::findOrFail($id);
        return view('admin.homework-types.edit', compact('homework_type'));
    }

    public function update(AdminHomeworkTypeStoreRequest $request, $id)
    {
        $result = $this->customUpdate($id, $request);
        return redirect()->route('admin.homework-types.index')->with('success', 'Homework Type successfully updated!');
    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $this->customDelete($id);
        return redirect()->route('admin.homework-types.index')->with('success', 'Homework Type successfully deleted!');
    }
}
