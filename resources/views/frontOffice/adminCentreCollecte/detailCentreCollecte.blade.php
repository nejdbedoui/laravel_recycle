@extends('frontOffice.adminCentreCollecte.adminCentreCollecteDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-house-door fa-fw me-1"></i>Collection Center Detail</h1>
                </div>
            </div>
            <!-- Title END -->

            <div class="col-lg-8 col-xl-12">
                <div class="vstack gap-4">

                    <!-- Personal info START -->
                    <div class="card border">

                        <div class="row g-4 mt-2 mb-2 me-2 ms-2">
                            <!-- Agent info START -->
                            <div class="col-md-4 col-xxl-3">
                                <div class="card bg-light">

                                    <div class="position-absolute top-0 end-0 p-3">
                                        <a href="{{ route('frontOffice.adminCentreCollecte.editCentreCollecte', $centreCollecte->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

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
                                                <h6 class="fw-normal small mb-0"><a
                                                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreCollecte->adresse) }}" target="_blank">{{ $centreCollecte->adresse }}</a></h6>
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
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary-soft">
                                            <i class="bi bi-plus-lg fa-fw me-2"></i>Add Waste
                                        </a>
                                    </div>
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
                                                            <div class="col"><h6 class="mb-0">Action</h6></div>
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

                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                                    <a data-bs-toggle="modal" data-bs-target="#editDechetModal-{{ $dechet->id }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                                                    <form method="POST" action="{{ route('frontOffice.adminCentreCollecte.deleteDechet', $dechet->id) }}">
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
                                    </div>
                                </div>
                                <!-- Personal info END -->
                            </div>
                        </div> <!-- Row END -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Collection Center</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST"
                          action="{{ route('frontOffice.adminCentreCollecte.updateCentreCollecte', ['id' => $centreCollecte->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $centreCollecte->nom) }}" required/>
                            <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter Address</label>
                            <x-text-input class="form-control" type="text" name="adresse" value="{{ old('adresse', $centreCollecte->adresse) }}" required/>
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter Capacity (Kg)</label>
                            <x-text-input class="form-control" type="number" name="capacite" value="{{ old('capacite', $centreCollecte->capacite) }}" required/>
                            <x-input-error :messages="$errors->get('capacite')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label for="zone_collecte_id" class="form-label">Collection Area</label>
                            <select class="form-select" name="zone_collecte_id" required>
                                <option value="" disabled selected>Select a collection area</option>
                                @foreach($zoneCollectes as $zone)
                                    <option value="{{ $zone->id }}" {{ $zone->id == $centreCollecte->zone_collecte_id ? 'selected' : '' }}>{{ $zone->nom }} : {{ $zone->adresse }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('zone_collecte_id')" class="mt-2"/>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Waste</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST"
                          action="{{ route('frontOffice.adminCentreCollecte.storeDechet') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="nom" required/>
                            <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter Quantity (Kg)</label>
                            <x-text-input class="form-control" type="number" name="quantite" required/>
                            <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label for="type_dechet_id" class="form-label">Type</label>
                            <select class="form-select" name="type_dechet_id" required>
                                <option value="" disabled selected>Select a waste type</option>
                                @foreach($typesDechets as $type)
                                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type_dechet_id')" class="mt-2"/>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for updating type de déchet -->
    @foreach ($dechets as $dechet)
        <div class="modal fade" id="editDechetModal-{{ $dechet->id }}" tabindex="-1" aria-labelledby="editDechetModalLabel-{{ $dechet->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editDechetModalLabel-{{ $dechet->id }}">Edit Waste</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('frontOffice.adminCentreCollecte.updateDechet', ['id' => $dechet->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $dechet->nom) }}" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity (Kg)</label>
                                <x-text-input class="form-control" type="text" name="quantite" value="{{ old('quantite', $dechet->quantite) }}" required/>
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label for="type_dechet_id" class="form-label">Type</label>
                                <select class="form-select" name="type_dechet_id" required>
                                    <option value="" disabled selected>Select a waste type</option>
                                    @foreach($typesDechets as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $dechet->type_dechet_id ? 'selected' : '' }}>{{ $type->nom }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type_dechet_id')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
