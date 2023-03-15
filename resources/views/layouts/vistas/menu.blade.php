@extends('layouts/plantilla')
@section('titulo', 'AstonBirras-Admin')
@section('contenido')
    <div class="container-fluid">
        <div class="row text-center p-5">

            <h1 class="text-light">Días Disponibles</h1>
@foreach($servicios as $servicio)
            <div class="card text-white bg-black col-xl-3 m-xl-5 col-lg-5 m-lg-4 col-md-5 m-md-4">
                <a href="/disponibles/{{ $servicio->id }}" style="text-decoration: none; color: white">
                    @if(file_exists(public_path("img/$servicio->id-menu.jpg")))
                        <img src="{{ asset("/img/$servicio->id-menu.jpg") }}" class="card-img-top mt-2" alt="menu">
                    @else
                        <img src="{{ asset("/img/imgPred.png") }}" class="card-img-top mt-2" alt="menu">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $servicio->fecha }}</h5>
                        <p class="card-text">de {{ $servicio->horariIni }} a {{ $servicio->horariFin }} h.</p>
                        <h6 class="card-text">Plazas Disponibles: {{ $servicio->places }}</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-black border-top text-white">Overbooking: {{ $servicio->overbooking }}</li>
                        <li class="list-group-item bg-black border-top text-white">Lista de espera: {{ $servicio->llistaEspera }}</li>
                        <li class="list-group-item bg-black border-top text-white">Prof. sala: {{ count($servicio->profesoresSala) }}</li>
                        <li class="list-group-item bg-black border-top text-white">Prof. cocina: {{ count($servicio->profesoresCoc) }}</li>
                    </ul>
                </a>
            </div>
            @endforeach
            <div>
                {{ $servicios->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
@endsection
