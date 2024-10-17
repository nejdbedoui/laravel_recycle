@extends('index')

@section('content')

    <!-- Header START -->
    <header class="navbar-light header-sticky">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="light-mode-item navbar-brand-item"
                         src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                    <img class="dark-mode-item navbar-brand-item"
                         src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto mx-3 p-0 p-sm-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
                </button>

                <!-- Header right side START -->
                <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">
                    <!-- Dark mode options START -->
                    <li class="nav-item dropdown me-2">
                        <button class="nav-notification lh-0 btn btn-light p-0 mb-0" id="bd-theme"
                                type="button"
                                aria-expanded="false"
                                data-bs-toggle="dropdown"
                                data-bs-display="static">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-circle-half theme-icon-active fa-fw" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                <use href="#"></use>
                            </svg>
                        </button>

                        <ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
                            <li class="mb-1">
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="light">
                                    <svg width="16" height="16" fill="currentColor"
                                         class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path
                                            d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                        <use href="#"></use>
                                    </svg>
                                    Light
                                </button>
                            </li>
                            <li class="mb-1">
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path
                                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                                        <path
                                            d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                        <use href="#"></use>
                                    </svg>
                                    Dark
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                        <use href="#"></use>
                                    </svg>
                                    Auto
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!-- Dark mode options END -->

                    <!-- Sign In button -->
                    <li class="nav-item ms-2">
                        <a href="{{url('/login')}}" class="btn btn-sm btn-primary mb-0"><span
                                class="d-none d-sm-inline">Sign In</span></a>
                    </li>
                </ul>
                <!-- Header right side END -->

            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
Main banner START -->
        <section class="pt-4 pt-md-5">
            <div class="container">

                <!-- Blog START -->
                <div class="row g-4">

                    <!-- Blog item START -->
                    <div class="col-lg-12">
                        <div class="vstack gap-4 mt-5">
                            <!-- Review item -->
                            <div class="row g-3 g-lg-4">
                                <!-- Colonne avec l'image -->
                                <div class="col-md-2">
                                    <section class="card-grid pt-0">
                                        <!-- Card item START -->
                                        <div class="row g-2">
                                            <!-- Image -->
                                            <div class="col-12">
                                                <a data-glightbox data-gallery="gallery" href="{{ asset('storage/' . $evenement->image) }}">
                                                    <div class="card card-grid-sm card-element-hover card-overlay-hover overflow-hidden" style="background-image:url('{{ asset('storage/' . $evenement->image) }}'); background-position: center left; background-size: cover;">
                                                        <!-- Card hover element -->
                                                        <div class="hover-element position-absolute w-100 h-100">
                                                            <i class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Card item END -->
                                    </section>
                                </div>

                                <!-- Colonne avec le texte -->
                                <div class="col-md-10 mt-5">
                                    <div class="mb-4">
                                        <h5 class="mb-2">{{ ($evenement->nom) }}</h5>
                                        <h6 class="fw-light mb-2">Date: {{ ($evenement->date) }}</h6>
                                        <p>{{ ($evenement->description) }}</p>
                                    </div>

                                    <!-- collapse textarea -->
                                    <div class="collapse show" id="collapseComment">
                                        <form action="{{ route('home.storeCommentaire', ['evenementId' => $evenement->id]) }}" method="POST">
                                            @csrf

                                            <input class="form-control" type="email" placeholder="Email" name="email" required/>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                            <div class="d-flex mt-3">

                                                <textarea class="form-control mb-0" placeholder="Add a comment..." rows="2" spellcheck="false" name="description" required></textarea>
                                                <button type="submit" class="btn btn-sm btn-primary ms-2 px-4 mb-0 flex-shrink-0"><i class="fas fa-paper-plane fs-5"></i></button>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                            <hr class="m-0"> <!-- Divider -->

                            <!-- Review item -->
                            @foreach ($commentaires as $commentaire)
                            <div class="row g-3 g-lg-4">
                                <div class="col-md-4 col-xxl-3">
                                    <!-- Avatar and info -->
                                    <div class="d-flex align-items-center">
                                        <!-- Info -->
                                        <div class="ms-2">
                                            <h5 class="mb-1">{{ ($commentaire->email) }}</h5>
                                            <p class="mb-0">{{ ($commentaire->created_at) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 col-xxl-9">
                                    <p>{{ ($commentaire->description) }}</p>
                                </div>
                            </div>

                            <hr class="m-0"> <!-- Divider -->
                            @endforeach

                        </div>
                    </div>
                    <!-- Blog item END -->
                </div>
                <!-- Blog END -->
            </div>
        </section>
        <!-- =======================
        Main banner END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- =======================
    Footer START -->
    <footer class="bg-dark p-3">
        <div class="container">
            <div class="row align-items-center">

                <!-- Widget -->
                <div class="col-md-3">
                    <div class="text-center text-md-start mb-3 mb-md-0">
                        <a href="{{ url('/') }}"> <img class="h-50px"
                                                       src="{{ Vite::asset('resources/assets/images/logo.png') }}"
                                                       alt="logo">
                        </a>
                    </div>
                </div>

                <!-- Widget -->
                <div class="col-md-5">
                    <div class="text-body-secondary text-primary-hover"> Copyrights ©2024 MASTERMINDS. Build by <a
                            href="" class="text-body-secondary">ESPRIT</a>.
                    </div>
                </div>

                <!-- Widget -->
                <div class="col-md-4">
                    <ul class="list-inline mb-0 text-center text-md-end">
                        <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item ms-2"><a href=""><i
                                    class="text-white fab fa-instagram"></i></a></li>
                        <li class="list-inline-item ms-2"><a href=""><i
                                    class="text-white fab fa-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- =======================
    Footer END -->

@endsection
