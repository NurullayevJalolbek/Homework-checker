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
                            <a href="#" class="btn btn-outline-primary me-2">
                                <i class="fas fa-download"></i> Excel
                            </a>
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
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div style="padding: 20px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                                            class="bi bi-database-fill-slash" viewBox="0 0 16 16">
                                            <path
                                                d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1" />
                                            <path
                                                d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905" />
                                        </svg>
                                        <p class="mt-2" style="font-weight: bold;">No data</p>
                                    </div>
                                </td>
                            </tr>
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