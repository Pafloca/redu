@extends('layouts/plantilla')
@section('titulo', 'AstonBirras-Admin')
@section('contenido')
<div class="card text-white bg-black mb-5 mt-5" style="max-width: 90%; margin-left: 5%">
    <div class="row g-0">
        <div class="col-md-4">
            @if(file_exists(public_path("img/$servicio->id-menu.jpg")))
                <img src="{{ asset("/img/$servicio->id-menu.jpg") }}" class="img-fluid rounded-start" alt="menu">
            @else
                <img src="{{ asset("/img/imgPred.png") }}" class="img-fluid rounded-start" alt="menu">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h4 class="card-title float-left">Menú del día {{ $servicio->fecha }}</h4>
                <h6 class="card-title float-right">de {{ $servicio->horariIni }} h a {{ $servicio->horariFin }} h.</h6>
                <br><br>
                <h5 class="card-text">Plazas Disponibles: {{ $servicio->places }}</h5>
                <ul class="list-group list-group-flush mt-5 menuList">
                    <li class="list-group-item bg-black border-top border-bottom my-xl-2 text-white">Overbooking: {{ $servicio->overbooking }}</li>
                    <li class="list-group-item bg-black border-top border-bottom my-xl-2 text-white">Lista de espera: {{ $servicio->llistaEspera }}</li>
                    <li class="list-group-item bg-black border-top border-bottom my-xl-2 text-white">
                        <div class="float-left">Prof. sala: {{ count($arrayProfesSala) }}</div>
                        <div class="float-center">
                    <ul class="listProf">
                        @foreach($arrayProfesSala as $profeSala)
                            <li>{{ $profeSala->nombre }}</li>
                        @endforeach
                    </ul>
                        </div>
                    </li>
                    <li class="list-group-item bg-black border-top border-bottom mt-xl-2 mb-4 text-white">
                        <div class="float-left">Prof. cocina: {{ count($arrayProfesCoc) }}</div>
                        <div class="float-center">
                            <ul class="listProf">
                                @foreach($arrayProfesCoc as $profeCoc)
                                    <li>{{ $profeCoc->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col text-right">
                            <a href="{{ route('disponibles.edit', $servicio->id) }}">
                                <button class="btn btn-success">
                                    Editar
                                </button>
                            </a>
                        </div>
                        <div class="col text-left">
                            <form action="{{ route('disponibles.destroy', $servicio->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="text-center text-white">Lista de reservas</h1>
<table class="table table-dark table-striped table-responsive-md text-center">
    <thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Telefono</th>
        <th scope="col">Comensales</th>
        <th scope="col">Comentario</th>
        <th scope="col">Suscripción</th>
        <th scope="col">Alergias</th>
        <th scope="col">Aceptar</th>
    </tr>
    </thead>
    <tbody>
@foreach($reservas as $reserva)
    <tr>
        <td>{{ $reserva->nombre }}</td>
        <td>{{ $reserva->email }}</td>
        <td>{{ $reserva->telefono }}</td>
        <td>{{ $reserva->comensales }}</td>
        <td>{{ $reserva->comentario }}</td>
        <td><input type="checkbox" disabled  @if($reserva->subscripcio) checked @endif><label></label></td>
        <td>
            @if(count($reserva->alergenos) != 0)
            @foreach($reserva->alergenos as $alergeno)
                {{ $alergeno->nombre }}
            @endforeach
            @else
                No tiene alergenos
            @endif
        </td>
        <td>
            @if($reserva->confirmada == 0)
                <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </button>
                </form>
            @else
                <button class="btn btn-light" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </button>
            @endif
        </td>
    </tr>
@endforeach
    </tbody>
    <tfoot>
    <th class="text-white text-left" colspan="2">Total reservas: {{ count($reservas) }}</th>
    <th class="text-white text-left" colspan="4">Plazas restantes: {{ $servicio->places - $comensales + $servicio->overbooking }}</th>
    <th class="text-white text-left">Aceptadas: {{ count($reservasAceptadas) }}</th>
    </tfoot>
</table>
</div>
@endsection
