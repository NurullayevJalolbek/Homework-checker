@extends('layouts.app')

@section('title')
Homework
@endsection

@section('activePage')
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb p-2 rounded text-white" style="background-color: #1E1E2E;">
        <li class="breadcrumb-item">
            <a href="{{ route('students.homework.index') }}" class="text-white text-decoration-none">
                <i class="fas fa-home"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            <a href="{{route('admin.students.index')}}" class="text-white text-decoration-none">
                Students
            </a>
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
                        @php

                        $data = $datas->toArray()['data'];

                        @endphp
                        <form method="POST" action="{{ route('admin.export.students-results') }}">
                            @csrf
                            <input type="hidden" name="data" value="{{ json_encode($data) }}">

                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <button type="submit" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-download"></i> Excel
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th width="20">№</th>
                                <th>Student username</th>
                                <th>Student email</th>
                                <th>Penalty points</th>
                                <th width="90">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($datas->isEmpty())
                            @include('layouts.noData')
                            @else
                            @foreach ($datas as $index => $data)
                            <tr id="tr_{{ $data->id }}">
                                <td>{{ $datas->perPage() * ($datas->currentPage() - 1) + $loop->iteration }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->penalty_points ?? '' }}</td>
                                <td align="center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.students.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-warning text-white" data-toggle="modal" id="editButton">
                                            <i class="feather-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection