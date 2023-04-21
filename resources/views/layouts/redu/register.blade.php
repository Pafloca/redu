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

                                <h2 class="fw-bold mb-2 text-uppercase">REGISTER</h2>
                                <p class="text-white-50 mb-5">Please complete all fields!</p>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="form-outline form-white mb-4">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control form-control-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-outline form-white mb-4">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-outline form-white mb-4">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control form-control-lg"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-outline form-white mb-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="form-control form-control-lg"
                                                      type="password"
                                                      name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <x-input-label for="rol" :value="__('ROL')" />

                                        <select class="form-select" name="rol" aria-label="Default select example">
                                            <option value="" selected>--- Select ROL ---</option>
                                            <option value="teacher">Teacher</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <br><br>

                                        <x-primary-button class="btn btn-outline-light btn-lg px-5">
                                            {{ __('Register') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
