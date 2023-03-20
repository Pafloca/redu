@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="container-fluid">
        <div class="row">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable text-center">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endforeach
            @endif
            <div class="card text-white bg-black m-3 col-8">
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
            <div class="card text-white bg-black m-3 col">
                <div class="card-body">
                    <h2 class="card-title text-center"><u>Feedback</u></h2>

                    <form class="contact-form row" action="{{ '/updateNote/' . $task->id }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-field col-lg-12 ">
                            <h3 class="card-title">Mark: </h3>
                            <input class="input-text js-input" name="note" type="number" value="{{ $task->mark }}" max="5" min="0" required>
                        </div>
                        <div class="form-field col-lg-12 ">
                            <h3 class="card-title">Description:</h3>
                            <textarea class="input-text js-input" name="desc" type="text" required>{{ $task->feedback }}</textarea>
                        </div>
                        <div class="form-field col-lg-6">
                            <input class="submit-btn" type="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
