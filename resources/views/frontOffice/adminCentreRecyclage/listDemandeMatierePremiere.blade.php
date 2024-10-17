@extends('frontOffice.adminCentreRecyclage.adminCentreRecyclageDashboard')

@section('dashboard-content')
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-database fa-fw me-1"></i>Raw Material Demand List</h1>
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
                                    <div class="col"><h6 class="mb-0">Company</h6></div>
                                    <div class="col"><h6 class="mb-0">Raw Material</h6></div>
                                    <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Status</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Date</h6></div>
                                    <div class="col"><h6 class="mb-0">Action</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($demandesMatierePremieres as $demandesMatierePremiere)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Company:</small>
                                        <h6 class="fw-light mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#showModal-{{ $demandesMatierePremiere->id }}">{{ $demandesMatierePremiere->societe->name }}</a></h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Raw Material:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandesMatierePremiere->matierePremiere->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Quantity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandesMatierePremiere->quantite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Status:</small>
                                        <h6 class="mb-0">{{ $demandesMatierePremiere->etat }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Date:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandesMatierePremiere->created_at }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        @if ($demandesMatierePremiere->etat == 'On_Hold')
                                            <form action="{{ route('frontOffice.adminCentreRecyclage.confirmDemandeMatierePremiere', $demandesMatierePremiere->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary-soft mb-0">Confirm</button>
                                            </form>
                                        @endif
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


    @foreach ($demandesMatierePremieres as $demandesMatierePremiere)
        <div class="modal fade" id="showModal-{{ $demandesMatierePremiere->id }}" tabindex="-1" aria-labelledby="showModalLabel-{{ $demandesMatierePremiere->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="showModalLabel-{{ $demandesMatierePremiere->id }}">{{ $demandesMatierePremiere->societe->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-xxl-12">
                            <div class="card bg-light">
                                <!-- Card body -->
                                <div class="card-body text-center">
                                    <!-- Avatar Image -->
                                    <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                        <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $demandesMatierePremiere->societe->image) }}" alt="avatar">
                                    </div>
                                    <!-- Title -->
                                    <h5 class="mb-2">{{ $demandesMatierePremiere->societe->name }}</h5>
                                </div>
                                <!-- Card footer -->
                                <div class="card-footer bg-light border-top">
                                    <h6 class="mb-3">Contact Details</h6>
                                    <!-- Email id -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Email</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $demandesMatierePremiere->societe->email }}</a></h6>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Phone</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $demandesMatierePremiere->societe->telephone }}</a></h6>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Address</small>
                                            <h6 class="fw-normal small mb-0"><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($demandesMatierePremiere->societe->adresse) }}" target="_blank">{{ $demandesMatierePremiere->societe->adresse }}</a></h6>
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
