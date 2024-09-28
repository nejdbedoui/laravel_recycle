@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Company List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Company List</h1>
                </div>
            </div>
        </div>

        <!-- Search and select START -->
        <div class="row g-3 align-items-center justify-content-between mb-5">
            <!-- Search -->
            <div class="col-md-12">
                <form class="rounded position-relative">
                    <input class="form-control pe-5" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
                </form>
            </div>
        </div>
        <!-- Search and select END -->

        <!-- agent list START -->
        <div class="row g-4">
            @foreach ($societes as $societe)
                <!-- Card item -->
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card border h-100">
                        <!-- Card body -->
                        <div class="card-body text-center pb-0">
                            <!-- Avatar Image -->
                            <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $societe->image) }}" alt="avatar">
                            </div>
                            <!-- Title -->
                            <h5 class="mb-1">{{ $societe->name }}</h5>
                            <small><i class="bi bi-person-badge me-1"></i>{{ $societe->matricule }}</small>
                            <!-- Info and rating -->
                            <div class="d-flex justify-content-between mt-3">
                                <h6 class="mb-0 small"><span class="fw-light">Email Address:</span></h6>
                                <h6 class="mb-0 small">{{ $societe->email }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <h6 class="mb-0 small"><span class="fw-light">Phone Number:</span></h6>
                                <h6 class="mb-0 small">{{ $societe->telephone }}</h6>
                            </div>
                        </div>
                        <!-- card footer -->
                        <div class="card-footer d-flex gap-3 align-items-center">
                            <a href="{{ route('backOffice.detailSociete', $societe->id) }}" class="btn btn-sm btn-primary-soft mb-0 w-100">View detail</a>

                            <!-- Toggle enable/disable buttons -->
                            @if($societe->enable)
                                <form action="{{ route('user.disable', $societe->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger-soft flex-shrink-0 mb-0">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.enable', $societe->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info-soft flex-shrink-0 mb-0">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- agent list END -->
    </div>

@endsection
