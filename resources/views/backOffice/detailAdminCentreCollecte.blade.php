@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <div class="row g-4 mb-5">
            <!-- Agent info START -->
            <div class="col-md-4 col-xxl-3">
                <div class="card bg-light">
                    <!-- Card body -->
                    <div class="card-body text-center">
                        <!-- Avatar Image -->
                        <div class="avatar avatar-xl flex-shrink-0 mb-3">
                            <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $adminCentreCollecte->image) }}" alt="avatar">
                        </div>
                        <!-- Title -->
                        <h5 class="mb-2">{{ $adminCentreCollecte->name }}</h5>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-light border-top">
                        <h6 class="mb-3">Contact Details</h6>
                        <!-- Email id -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                            <div class="ms-2">
                                <small>Email</small>
                                <h6 class="fw-normal small mb-0"><a href="">{{ $adminCentreCollecte->email }}</a></h6>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                            <div class="ms-2">
                                <small>Phone</small>
                                <h6 class="fw-normal small mb-0"><a href="">{{ $adminCentreCollecte->telephone }}</a></h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Agent info END -->

            <div class="col-md-8 col-xxl-9">
                <!-- Personal info START -->
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-bottom">
                        <h5 class="mb-0">Personal Information</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <!-- Information item -->
                            <div class="col-md-6">
                                <ul class="list-group list-group-borderless">
                                    <li class="list-group-item mb-3">
                                        <span>Full Name:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreCollecte->name }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Mobile Number:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreCollecte->telephone }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Registration Number:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreCollecte->matricule }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Information item -->
                            <div class="col-md-6">
                                <ul class="list-group list-group-borderless">
                                    <li class="list-group-item mb-3">
                                        <span>Email:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreCollecte->email }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Joining Date:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreCollecte->created_at }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Personal info END -->
            </div>
        </div> <!-- Row END -->

        @if(!is_null($centreCollecte))
            <div class="row g-4 mb-5">
                <!-- Agent info START -->
                <div class="col-md-4 col-xxl-3">
                    <div class="card bg-light">

                        <!-- Card body -->
                        <div class="card-body text-center">
                            <!-- Title -->
                            <h5 class="mb-2 mt-2 me-2">{{ $centreCollecte->nom }}</h5>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer bg-light border-top">
                            <h6 class="mb-3">Details</h6>
                            <!-- Email id -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                        class="bi bi-geo-alt-fill"></i></div>
                                <div class="ms-2">
                                    <small>Address</small>
                                    <h6 class="fw-normal small mb-0"><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreCollecte->adresse) }}" target="_blank">{{ $centreCollecte->adresse }}</a></h6>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                        class="bi bi-minecart-loaded"></i></div>
                                <div class="ms-2">
                                    <small>Capacity</small>
                                    <h6 class="fw-normal small mb-0"><a
                                            href="">{{ $centreCollecte->capacite }} Kg</a></h6>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-light border-top">
                            <h6 class="mb-3">Collection Area</h6>
                            <!-- Email id -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                        class="bi bi-houses-fill"></i></div>
                                <div class="ms-2">
                                    <small>Name</small>
                                    <h6 class="fw-normal small mb-0"><a
                                            href="">{{ $centreCollecte->zoneCollecte->nom }}</a></h6>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                        class="bi bi-geo-alt-fill"></i></div>
                                <div class="ms-2">
                                    <small>Address</small>
                                    <h6 class="fw-normal small mb-0"><a
                                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreCollecte->zoneCollecte->adresse) }}" target="_blank">{{ $centreCollecte->zoneCollecte->adresse }}</a></h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Agent info END -->

                <div class="col-md-8 col-xxl-9">
                    <!-- Personal info START -->
                    <div class="card shadow">
                        <!-- Card header -->
                        <div class="card-header border-bottom">
                            <h5 class="mb-0">Waste List</h5>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="card shadow mt-5">

                                    <!-- Card body START -->
                                    <div class="card-body">
                                        <!-- Table head -->
                                        <div class="bg-light rounded p-3 d-none d-sm-block">
                                            <div class="row row-cols-7 g-4">
                                                <div class="col"><h6 class="mb-0">Name</h6></div>
                                                <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                                <div class="col"><h6 class="mb-0">Type</h6></div>
                                            </div>
                                        </div>

                                        <!-- Table data -->
                                        @foreach ($dechets as $dechet)
                                            <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Name:</small>
                                                    <h6 class="fw-light mb-0">{{ $dechet->nom }}</h6>
                                                </div>

                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Quantity:</small>
                                                    <h6 class="mb-0 fw-normal">{{ $dechet->quantite }}</h6>
                                                </div>

                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Type:</small>
                                                    <h6 class="mb-0 fw-normal">{{ $dechet->typeDechet->nom }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Card body END -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Personal info END -->
                </div>
            </div> <!-- Row END -->
        @endif
    </div>

@endsection
