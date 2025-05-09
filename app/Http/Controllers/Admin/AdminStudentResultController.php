<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminStudentResultService;
class AdminStudentResultController extends Controller
{
    protected $studentResultService;

    public function __construct(AdminStudentResultService $studentResultService)
    {
        $this-> studentResultService = $studentResultService;
    }

    public function index(){
        return $this-> studentResultService->index();
    }
}
