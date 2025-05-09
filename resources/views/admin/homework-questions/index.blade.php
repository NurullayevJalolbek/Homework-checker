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
            <a href="{{route('admin.homework.index')}}" class="text-white text-decoration-none">
                Questions
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
                            <h3 class="page-title">Homeworks Questions</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <!-- <a href="#" class="btn btn-outline-primary me-2">
                                <i class="fas fa-download"></i> Excel
                            </a> -->
                            <a href="{{route('admin.homework-questions.create')}}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
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
                                <td>{{ $data->homework->task_condition ?? '' }}</td>
                                <td>
                                    @if(is_array($data->questions))
                                    @foreach($data->questions as $task => $question)
                                    <strong>{{ $task }}</strong> {{ $question }} <br>
                                    @endforeach
                                    @else
                                    {{ htmlspecialchars($data->questions) }}
                                    @endif
                                </td>
                                <td>{{ $data->homework->due_date ?? '' }}</td>
                                <td>
                                    <form action="{{ route('admin.homework-questions.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Haqiqatan ham o‘chirib tashlamoqchimisiz?')"
                                            class="btn btn-danger btn-sm rounded px-3 text-white">
                                            <i class="feather-trash"></i> Delete
                                        </button>
                                    </form>

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