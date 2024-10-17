@extends('frontOffice.adminCentreRecyclage.adminCentreRecyclageDashboard')

@section('dashboard-content')
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-buildings fa-fw me-1"></i>Collection Center List</h1>
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
                                    <div class="col"><h6 class="mb-0">Address</h6></div>
                                    <div class="col"><h6 class="mb-0">Capacity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Action</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($centreCollectes as $centreCollecte)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Name:</small>
                                        <h6 class="fw-light mb-0">{{ $centreCollecte->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Address:</small>
                                        <h6 class="mb-0 fw-normal">{{ $centreCollecte->adresse }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Capacity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $centreCollecte->capacite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <a href="{{ route('frontOffice.adminCentreRecyclage.detailCentreCollecte', $centreCollecte->id) }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-eye-fill fa-fw"></i></a>
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
