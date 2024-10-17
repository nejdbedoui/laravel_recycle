@extends('frontOffice.chauffeur.chauffeurDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-buildings fa-fw me-1"></i>Collection Areas List</h1>
                </div>
            </div>
            <!-- Title END -->

            <div class="col-lg-8 col-xl-12">
                <div class="vstack gap-4">

                    <!-- Personal info START -->
                    <div class="card border">

                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Table head -->
                            <div class="bg-light rounded p-3 d-none d-sm-block">
                                <div class="row row-cols-7 g-4">
                                    <div class="col"><h6 class="mb-0">Name</h6></div>
                                    <div class="col"><h6 class="mb-0">Address</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($zonesCollectes as $zoneCollecte)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Name:</small>
                                        <h6 class="fw-light mb-0">{{ $zoneCollecte->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Address:</small>
                                        <h6 class="fw-light mb-0"><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($zoneCollecte->adresse) }}" target="_blank">{{ $zoneCollecte->adresse }}</a></h6>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
