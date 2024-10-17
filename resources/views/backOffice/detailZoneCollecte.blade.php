@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Collection Area Detail </h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addModal"
                           class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Assign Drivers to Collection Area
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="card shadow mt-5">
                <!-- Card header -->
                <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
                    <div class="ms-3">
                        <h5 class="mb-0">{{ $zoneCollecte->nom }}</h5>
                    </div>

                    <div class="d-block d-lg-flex gap-lg-5 flex-wrap mt-3 mt-lg-0">
                        <!-- Email address -->
                        <h6 class="mb-2 mb-lg-0"><i class="bi bi-geo-alt-fill fa-fw me-1"></i>Address:<a
                                class="fw-normal">
                                {{ $zoneCollecte->adresse }}</a></h6>
                    </div>
                </div>

                <!-- Card body -->
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h4 class="h3 mb-3 mb-sm-0">Drivers List</h4>
                        <div class="d-grid">
                            <a data-bs-toggle="modal" data-bs-target="#cancelModal"
                               class="btn btn-danger-soft mb-0">
                                <i class="bi-dash-circle me-2"></i>Cancel Driver Assignment to Collection Area
                            </a>
                        </div>
                    </div>

                    <!-- Table head -->
                    <div class="bg-light rounded p-3 d-none d-lg-block">
                        <div class="row row-cols-6 justify-content-between g-4">
                            <div class="col"><h6 class="mb-0">Full Name</h6></div>
                            <div class="col"><h6 class="mb-0">Email</h6></div>
                            <div class="col"><h6 class="mb-0">Mobile Number</h6></div>
                            <div class="col"><h6 class="mb-0">Registration Number</h6></div>
                        </div>
                    </div>

                    <!-- Table data -->
                    @foreach ($chauffeursZoneCollecte as $chauffeurZoneCollecte)
                        <div
                            class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-2 g-sm-4 align-items-md-center justify-content-between border-bottom px-2 py-4">
                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-lg-none">Full Name:</small>
                                <div class="d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="avatar avatar-sm flex-shrink-0">
                                        <img src="{{ asset('storage/' . $chauffeurZoneCollecte->image) }}" class="avatar-img rounded-circle" alt="">
                                    </div>
                                    <!-- Title -->
                                    <h6 class="mb-0 ms-2">{{ $chauffeurZoneCollecte->name }}</h6>
                                </div>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-lg-none">Email:</small>
                                <h6 class="mb-0 fw-normal">{{ $chauffeurZoneCollecte->email }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-lg-none">Mobile Number:</small>
                                <h6 class="mb-0 fw-normal">{{ $chauffeurZoneCollecte->telephone }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-lg-none">Registration Number:</small>
                                <h6 class="mb-0 fw-normal">{{ $chauffeurZoneCollecte->matricule }}</h6>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Assign Drivers to Collection Area</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start"  method="POST" action="{{ route('backOffice.assignChauffeursToZone', $zoneCollecte->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="chauffeurs">Select the drivers to assign :</label>
                            <select class="form-select" name="chauffeurs[]" multiple>
                                @foreach($chauffeurs as $chauffeur)
                                    <option value="{{ $chauffeur->id }}">{{ $chauffeur->matricule }} : {{ $chauffeur->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cancelModalLabel">Cancel Drivers Assignment to Collection Area</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start"  method="POST" action="{{ route('backOffice.unassignChauffeursFromZone', $zoneCollecte->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="chauffeurs">Select the drivers to be deassigned :</label>
                            <select class="form-select" name="chauffeurs[]" multiple>
                                @foreach($chauffeursZoneCollecte as $chauffeurZoneCollecte)
                                    <option value="{{ $chauffeurZoneCollecte->id }}">{{ $chauffeurZoneCollecte->matricule }} : {{ $chauffeurZoneCollecte->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Deassigned</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
