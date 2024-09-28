@extends('index')

@section('title', 'EcoCycle - Forgot Password')

@section('content')

    <main>

        <!-- =======================
        Main Content START -->
        <section class="vh-xxl-100">
            <div class="container h-100 d-flex px-0 px-sm-4">
                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-12">
                        <div class="bg-mode shadow rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <!-- Vector Image -->
                                <div class="col-lg-6 d-md-flex align-items-center order-2 order-lg-1">
                                    <div class="p-3 p-lg-5">
                                        <img src="{{ Vite::asset('resources/assets/images/element/forgot-pass.svg') }}" alt="">
                                    </div>
                                    <!-- Divider -->
                                    <div class="vr opacity-1 d-none d-lg-block"></div>
                                </div>

                                <!-- Information -->
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-7">
                                        <!-- Logo -->
                                        <a href="{{ url('/') }}">
                                            <img class="mb-4 h-50px" src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                                        </a>
                                        <!-- Title -->
                                        <h1 class="mb-2 h3">Forgot password?</h1>
                                        <p class="mb-sm-0">Enter the email address associated with an account.</p>

                                        <x-auth-session-status class="mb-4 mt-2" :status="session('status')" />

                                        <!-- Form START -->
                                        <form class="mt-sm-4 text-start" method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label class="form-label">Enter email</label>
                                                <x-text-input class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>

                                            <div class="mb-3 text-center">
                                                <p>Back to <a href="{{ route('login') }}">Sign in</a></p>
                                            </div>

                                            <!-- Button -->
                                            <div class="d-grid"><button type="submit" class="btn btn-primary">Email Password Reset Link</button></div>

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
        <!-- =======================
        Main Content END -->

    </main>

@endsection
