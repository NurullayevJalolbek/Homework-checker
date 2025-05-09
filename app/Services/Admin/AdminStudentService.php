<?php
namespace App\Services\Admin;

use App\Interface\Admin\AdminStudentInterface;
use App\Traits\Crud;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminStudentExport;

class AdminStudentService implements AdminStudentInterface
{
    use Crud;
    protected string $modelClass = User::class;


    public function  index(){
        $datas = $this->modelClass::query()->paginate();

        return view('admin.students.index', compact('datas'));
    }

    public function edit($id)
    {
        $user = $this->modelClass::findOrFail($id);

        return view('admin.students.edit', compact('user'));
    }


    public function update(Request $request, $id){
        $response = $this->customUpdate($id, $request);

        return redirect()->route('admin.students.index')->with('success', 'Student successfully updated!');
    }

    public function export (Request $request){
        
        $data = json_decode($request->input('data'), true); 

        return Excel::download(new AdminStudentExport($data), 'students.xlsx');

    }
}