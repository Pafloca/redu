@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="card text-white bg-black mb-5 mt-5" style="max-width: 90%; margin-left: 5%">
        <div class="row g-0">
            <div class="col-md-4">
                @if(file_exists(public_path("img/$group->id-group.jpg")))
                    <img src="{{ asset("/img/$group->id-group.jpg") }}" class="img-fluid rounded-start" alt="menu">
                @else
                    <img src="{{ asset("/img/imgPred.png") }}" class="img-fluid rounded-start" alt="menu">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title float-left">{{ $group->name }}</h4>
                    <h4 class="card-title float-right">{{ $group->acronym }}</h4>
                    <br><br>
                    <h5 class="card-text">Created by: {{ \App\Models\User::findOrFail($group->user_teacher_id)->name }}</h5>
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
                    <div>
                    <h4>Teachers & Alumns</h4>
                    <div class="form-field mb-4">
                        <label class="label" for="overbooking">Authorized teachers</label><br>
                        <select name="profesCoc" id="field1" required>
                            <option value="" selected>-- teachers --</option>
                            @foreach($arrayTeacher as $profe)
                                <option value="{{ $profe->id }}">{{ $profe->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-field mb-4">
                        <label class="label" for="overbooking">Authorized alumns</label><br>
                        <select name="profesCoc" id="field1" onchange="handleSelect(this)" required>
                            <option value="" selected>-- alumns --</option>
                            @foreach($arrayAlumn as $alumn)
                                <option value="{{ $alumn->id }}">{{ $alumn->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col text-right">
                                <a href="{{ route('groups.edit', $group->id) }}">
                                    <button class="btn btn-success">
                                        Edit
                                    </button>
                                </a>
                            </div>
                            <div class="col text-left">
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col text-left">
                        <p><b>Invite people:</b> http://127.0.0.1:8000/groupsInvite/{{$group->id}}</p>
                    </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center text-white mb-4">Tasks</h1>
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
            <div class="col text-center mb-5">
                <form action="{{ route('tasks.create') }}" method="GET">
                    <input type="hidden" name="group" value="{{ $group->id }}">
                    <button class="btn btn-success">
                        Create Task
                    </button>
                </form>
            </div>
        @endif
        <table class="table table-dark table-striped table-responsive-md text-center">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Teacher</th>
                <th scope="col">Acctions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</td>
                <td>
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('tasks.show', $task->id) }}">
                                        <button class="btn btn-success">
                                            View
                                        </button>
                                    </a>
                                </div>
                                <div class="col text-left">
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        @if(in_array($task->id, $usersRealiced))
                                <?php
                                    $tasks = \App\Models\TaskAlumn::where("user_alumn_id", "=", \Illuminate\Support\Facades\Auth::id())->where("task_id", "=",$task->id)->get();
                                    $idTask = null;
                                    foreach ($tasks as $taske) {
                                        $idTask = $taske->id;
                                    }
                                    ?>
                            <a href="{{ route('taskAlumn.edit', $idTask)}}">
                                <button class="btn btn-success">
                                    Realized
                                </button>
                            </a>
                        @else
                            <a href="{{ route('tasks.show', $task->id) }}">
                                <button class="btn btn-warning">
                                    Make
                                </button>
                            </a>
                        @endif
                    @endif
                </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <th class="text-white text-left" colspan="4">Total Tasks: {{ count($tasks) }}</th>
            </tfoot>
        </table>
    </div>
@endsection
