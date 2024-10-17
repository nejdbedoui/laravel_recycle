@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Collection Areas List </h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addTypeDechetModal" class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Add Collection Area
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="card shadow mt-5">

                <!-- Card body START -->
                <div class="card-body">
                    <!-- Table head -->
                    <div class="bg-light rounded p-3 d-none d-sm-block">
                        <div class="row row-cols-7 g-4">
                            <div class="col"><h6 class="mb-0">Name</h6></div>
                            <div class="col"><h6 class="mb-0">Address</h6></div>
                            <div class="col"><h6 class="mb-0">Action</h6></div>
                        </div>
                    </div>

                    <!-- Table data -->
                    @foreach ($zoneCollectes as $zoneCollecte)
                        <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-sm-none">Name:</small>
                                <h6 class="fw-light mb-0">{{ $zoneCollecte->nom }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-sm-none">Address:</small>
                                <h6 class="mb-0 fw-normal">{{ $zoneCollecte->adresse }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                    <a href="{{ route('backOffice.detailZoneCollecte', $zoneCollecte->id) }}" class="btn btn-sm btn-info-soft px-2 mb-0"><i class="bi bi-eye-fill fa-fw"></i></a>

                                    <a data-bs-toggle="modal" data-bs-target="#editTypeDechetModal-{{ $zoneCollecte->id }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                    <form method="POST" action="{{ route('backOffice.deleteZoneCollecte', $zoneCollecte->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger-soft px-2 mb-0">
                                            <i class="bi bi-trash fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Card body END -->
            </div>
        </div>

        <!-- Modal for adding new Collection Areas -->
        <div class="modal fade" id="addTypeDechetModal" tabindex="-1" aria-labelledby="addTypeDechetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addTypeDechetModalLabel">Add Collection Area</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.storeZoneCollecte') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <x-text-input class="form-control" type="text" name="adresse" required/>
                                <x-input-error :messages="$errors->get('adresse')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for updating Collection Areas -->
        @foreach ($zoneCollectes as $zoneCollecte)
            <div class="modal fade" id="editTypeDechetModal-{{ $zoneCollecte->id }}" tabindex="-1" aria-labelledby="editTypeDechetModalLabel-{{ $zoneCollecte->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editTypeDechetModalLabel-{{ $zoneCollecte->id }}">Edit Collection Area</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-start" method="POST" action="{{ route('backOffice.updateZoneCollecte', ['id' => $zoneCollecte->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $zoneCollecte->nom) }}" required/>
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <x-text-input class="form-control" type="text" name="adresse" value="{{ old('adresse', $zoneCollecte->adresse) }}" required/>
                                    <x-input-error :messages="$errors->get('adresse')" class="mt-2"/>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-100 mb-0">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
