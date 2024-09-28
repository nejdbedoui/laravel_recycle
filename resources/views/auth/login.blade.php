@extends('index')

@section('title', 'EcoCycle - Sign In')

@section('content')
    <main>
        <section class="vh-xxl-100">
            <div class="container h-100 d-flex px-0 px-sm-4">
                <div class="row justify-content-center align-items-center m-auto">
                    <!-- Le contenu de votre page -->
                    <div class="col-12">
                        <div class="bg-mode shadow rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <!-- Vector Image -->
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1">
                                    <div class="p-3 p-lg-5">
                                        <img src="{{ Vite::asset('resources/assets/images/element/signin.svg') }}" alt="">
                                    </div>
                                    <!-- Divider -->
                                    <div class="vr opacity-1 d-none d-lg-block"></div>
                                </div>
                                <!-- Information -->
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-7">
                                        <!-- Logo -->
                                        <a href="{{ url('/') }}">
                                            <img class="h-50px mb-4" src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                                        </a>
                                        <!-- Title -->
                                        <h1 class="mb-2 h3">Welcome back</h1>
                                        <p class="mb-0">New here?<a href="{{ route('register') }}"> Create an account</a></p>

                                        <x-auth-session-status class="mt-2" :status="session('status')" />

                                        <!-- Form START -->
                                        <form class="mt-4 text-start" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label class="form-label">Enter email</label>
                                                <x-text-input class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <!-- Password -->
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Enter password</label>
                                                <x-text-input id="psw-input" class="form-control fakepassword"
                                                              type="password"
                                                              name="password"
                                                              required autocomplete="current-password" />
                                                <span class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3">
											<i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
										</span>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <!-- Remember me -->
                                            <div class="mb-3 d-sm-flex justify-content-between">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
                                                    <label class="form-check-label" for="rememberCheck">Remember me?</label>
                                                </div>
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                            <!-- Button -->
                                            <div><button type="submit" class="btn btn-primary w-100 mb-0">Login</button></div>

                                            <!-- Copyright -->
                                            <div class="text-primary-hover text-body mt-3 text-center"> Copyrights ©2024 MASTERMINDS. Build by <a href="" class="text-body">ESPRIT</a>. </div>
                                        </form>
                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
