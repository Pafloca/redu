@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable text-center">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endforeach
    @endif
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-2 col-3"></div>

            <div class="card mt-4 bg-dark text-light border border-danger col-lg-2 col-5 mb-4" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">{{$task->title}}</h5>
                    <h4>Description:</h4>
                    <p>{{$task->description}}</p>
                </div>
                <p>From: {{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</p>
            </div>

            <div class="card mt-4 ml-5 bg-dark text-light border border-danger col-lg-8 col-11 mb-4" style="width: 45rem;">
                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'alumn')
                <section class="get-in-touch">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">Make the Task</h5>
                    <form class="contact-form row" action="{{ route('taskAlumn.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input name="task_id" value="{{ $task->id }}" type="hidden">
                        <div class="form-field col-lg-12">
                            <input id="overbooking" class="input-text js-input" name="title" type="text" required>
                            <label class="label" for="overbooking">Title</label>
                        </div>
                        <div class="form-field col-lg-12">
                            <textarea id="overbooking" class="input-text js-input" name="description" required rows="4" cols="50"></textarea>
                            <label class="label" for="overbooking">Description</label>
                        </div>
                        <div class="form-field col-lg-6">
                            <label class="label" for="menu">Image</label>
                            <input class="form-control input-text js-input seleccionar" name='foto' type="file" />
                        </div>
                        <div class="form-field col-lg-6">
                            <input class="submit-btn" type="submit" value="Create">
                        </div>
                    </form>
                    </div>
                </section>
                @else
                    <section class="get-in-touch">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="font-size: 30px">Edit the Task</h5>
                            <form class="contact-form row" action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-field col-lg-12">
                                    <input id="overbooking" class="input-text js-input" name="title" value="{{ $task->title }}" type="text" required>
                                    <label class="label" for="overbooking">Title of Task</label>
                                </div>
                                <div class="form-field col-lg-12">
                                    <textarea id="overbooking" class="input-text js-input" name="description" required rows="4" cols="50">{{ $task->description }}</textarea>
                                    <label class="label" for="overbooking">Desription</label>
                                </div>
                                <div class="form-field col-lg-6">
                                    <input class="submit-btn" type="submit" value="Edit">
                                </div>
                            </form>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
    <div class="container">
        <h1 class="text-center text-white mb-4">Alumns</h1>
        <table class="table table-dark table-striped table-responsive-md text-center">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Made</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alumns as $alumn)
                <tr>
                    <td>{{ $alumn->name }}</td>
                    <td>{{ $alumn->email }}</td>

                        @if(in_array($alumn->id, $usersRealiced))
                        <td>
                            <button class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </button>
                        </td>
                        <td>
                                <?php
                                    $tasks = \App\Models\TaskAlumn::where("user_alumn_id", "=", $alumn->id)->where("task_id", "=",$task->id)->get();
                                    $idTask = null;
                                    foreach ($tasks as $taske) {
                                        $idTask = $taske->id;
                                    }
                                ?>
                            <a href="{{ route('taskAlumn.show', $idTask) }}">
                                <button class="btn btn-success">
                                    View
                                </button>
                            </a>
                        </td>
                        @else
                        <td>
                            <button class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                </svg>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-success" disabled>
                                View
                            </button>
                        </td>
                        @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <th class="text-white text-left" colspan="2">Total Alumns: {{ count($alumns) }}</th>
            <th class="text-white text-left" colspan="2">Made: {{ count($usersRealiced) }}</th>
            </tfoot>
        </table>
    </div>
    @endif
@endsection
