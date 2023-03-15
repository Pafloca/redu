@extends('layouts/plantilla')
@section('titulo', 'AstonBirras-Admin')
@section('contenido')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-2 col-3"></div>

        <div class="card mt-4 bg-dark text-light border border-danger col-lg-2 col-5" style="width: 25rem;">
            <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: 30px">{{ $user->name }}</h5>
            </div>
        </div>

        <div class="card mt-4 ml-5 bg-dark text-light border border-danger col-lg-8 col-11" style="width: 45rem;">
            <h1 class="text-center mt-3">PERFIL</h1>

            <div class="card mt-4 bg-dark text-light border border-primary">
                <div class="card-body">
                    <h5 class="card-title text-center">Nombre: {{ $user->name }}</h5>
                </div>
            </div>

            <div class="card mt-4 bg-dark text-light border border-primary">
                <div class="card-body">
                    <h5 class="card-title text-center">Email: {{ $user->email }}</h5>
                </div>
            </div>

            <div class="card mt-4 mb-4 bg-dark text-light border border-primary">
                <div class="card-body">
                    <h5 class="card-title text-center">Rol: Admin</h5>
                </div>
            </div>
        </div>

        <div class="my-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link class="btn btn-danger" :href="route('logout')"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                       style="margin-left: 45%;">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>




    </div>

</div>
@endsection
