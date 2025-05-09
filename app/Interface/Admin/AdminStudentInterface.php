<?php
namespace App\Interface\Admin;
use Illuminate\Http\Request;
interface AdminStudentInterface
{
    public function index ();
    public function edit ($id);
    public function update(Request $request, $id);

}