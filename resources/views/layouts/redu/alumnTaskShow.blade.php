@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="card text-white bg-black m-5">
        <div class="card-body">
            <h2 class="card-title text-center"><u>Task from {{ \App\Models\User::findOrFail($task->user_alumn_id)->name }}</u></h2>
            <h3 class="card-title">{{ $task->title }}</h3>
            <p class="card-text">{{ $task->description }}</p>
        </div>
        @if(file_exists(public_path("taskImg/$task->id-task.jpg")))
            <img src="{{ asset("/taskImg/$task->id-task.jpg") }}" class="img-fluid rounded-start m-2" alt="menu">
        @else
            <img src="{{ asset("/img/imgPred.png") }}" class="img-fluid rounded-start m-2" alt="menu">
        @endif
    </div>
@endsection
