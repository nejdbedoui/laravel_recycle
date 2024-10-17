@extends('frontOffice.adminCentreCollecte.adminCentreCollecteDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-truck fa-fw me-1"></i>Trips List</h1>
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
                                    <div class="col"><h6 class="mb-0">Driver</h6></div>
                                    <div class="col"><h6 class="mb-0">Recycling Center</h6></div>
                                    <div class="col"><h6 class="mb-0">Waste</h6></div>
                                    <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Delivered Status</h6></div>
                                    <div class="col"><h6 class="mb-0">Delivered Date</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($deplacements as $deplacement)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Driver:</small>
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-xs flex-shrink-0">
                                                <img class="avatar-img rounded-circle"
                                                     src="{{ asset('storage/' . $deplacement->chauffeur->image) }}"
                                                     alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-2">
                                                <h6 class="mb-0 fw-normal"><a href="" data-bs-toggle="modal" data-bs-target="#showModal-{{ $deplacement->id }}">{{ $deplacement->chauffeur->matricule }}
                                                        : {{ $deplacement->chauffeur->name }}</a></h6>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Recycling Center:</small>
                                        <h6 class="fw-light mb-0">{{ $deplacement->demandeDechet->centreRecyclage->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Waste:</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->demandeDechet->dechet->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Quantity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->demandeDechet->quantite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Delivered Status:</small>
                                        <h6 class="mb-0">{{ $deplacement->etat }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Delivered Date:</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->date }}</h6>
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


    @foreach ($deplacements as $deplacement)
        <div class="modal fade" id="showModal-{{ $deplacement->id }}" tabindex="-1" aria-labelledby="showModalLabel-{{ $deplacement->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="showModalLabel-{{ $deplacement->id }}">{{ $deplacement->chauffeur->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-xxl-12">
                            <div class="card bg-light">
                                <!-- Card body -->
                                <div class="card-body text-center">
                                    <!-- Avatar Image -->
                                    <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                        <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $deplacement->chauffeur->image) }}" alt="avatar">
                                    </div>
                                    <!-- Title -->
                                    <h5 class="mb-2">{{ $deplacement->chauffeur->name }}</h5>
                                </div>
                                <!-- Card footer -->
                                <div class="card-footer bg-light border-top">
                                    <h6 class="mb-3">Contact Details</h6>
                                    <!-- Email id -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Email</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $deplacement->chauffeur->email }}</a></h6>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Phone</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $deplacement->chauffeur->telephone }}</a></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
