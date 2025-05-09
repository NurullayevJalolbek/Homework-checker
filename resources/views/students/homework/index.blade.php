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
                                <td>
                                    @if (is_array($data->questions))
                                    @foreach ($data->questions as $task => $question)
                                    <strong>{{ $task }}</strong>: {{ $question }} <br>
                                    @endforeach
                                    @else
                                    {{ htmlspecialchars($data->questions) }}
                                    @endif
                                </td>
                                <td>{{ $data->homework->task_condition }}</td>
                                <td>{{ $data->homework->due_date }}</td>
                                <td>
                                    @if (
                                    $data->homework->homeworkSubmission->filter(fn($submission) => $submission->homework_id == $data->id)->isNotEmpty() &&
                                    $data->homework->due_date < now()
                                        )
                                        <a href="#"
                                        title="Let's go! Do this shit" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        @endif

                                        @if (
                                        !isset($data->homework->homeworkSubmission) ||
                                        $data->homework->homeworkSubmission->filter(fn($submission) => $submission->homework_id == $data->id && $submission->student_id == auth()->user()->id)->isEmpty())
                                        <a href="{{ route('students.homework-submissions.create', ['id' => $data->id]) }}"
   title="Yechish" class="btn btn-xs btn-success">
   Yechish
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