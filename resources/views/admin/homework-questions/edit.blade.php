@extends('layouts.app')

@section('title')
Homework Create
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
                Question Update
            </a>
        </li>
    </ol>
</nav>
@endsection
@dd($question->toArray());
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.homework.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="form-title"><span>Homework Question Update</span></h5>
                        <a href="{{ route('admin.homework-questions.index') }}" class="btn btn-primary" style="height: 40px;">Orqaga</a>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exercise_id" class="form-label">Exercise number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="exercise_id" id="exercise_id" value="{{$question->exercise_id}}">
                                @error('exercise_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="task_condition" class="form-label">Task condition <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="task_condition" value="{{$question->task_condition}}">
                                @error('task_condition')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="due_date_input" class="form-label">Due date</label>
                                <div class="input-group">
                                    <input type="datetime-local" name="due_date" class="form-control" id="due_date_input" value="{{$question->due_date}}">
                                    <button type="button" class="btn btn-primary" id="set_due_date">Set 2 days from now</button>
                                </div>
                                @error('due_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="student-submit text-end mt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div> <!-- .row -->
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dueDateInput = document.getElementById('due_date_input');
        const setDueDateBtn = document.getElementById('set_due_date');

        setDueDateBtn.addEventListener('click', function() {
            const now = new Date();

            now.setDate(now.getDate() + 2);

            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            dueDateInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        });
    });
</script>
@endsection