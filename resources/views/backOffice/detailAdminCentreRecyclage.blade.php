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
                            <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $adminCentreRecyclage->image) }}" alt="avatar">
                        </div>
                        <!-- Title -->
                        <h5 class="mb-2">{{ $adminCentreRecyclage->name }}</h5>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-light border-top">
                        <h6 class="mb-3">Contact Details</h6>
                        <!-- Email id -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                            <div class="ms-2">
                                <small>Email</small>
                                <h6 class="fw-normal small mb-0"><a href="">{{ $adminCentreRecyclage->email }}</a></h6>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                            <div class="ms-2">
                                <small>Phone</small>
                                <h6 class="fw-normal small mb-0"><a href="">{{ $adminCentreRecyclage->telephone }}</a></h6>
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
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreRecyclage->name }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Mobile Number:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreRecyclage->telephone }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Registration Number:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreRecyclage->matricule }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Information item -->
                            <div class="col-md-6">
                                <ul class="list-group list-group-borderless">
                                    <li class="list-group-item mb-3">
                                        <span>Email:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreRecyclage->email }}</span>
                                    </li>

                                    <li class="list-group-item mb-3">
                                        <span>Joining Date:</span>
                                        <span class="h6 fw-normal ms-1 mb-0">{{ $adminCentreRecyclage->created_at }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Personal info END -->
            </div>
        </div> <!-- Row END -->

        @if(!is_null($centreRecyclage))
            <div class="row g-4 mb-5">
                <!-- Agent info START -->
                <div class="col-md-4 col-xxl-3">
                    <div class="card bg-light">

                        <!-- Card body -->
                        <div class="card-body text-center">
                            <!-- Title -->
                            <h5 class="mb-2 mt-2 me-2">{{ $centreRecyclage->nom }}</h5>
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
                                    <h6 class="fw-normal small mb-0"><a
                                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreRecyclage->adresse) }}" target="_blank">{{ $centreRecyclage->adresse }}</a></h6>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                        class="bi bi-minecart-loaded"></i></div>
                                <div class="ms-2">
                                    <small>Capacity</small>
                                    <h6 class="fw-normal small mb-0"><a
                                            href="">{{ $centreRecyclage->capacite }} Kg</a></h6>
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
                            <h5 class="mb-0">Recycling Types List</h5>
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
                                                <div class="col"><h6 class="mb-0">Description</h6></div>
                                            </div>
                                        </div>

                                        <!-- Table data -->
                                        @foreach ($typeRecyclages as $typeRecyclage)
                                            <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Name:</small>
                                                    <h6 class="fw-light mb-0">{{ $typeRecyclage->nom }}</h6>
                                                </div>

                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Description:</small>
                                                    <h6 class="mb-0 fw-normal">{{ $typeRecyclage->description }}</h6>
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

                    <div class="card shadow mt-4">
                        <!-- Card header -->
                        <div class="card-header border-bottom">
                            <h5 class="mb-0">Raw Materials List</h5>
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
                                            </div>
                                        </div>

                                        <!-- Table data -->
                                        @foreach ($matierePremieres as $matierePremiere)
                                            <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Name:</small>
                                                    <h6 class="fw-light mb-0">{{ $matierePremiere->nom }}</h6>
                                                </div>

                                                <!-- Data item -->
                                                <div class="col">
                                                    <small class="d-block d-sm-none">Quantity:</small>
                                                    <h6 class="mb-0 fw-normal">{{ $matierePremiere->quantite }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Card body END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row END -->
        @endif
    </div>

@endsection
