@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="container">
        <h1 class="text-center text-white mb-4">Tasks from {{ $user->name }}</h1>
        <table class="table table-dark table-striped table-responsive-md text-center">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Teacher</th>
                <th scope="col">End Date</th>
                <th scope="col">Acctions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $taskMade = 0;
            ?>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</td>
                    <td>{{ $task->date_end }}</td>
                    <td>
                            @if(in_array($task->id, $usersRealiced))
                                    <?php
                                    $tasks2 = \App\Models\TaskAlumn::where("student_id", "=", $user->id)->where("task_id", "=",$task->id)->get();
                                    $idTask = null;
                                    foreach ($tasks2 as $taske) {
                                        $idTask = $taske->id;
                                    }
                                    $taskMade++;
                                    ?>
                                <a href="{{ route('taskAlumn.show', $idTask)}}">
                                    <button class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                        </svg>
                                    </button>
                                </a>
                            @else
                                    <button class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                    </button>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <th class="text-white text-left" colspan="4">Total Tasks: {{ count($tasks) }}</th>
            <th class="text-white text-left" colspan="1">Made: {{ $taskMade }}</th>
            </tfoot>
        </table>
    </div>
@endsection
