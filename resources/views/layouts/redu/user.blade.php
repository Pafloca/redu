@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="container">
        <h1 class="text-center text-white">Tasks from {{ $user->name }}</h1>
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
