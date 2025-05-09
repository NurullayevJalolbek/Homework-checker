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
            <a href="{{ url()->current() }}" class="text-white text-decoration-none">
                Homework submissions
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

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th width="20">№</th>
                                <th>Exercise number</th>
                                <th>Question</th>
                                <th>Question type</th>
                                <th>Due date</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($datas->isEmpty())
                            @include('layouts.noData')
                            @else
                            @foreach ($datas as $index => $data)
                            <tr id="tr_{{ $data->id }}">
                                <td>{{ $datas->perPage() * ($datas->currentPage() - 1) + $loop->iteration }}</td>
                                <td>{{ $data->homework->exercise_id ?? null }}</td>
                                <td>{{ $data->homework->task_condition ?? null }}</td>
                                <td>
                                    @if(is_array($data->answers))
                                    @foreach($data->answers as $task => $answer)
                                    <strong>{{ $task }}</strong>: {{ $answer }} <br>
                                    @endforeach
                                    @else
                                    {{ ($data->$answer ?? '') }}
                                    @endif
                                </td>
                                <td>{{ $data->homework->due_date ?? null }}</td>
                                <td>{{ $data->status ?? null }}</td>
                                <td align="center">
                                    @if($data->is_accepted != true)
                                    <a href="{{ route('students.homework-submissions.accept', ['id' => $data->id]) }}" title="Update"
                                        class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-ok	">Done</span>
                                    </a>
                                    @endif
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