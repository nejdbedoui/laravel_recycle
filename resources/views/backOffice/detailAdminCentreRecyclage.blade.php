@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Recycling Center Admin Detail')

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
    </div>

@endsection
