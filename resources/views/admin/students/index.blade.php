@extends('layouts.app')

@section('title')
Homework
@endsection

@section('activePage')
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb p-2 rounded text-white" style="background-color: #1E1E2E;">
        <li class="breadcrumb-item">
            <a href="#" class="text-white text-decoration-none">
                <i class="fas fa-home"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            Students
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Students</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <a href="#" class="btn btn-outline-primary me-2">
                                <i class="fas fa-download"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td>1</td>
                                <td><b>Jalolbek Nurullayev</b></td>
                                <td>jalolbek@example.com</td>
                                <td>+998 90 123 45 67</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning text-white">
                                            <i class="feather-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td>2</td>
                                <td><b>Laylo Karimova</b></td>
                                <td>laylo@example.com</td>
                                <td>+998 91 234 56 78</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning text-white">
                                            <i class="feather-edit"></i>Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td>3</td>
                                <td><b>Azamat Rasulov</b></td>
                                <td>azamat@example.com</td>
                                <td>+998 93 765 43 21</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning text-white">
                                            <i class="feather-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection