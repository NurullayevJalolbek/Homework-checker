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
            <a href="{{route('admin.homework-types.index')}}" class="text-white text-decoration-none">
                Homework Types 
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            <a href="{{ url()->current() }}" class="text-white text-decoration-none">
                create
            </a>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">

    <div class="card border-dark mb-3">
        <div class="card-body">
            <form method="post" action="{{route('admin.homework-types.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="penalty_points" class="form-label">Homework type create</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{route('admin.homework-types.index')}}" class="btn btn-warning">Назад</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection