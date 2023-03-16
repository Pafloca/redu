@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <section class="get-in-touch">
        <h1 class="title text-light text-center">Edit Group</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable text-center">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endforeach
        @endif
        <form class="contact-form row" action="{{ route('groups.update', $group->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="form-field col-lg-6 ">
                <input id="overbooking" class="input-text js-input" name="name" value="{{ $group->name }}" type="text" required>
                <label class="label" for="overbooking">Name of Group</label>
            </div>
            <div class="form-field col-lg-6 ">
                <input id="overbooking" class="input-text js-input" name="acronym" value="{{ $group->acronym }}" type="text" required>
                <label class="label" for="overbooking">Acronym</label>
            </div>
            <div class="form-field col-lg-6">
                <label class="label" for="menu">Image of Group</label>
                <input class="form-control input-text js-input seleccionar" name='foto' type="file" />
            </div>
            <div class="form-field col-lg-6">
                <input class="submit-btn" type="submit" value="Edit">
            </div>
        </form>
    </section>
@endsection
