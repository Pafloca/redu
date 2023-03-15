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
                        <select name="profesCoc[]" id="field1" multiple
                                onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))"
                                multiselect-hide-x="true" required>
                            @foreach($arrayTeacher as $profe)
                                <option value="{{ $profe->id }}" selected>{{ $profe->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-field mb-4">
                        <label class="label" for="overbooking">Authorized alumns</label><br>
                        <select name="profesCoc[]" id="field1" multiple
                                onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))"
                                multiselect-hide-x="true" required>
                            @foreach($arrayAlumn as $alumn)
                                <option value="{{ $alumn->id }}" selected>{{ $alumn->name }}</option>
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
                        <p><b>Invite people:</b> http://localhost/groupsInvite/{{$group->id}}</p>
                    </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center text-white">Tasks</h1>
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
            <div class="col text-center mb-5">
                <a href="{{ route('groups.create') }}">
                    <button class="btn btn-success">
                        Create Task
                    </button>
                </a>
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
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</td>
                <td>
                    <a href="{{ route('groups.edit', $task->id) }}">
                        <button class="btn btn-success">
                            View
                        </button>
                    </a>
                    <a href="{{ route('groups.edit', $task->id) }}">
                        <button class="btn btn-warning">
                            Edit
                        </button>
                    </a>
                    <a href="{{ route('groups.edit', $task->id) }}">
                        <button class="btn btn-danger">
                            Delete
                        </button>
                    </a>
                </td>
            @endforeach
            </tbody>
            <tfoot>
            <th class="text-white text-left" colspan="1">Total reservas:</th>
            <th class="text-white text-left" colspan="1">Plazas restantes:</th>
            <th class="text-white text-left">Aceptadas: </th>
            </tfoot>
        </table>
    </div>
@endsection
