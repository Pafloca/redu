@extends('layouts/redu/plant')
@section('titulo', 'REDU')
@section('contenido')
    <section class="vh-100 gradient-custom mb-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your username and password!</p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-outline form-white mb-4">
                                        <x-text-input id="email" class="form-control form-control-lg" type="email"
                                                      name="email" :value="old('email')" required autofocus
                                                      autocomplete="username"/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                        <label class="form-label" for="typeEmailX">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <x-text-input id="password" class="form-control form-control-lg"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="current-password"/>

                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>

                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                                        {{ __("You haven't registered?") }}
                                    </a>

                                    <br><br>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
