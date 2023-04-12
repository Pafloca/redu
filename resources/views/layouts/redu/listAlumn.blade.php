@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')

    <h1 class="text-white text-center"><u>Students</u></h1>
<table class="table text-white text-center mt-3">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Add</th>
    </tr>
  </thead>
  <tbody>
  @foreach($students as $user)
      <tr>
          <th scope="row">{{$user->name}}</th>
          <td>{{$user->email}}</td>
          <td>
              @if(in_array($user->id, $arrayAlumn))
                  <form action="/deleteStudentGroup" method="POST">
                      @csrf
                      <input name="group_id" value="{{$id}}" type="hidden">
                      <input name="user_id" value="{{$user->id}}" type="hidden">
                      <button class="btn btn-success" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                          </svg>
                      </button>
                  </form>
              @else
                  <form action="/addStudentGroup" method="POST">
                      @csrf
                      <input name="group_id" value="{{$id}}" type="hidden">
                      <input name="user_id" value="{{$user->id}}" type="hidden">
                      <button class="btn btn-warning" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                      </button>
                  </form>
              @endif
          </td>
      </tr>
  @endforeach
  </tbody>
</table>
    <h1 class="text-white text-center"><u>Teachers</u></h1>
    <table class="table text-white text-center mt-3">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Add</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teachers as $user)
            <tr>
                <th scope="row">{{$user->name}}</th>
                <td>{{$user->email}}</td>
                <td>
                    @if(in_array($user->id, $arrayTeacher))
                        <form action="/deleteStudentGroup" method="POST">
                            @csrf
                            <input name="group_id" value="{{$id}}" type="hidden">
                            <input name="user_id" value="{{$user->id}}" type="hidden">
                            <button class="btn btn-success" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="/addStudentGroup" method="POST">
                            @csrf
                            <input name="group_id" value="{{$id}}" type="hidden">
                            <input name="user_id" value="{{$user->id}}" type="hidden">
                            <button class="btn btn-warning" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
