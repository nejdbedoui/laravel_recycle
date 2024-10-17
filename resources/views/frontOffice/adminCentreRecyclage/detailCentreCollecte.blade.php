@extends('frontOffice.adminCentreRecyclage.adminCentreRecyclageDashboard')

@section('dashboard-content')
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-buildings fa-fw me-1"></i>Collection Center Detail</h1>
                </div>
            </div>

            <!-- Title -->
            <div class="card border">
                <div class="row g-4 mb-2">
                    <!-- Agent info START -->
                    <div class="col-md-12 col-xxl-12">
                        <div class="card bg-light mt-4 ms-4 me-4">
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
                </div> <!-- Row END -->

                @if(!is_null($centreCollecte))
                    <div class="row g-4 mb-2">
                        <!-- Agent info START -->
                        <div class="col-md-12 col-xxl-12">
                            <div class="card bg-light mt-4 ms-4 me-4">

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

                        <div class="col-md-12 col-xxl-12">
                            <!-- Personal info START -->
                            <div class="card shadow mt-2 ms-4 me-4">
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
                                                            <a class="btn btn-sm btn-primary-soft mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dechet->id }}">Place
                                                                an
                                                                Order</a>
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

        </div>
    </section>


    @foreach ($dechets as $dechet)
        <div class="modal fade" id="exampleModal{{ $dechet->id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Waste Demand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('frontOffice.adminCentreRecyclage.storeDemandeDechet') }}">
                            @csrf
                            <input type="hidden" name="dechet_id" value="{{ $dechet->id }}">

                            <!-- Quantity input -->
                            <div class="mb-3">
                                <label class="form-label">Enter quantity (Kg)</label>
                                <x-text-input class="form-control" type="number" name="quantite"
                                              :value="old('quantite')" required autofocus autocomplete="quantite"/>
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                            </div>

                            <!-- Button -->
                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
