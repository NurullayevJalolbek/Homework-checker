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
                Homework results
            </a>
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="row">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th width="20">№</th>
                <th>Exercise number</th>
                <th>Question type</th>
                <th>Correct answers count</th>
                <th>Incorrect answers</th>
                <th>Due date</th>
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
                <td>{{ $data->correct_answers ?? '' }}</td>
                <td>
                    @if(is_array($data->incorrect_answers))
                    @foreach($data->incorrect_answers as $item)
                    <strong>{{ $item['question'] }}</strong>:
                    <span style="color: red;">{{ $item['user_answer'] }}</span>
                    <span style="color: green;">(To‘g‘ri javob: {{ $item['correct_answer'] }})</span>
                    <br>
                    @endforeach
                    @else
                    {{ htmlspecialchars($data->incorrect_answers) }}
                    @endif
                </td>
                <td>{{ $data->homework->due_date ?? '' }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


@endsection