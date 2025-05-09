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
            <a href="{{ route('admin.homework.index') }}" class="text-white text-decoration-none">
                Homeworks
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            <a href="{{ route('admin.homework.index') }}" class="text-white text-decoration-none">
                Edit
            </a>
        </li>
    </ol>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h5 class="form-title"><span>Homework create</span></h5>
                            <a href="{{ route('admin.homework.index') }}" class="btn btn-primary"
                                style="height: 40px;">Orqaga</a>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Select subject <span class="login-danger">*</span></label>
                                <select name="subject_id" class="form-control">
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id', $homework->subject_id ?? '') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Homework type <span class="login-danger">*</span></label>
                                <select name="type_id" class="form-control">
                                    @foreach ($homeworkTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id', $homework->type_id ?? '') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Exercise number <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="exercise_id" id="exercise_id"
                                    value="{{ old('exercise_id', $homework->exercise_id ?? '') }}">
                                @error('exercise_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Task condition<span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="task_condition"
                                    value="{{ old('task_condition', $homework->task_condition ?? '') }}">
                                @error('task_condition')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom: 10px;">
                            <label class="control-label">Due date</label>
                            <div class="input-group">
                                <input type="datetime-local" name="due_date" class="form-control" id="due_date_input"
                                    value="{{ old('due_date', $homework->due_date ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="set_due_date">
                                        Set 2 days from now
                                    </button>
                                </div>
                            </div>
                            @error('due_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
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