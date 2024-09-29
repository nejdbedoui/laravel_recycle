@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Community Events Detail')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <h1 class="h3 mb-0">Community Events Detail</h1>
            </div>
        </div>

        <!-- Reviews START -->
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
                                <a data-glightbox data-gallery="gallery"
                                   href="{{ asset('storage/' . $evenement->image) }}">
                                    <div class="card card-grid-sm card-element-hover card-overlay-hover overflow-hidden"
                                         style="background-image:url('{{ asset('storage/' . $evenement->image) }}'); background-position: center left; background-size: cover;">
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

                        <!-- Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            </div>
                            <form method="POST" action="{{ route('backOffice.deleteCommentaire', $commentaire->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light"><i class="bi bi-trash3 me-1"></i>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

                <hr class="m-0"> <!-- Divider -->
            @endforeach

        </div>

    </div>

@endsection
