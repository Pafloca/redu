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
                <section class="get-in-touch">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">Edit the Task</h5>
                    <form class="contact-form row" action="{{ route('taskAlumn.update', $taskAlumn->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-field col-lg-12">
                            <input id="overbooking" class="input-text js-input" name="title" value="{{$taskAlumn->title}}" type="text" required>
                            <label class="label" for="overbooking">Title</label>
                        </div>
                        <div class="form-field col-lg-12">
                            <textarea id="overbooking" class="input-text js-input" name="description" required rows="4" cols="50">{{ $taskAlumn->description }}</textarea>
                            <label class="label" for="overbooking">Description</label>
                        </div>
                        <div class="form-field col-lg-6">
                            <label class="label" for="menu">Image</label>
                            <input class="form-control input-text js-input seleccionar" name='foto' type="file" />
                        </div>
                        <div class="form-field col-lg-6">
                            <input class="submit-btn" type="submit" value="Edit">
                        </div>
                    </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
