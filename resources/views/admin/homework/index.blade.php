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
                Homeworks
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
                            <h3 class="page-title">Homeworks</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <!-- <a href="#" class="btn btn-outline-primary me-2">
                                <i class="fas fa-download"></i> Excel
                            </a> -->
                            <a href="{{route('admin.homework.create')}}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i></a>
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
                                <th>№</th>
                                <th>Task condition</th>
                                <th>Exercises</th>
                                <th>Exercises type</th>
                                <th>Due date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($datas->isEmpty())
                            @include('layouts.noData')
                            @else

                            @foreach($datas as $data)
                            <tr id="tr_{{ $data->id }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td>{{ $datas->perPage() * ($datas->currentPage() - 1) + $loop->iteration }}</td>
                                <td>{{ $data->task_condition ?? null }}</td>
                                <td>{{ $data->exercise_id ?? 'null' }}</td>
                                <td>{{ $data->type->name ?? 'null' }}</td>
                                <td>{{ $data->due_date ?? 'null' }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <div class="btn-group">
                                        <a href="{{ route('admin.homework.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-warning text-white" data-toggle="modal" id="editButton">
                                            <i class="feather-edit"></i> Edit
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.homework.destroy', $data->id) }}" method="POST" style="display:inline;">
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
                            </tr>
                        </tbody>
                    </table>

                </div>
                @endif
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Content will be loaded here...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection