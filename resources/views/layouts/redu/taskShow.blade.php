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

            <div class="card mt-4 bg-dark text-light border border-danger col-lg-2 col-5" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">{{$task->title}}</h5>
                    <h4>Description:</h4>
                    <p>{{$task->description}}</p>
                </div>
                <p>From: {{ \App\Models\User::findOrFail($task->user_teacher_id)->name }}</p>
            </div>

            <div class="card mt-4 ml-5 bg-dark text-light border border-danger col-lg-8 col-11" style="width: 45rem;">
                <section class="get-in-touch">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 30px">Make the Task</h5>
                    <form class="contact-form row" action="{{ route('taskAlumn.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input name="task_id" value="{{ $task->id }}" type="hidden">
                        <div class="form-field col-lg-12">
                            <input id="overbooking" class="input-text js-input" name="title" type="text" required>
                            <label class="label" for="overbooking">Title</label>
                        </div>
                        <div class="form-field col-lg-12">
                            <input id="overbooking" class="input-text js-input" name="description" type="text" required>
                            <label class="label" for="overbooking">Description</label>
                        </div>
                        <div class="form-field col-lg-6">
                            <label class="label" for="menu">Image</label>
                            <input class="form-control input-text js-input seleccionar" name='foto' type="file" />
                        </div>
                        <div class="form-field col-lg-6">
                            <input class="submit-btn" type="submit" value="Create">
                        </div>
                    </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="text-center text-white mb-4 mt-4">Alumns</h1>
        <table class="table table-dark table-striped table-responsive-md text-center">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Made</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $alumn)
                <tr>
                    <td>{{ $alumn->name }}</td>
                    <td>{{ $alumn->email }}</td>
                    <td>Si</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}">
                            <button class="btn btn-success">
                                View
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <th class="text-white text-left" colspan="1">Total reservas:</th>
            <th class="text-white text-left" colspan="1">Plazas restantes:</th>
            <th class="text-white text-left">Aceptadas: </th>
            </tfoot>
        </table>
    </div>
@endsection
