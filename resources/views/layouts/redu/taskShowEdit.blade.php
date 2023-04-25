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
                    <h3>End of the Task:</h3>
                    <p>{{$task->date_end}}</p>
                </div>
                <p>From: {{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</p>
            </div>
            <?php
            $today = new DateTime("now");
            $dateTask =new DateTime($task->date_end);
            $datee = null;
            if($today < $dateTask){
                $datee = false;
            } else {
                $datee = true;
            }
            ?>
            <div class="card mt-4 ml-5 bg-dark text-light border border-danger col-lg-8 col-11 mb-4" style="width: 45rem;">
                <section class="get-in-touch">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">Edit the Task</h5>
                    <form class="contact-form row" action="{{ route('taskAlumn.update', $taskAlumn->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-field col-lg-12">
                            <input class="input-text js-input" name="title" value="{{$taskAlumn->name}}" type="text" @if($taskAlumn->mark || $datee) disabled @endif required>
                            <label class="label">Title</label>
                        </div>
                        <div class="form-field col-lg-12">
                            <textarea class="input-text js-input" name="description" required rows="4" cols="50" @if($taskAlumn->mark || $datee) disabled @endif>{{ $taskAlumn->description }}</textarea>
                            <label class="label">Description</label>
                        </div>
                        <div class="form-field col-lg-6">
                            <label class="label">Image</label>
                            <input class="form-control input-text js-input seleccionar" name='foto' type="file" @if($taskAlumn->mark || $datee) disabled @endif />
                        </div>
                        <div class="form-field col-lg-6">
                            <input class="submit-btn" type="submit" @if($taskAlumn->mark || $datee) disabled @endif value="Edit">
                        </div>
                    </form>
                    </div>
                    <h5 class="text-center">FeedBack:</h5>
                    <div class="border border-primary mb-2 p-2">
                        <h6>Mark: @if($taskAlumn->mark) {{$taskAlumn->mark}} @else Not Corrected  @endif</h6>
                    </div>
                    <div class="border border-primary p-2">
                        <h6>Teacher:</h6>
                        <p>{{$taskAlumn->feedback}}</p>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection
