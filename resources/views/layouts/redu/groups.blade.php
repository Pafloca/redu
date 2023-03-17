@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <div class="container-fluid">
        <div class="row text-center p-5">

            <h1 class="text-light">My Groups</h1>
            @foreach($groups as $group)
                <div class="card text-white bg-black col-xl-3 m-xl-5 col-lg-5 m-lg-4 col-md-5 m-md-4">
                    <a href="/groups/{{ $group->id }}" style="text-decoration: none; color: white">
                        @if(file_exists(public_path("img/$group->id-group.jpg")))
                            <img src="{{ asset("/img/$group->id-group.jpg") }}" class="card-img-top mt-2" alt="menu">
                        @else
                            <img src="{{ asset("/img/imgPred.png") }}" class="card-img-top mt-2" alt="menu">
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">{{ $group->name }}</h3>
                            <h4 class="card-text">{{ $group->acronym }}</h4>
                            <h6 class="card-text">Created By: {{ \App\Models\User::findOrFail($group->user_teacher_id)->name }}</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->rol === 'teacher')
        <div class="col text-center mb-5">
            <a href="{{ route('groups.create') }}">
                <button class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
            </a>
        </div>
    @endif
@endsection
