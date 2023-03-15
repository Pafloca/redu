@extends('layouts/plantilla')
@section('titulo', 'AstonBirras-Admin')
@section('contenido')
    <section class="get-in-touch">
        <h1 class="title text-light text-center">Crear nuevo día disponible</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable text-center">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endforeach
        @endif
        <form class="contact-form row" action="{{ route('disponibles.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-field col-lg-12 col">
                <input id="date" class="input-text js-input" type="date" name="fecha" value="{!! old('fecha') !!}">
                <label class="label" for="date">Fecha</label>
            </div>
            <div class="form-field col-lg-6 ">
                <label class="label" for="time">Horario</label>
                <input id="time" class="input-text js-input" type="time" name="horaIni" value="14:00">
            </div>
            <div class="form-field col-lg-6 ">
                <input id="time" class="input-text js-input" type="time" name="horaFin" value="16:00" required>
            </div>
            <div class="form-field col-lg-6 ">
                <input id="pladis" class="input-text js-input" type="number" name="plazas" value="30" required>
                <label class="label" for="pladis">Plazas Disponibles</label>
            </div>
            <div class="form-field col-lg-6 ">
                <input id="overbooking" class="input-text js-input" name="overbooking" type="number" value="5" required>
                <label class="label" for="overbooking">Overbooking</label>
            </div>

            <div class="form-field col-lg-6">
                <label class="label" for="overbooking">Prof. Cocina</label>
                <select name="profesCoc[]" id="field1" multiple
                        onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))"
                        multiselect-hide-x="true" required>
                    @foreach($profCoc as $profe)
                        <option value="{{ $profe->id }}">{{ $profe->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field col-lg-6">
                <label class="label" for="overbooking">Prof. Sala</label>
                <select name="profesSala[]" id="field1" multiple
                        onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))"
                        multiselect-hide-x="true" required>
                    @foreach($profSala as $profe)
                        <option value="{{ $profe->id }}">{{ $profe->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field col-lg-6">
                <label class="label" for="menu">Menú</label>
                <input class="form-control input-text js-input seleccionar" name='foto' type="file" />
            </div>
            <div class="form-field col-lg-6">
                <input id="espera" class="input-text js-input" type="number" name="espera" value="0" required>
                <label class="label" for="espera">Lista de espera</label>
            </div>
            <div class="form-field col-lg-6">
                <input class="submit-btn" type="submit" value="Crear">
            </div>
        </form>
    </section>
@endsection
