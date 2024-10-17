@extends('frontOffice.adminCentreCollecte.adminCentreCollecteDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-card-list fa-fw me-1"></i>Waste Types List</h1>
                </div>
            </div>

            <!-- Title -->
            <div class="card border">
                <div class="row g-4 mt-2 mb-2 me-2 ms-2">
                    <!-- Type de déchets list START -->

                    <div class="card shadow mt-5">

                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Table head -->
                            <div class="bg-light rounded p-3 d-none d-sm-block">
                                <div class="row row-cols-7 g-4">
                                    <div class="col"><h6 class="mb-0">Name</h6></div>
                                    <div class="col"><h6 class="mb-0">Description</h6></div>
                                    <div class="col"><h6 class="mb-0">Recyclable</h6></div>
                                    <div class="col"><h6 class="mb-0">Dangerous</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($typesDechets as $typeDechet)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Name:</small>
                                        <h6 class="fw-light mb-0">{{ $typeDechet->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Description:</small>
                                        <h6 class="mb-0 fw-normal">{{ $typeDechet->description }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Recyclable:</small>
                                        <h6 class="mb-0 fw-normal">{{ $typeDechet->recyclable }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Dangerous:</small>
                                        <h6 class="mb-0 fw-normal">{{ $typeDechet->dangereux }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Card body END -->
                    </div>
                    <!-- Type de déchets list END -->
                </div>
            </div>

        </div>
    </section>

@endsection
