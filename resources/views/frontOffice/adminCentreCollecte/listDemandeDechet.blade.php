@extends('frontOffice.adminCentreCollecte.adminCentreCollecteDashboard')

@section('dashboard-content')
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-trash fa-fw me-1"></i>Waste Demand List</h1>
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
                                    <div class="col"><h6 class="mb-0">Recycling Center</h6></div>
                                    <div class="col"><h6 class="mb-0">Waste</h6></div>
                                    <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Status</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Date</h6></div>
                                    <div class="col"><h6 class="mb-0">Action</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($demandeDechets as $demandeDechet)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Recycling Center:</small>
                                        <h6 class="fw-light mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#showModal-{{ $demandeDechet->id }}">{{ $demandeDechet->centreRecyclage->nom }}</a></h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Waste:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->dechet->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Quantity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->quantite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Status:</small>
                                        <h6 class="mb-0">{{ $demandeDechet->etat }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Date:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->created_at }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        @if ($demandeDechet->etat == 'On_Hold')
                                            <form action="{{ route('frontOffice.adminCentreCollecte.confirmDemandeDechet', $demandeDechet->id) }}" method="POST">
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


    @foreach ($demandeDechets as $demandeDechet)
        <div class="modal fade" id="showModal-{{ $demandeDechet->id }}" tabindex="-1" aria-labelledby="showModalLabel-{{ $demandeDechet->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="showModalLabel-{{ $demandeDechet->id }}">{{ $demandeDechet->centreRecyclage->nom }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-xxl-12">
                            <div class="card bg-light">
                                <!-- Card body -->
                                <div class="card-body text-center">
                                    <!-- Avatar Image -->
                                    <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                        <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $demandeDechet->centreRecyclage->admin->image) }}" alt="avatar">
                                    </div>
                                    <!-- Title -->
                                    <h5 class="mb-2">{{ $demandeDechet->centreRecyclage->admin->name }}</h5>
                                </div>
                                <!-- Card footer -->
                                <div class="card-footer bg-light border-top">
                                    <h6 class="mb-3">Contact Details</h6>
                                    <!-- Email id -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Email</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $demandeDechet->centreRecyclage->admin->email }}</a></h6>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Phone</small>
                                            <h6 class="fw-normal small mb-0"><a href="">{{ $demandeDechet->centreRecyclage->admin->telephone }}</a></h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer bg-light border-top">
                                    <h6 class="mb-3">Details Recycling Center</h6>
                                    <!-- Email id -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                                class="bi bi-geo-alt-fill"></i></div>
                                        <div class="ms-2">
                                            <small>Address</small>
                                            <h6 class="fw-normal small mb-0"><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($demandeDechet->centreRecyclage->adresse) }}" target="_blank">{{ $demandeDechet->centreRecyclage->adresse }}</a></h6>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                                class="bi bi-minecart-loaded"></i></div>
                                        <div class="ms-2">
                                            <small>Capacity</small>
                                            <h6 class="fw-normal small mb-0"><a
                                                    href="">{{ $demandeDechet->centreRecyclage->capacite }} Kg</a></h6>
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
