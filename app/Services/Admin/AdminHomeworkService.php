<?php

namespace App\Services\Admin;

use App\Interface\Admin\AdminHomeworkInterface;
use App\Models\Homework;
use App\Models\HomeworkType;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\Admin\AdminHomeworkRequest;
use App\Traits\Crud;

class AdminHomeworkService implements AdminHomeworkInterface
{

    use Crud;

    protected string $modelClass = Homework::class;

    public function index()
    {
        $datas = $this->modelClass::with(['subject', 'type'])
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.homework.index', [
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();
        $homeworkTypes = HomeworkType::all();
        $model = Homework::class;

        return view('admin.homework.create', compact('users', 'subjects', 'homeworkTypes', 'model'));
    }

    public function store(AdminHomeworkRequest $request)
    {
        $response = $this->customStore($request);

        return redirect()->route('admin.homework.index')->with('success', 'Homework successfully created!');
    }
    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $this->customDelete($id);

        return redirect()->route('admin.homework.index')->with('success', 'Homework successfully deleted!');
    }
    public function edit($id)
    {
        $homework = $this->modelClass::findOrFail($id);
        $subjects = Subject::all();
        $homeworkTypes = HomeworkType::all();
        return view('admin.homework.edit', compact('homework', 'subjects', 'homeworkTypes'));
    }

    public function update(AdminHomeworkRequest $request, $id){
        
        $this->customUpdate($id, $request);

        return redirect()->route('admin.homework.index')->with('success', 'Homework successfully updated!');
    }

}
