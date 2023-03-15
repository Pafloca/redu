@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <section class="get-in-touch">
        <h1 class="title text-light text-center">Create Task</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable text-center">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endforeach
        @endif
        <form class="contact-form row" action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <input name="group_id" value="{{$_GET["group"]}}" type="hidden">
            <div class="form-field col-lg-12">
                <input id="overbooking" class="input-text js-input" name="title" type="text" required>
                <label class="label" for="overbooking">Title of Task</label>
            </div>
            <div class="form-field col-lg-12">
                <textarea id="overbooking" class="input-text js-input" name="description" required rows="4" cols="50"></textarea>
                <label class="label" for="overbooking">Desription</label>
            </div>
            <div class="form-field col-lg-6">
                <input class="submit-btn" type="submit" value="Create">
            </div>
        </form>
    </section>
@endsection
