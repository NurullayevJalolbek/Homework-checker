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
                Students  results
            </a>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="panel-body">
        <div class="table-responsive kv-grid-container">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="20">№</th>
                        <th>Student</th>
                        <th>Correct answers</th>
                        <th>Incorrect answers</th>
                        <th>Due date</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($datas->isEmpty())
                        @include('layouts.noData')
                    @else
                    @foreach ($datas as $data)
                    <tr id="tr_{{ $data->id }}">
                        <td>{{ $datas->perPage() * ($datas->currentPage() - 1) + $loop->iteration }}</td>
                        <td>{{ $data->student->username ?? 'Unknown' }}</td>
                        <td>{{ $data->correct_answers ?? 'null' }}</td>
                        <td>
                            {{ is_array($data->incorrect_answers)
                            ? count($data->incorrect_answers)
                            : 0 }}
                            ta xato javob
                        </td>

                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection