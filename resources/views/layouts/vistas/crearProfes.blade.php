@extends('layouts/plantilla')
@section('titulo', 'AstonBirras-Admin')
@section('contenido')
    <section class="get-in-touch">
        <h1 class="title text-light text-center">Añadir Profesor</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable text-center">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endforeach
        @endif
        <form class="contact-form row" action="{{ route('profesores.store') }}" method="POST" novalidate>
            @csrf
            <div class="form-field col-12">
                <input id="nombre" class="input-text js-input" name="nombre" type="text" value="{!! old('nombre') !!}">
                <label class="label" for="nombre">Nombre</label>
            </div>
            <div class="form-field col-12">
                <input id="email" class="input-text js-input" name="email" type="email" value="{!! old('email') !!}">
                <label class="label" for="email">Email</label>
            </div>
            <div class="form-field col-12">
                <p class="label">Tipo</p>
                <select class="form-select" name="tipo" aria-label="Default select example">
                    <option value="" selected>--- Seleccione tipo ---</option>
                    <option value="cocina">Cocina</option>
                    <option value="sala">Sala</option>
                </select>
            </div>

            <div class="form-field col-lg-6">
                <input class="submit-btn" type="submit" value="Crear">
            </div>
        </form>
    </section>
@endsection
