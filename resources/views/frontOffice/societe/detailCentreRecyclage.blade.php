@extends('frontOffice.societe.societeDashboard')

@section('dashboard-content')
    <div class="col-lg-8 col-xl-9">
        <section class="pt-0">
            <div class="container vstack gap-4">

                <!-- Booking table START -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border">
                            <!-- Card header START -->
                            <div class="card-header border-bottom">
                                <h4 class="card-header-title">Recycling Center Detail</h4>
                            </div>
                            <!-- Card header END -->

                            <!-- Card body START -->
                            <div class="card-body">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row g-4 mb-4">
                                        <!-- Agent info START -->
                                        <div class="col-md-12 col-xxl-12">
                                            <div class="card bg-light">
                                                <!-- Card body -->
                                                <div class="card-body text-center">
                                                    <!-- Avatar Image -->
                                                    <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                                        <img class="avatar-img rounded-circle"
                                                             src="{{ asset('storage/' . $adminCentreRecyclage->image) }}"
                                                             alt="avatar">
                                                    </div>
                                                    <!-- Title -->
                                                    <h5 class="mb-2">{{ $adminCentreRecyclage->name }}</h5>
                                                </div>
                                                <!-- Card footer -->
                                                <div class="card-footer bg-light border-top">
                                                    <h6 class="mb-3">Contact Details</h6>
                                                    <!-- Email id -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div
                                                            class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0">
                                                            <i
                                                                class="bi bi-envelope-fill"></i></div>
                                                        <div class="ms-2">
                                                            <small>Email</small>
                                                            <h6 class="fw-normal small mb-0"><a
                                                                    href="">{{ $adminCentreRecyclage->email }}</a></h6>
                                                        </div>
                                                    </div>

                                                    <!-- Phone -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div
                                                            class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0">
                                                            <i
                                                                class="bi bi-telephone-fill"></i></div>
                                                        <div class="ms-2">
                                                            <small>Phone</small>
                                                            <h6 class="fw-normal small mb-0"><a
                                                                    href="">{{ $adminCentreRecyclage->telephone }}</a>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Agent info END -->

                                    </div> <!-- Row END -->

                                    <div class="row g-4 mb-5">
                                        <!-- Agent info START -->
                                        <div class="col-md-12 col-xxl-12">
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
                                                        <div
                                                            class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0">
                                                            <i
                                                                class="bi bi-geo-alt-fill"></i></div>
                                                        <div class="ms-2">
                                                            <small>Address</small>
                                                            <h6 class="fw-normal small mb-0"><a
                                                                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreRecyclage->adresse) }}" target="_blank">{{ $centreRecyclage->adresse }}</a></h6>
                                                        </div>
                                                    </div>

                                                    <!-- Phone -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div
                                                            class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0">
                                                            <i
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

                                        <div class="col-md-12 col-xxl-12">
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
                                                                        <div class="col"><h6 class="mb-0">Name</h6>
                                                                        </div>
                                                                        <div class="col"><h6 class="mb-0">
                                                                                Description</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Table data -->
                                                                @foreach ($typeRecyclages as $typeRecyclage)
                                                                    <div
                                                                        class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                                        <!-- Data item -->
                                                                        <div class="col">
                                                                            <small
                                                                                class="d-block d-sm-none">Name:</small>
                                                                            <h6 class="fw-light mb-0">{{ $typeRecyclage->nom }}</h6>
                                                                        </div>

                                                                        <!-- Data item -->
                                                                        <div class="col">
                                                                            <small
                                                                                class="d-block d-sm-none">Description:</small>
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
                                                                        <div class="col"><h6 class="mb-0">Name</h6>
                                                                        </div>
                                                                        <div class="col"><h6 class="mb-0">Quantity
                                                                                (Kg)</h6>
                                                                        </div>
                                                                        <div class="col"><h6 class="mb-0">Action</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Table data -->
                                                                @foreach ($matierePremieres as $matierePremiere)
                                                                    <div
                                                                        class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                                        <!-- Data item -->
                                                                        <div class="col">
                                                                            <small
                                                                                class="d-block d-sm-none">Name:</small>
                                                                            <h6 class="fw-light mb-0">{{ $matierePremiere->nom }}</h6>
                                                                        </div>

                                                                        <!-- Data item -->
                                                                        <div class="col">
                                                                            <small
                                                                                class="d-block d-sm-none">Quantity:</small>
                                                                            <h6 class="mb-0 fw-normal">{{ $matierePremiere->quantite }}</h6>
                                                                        </div>

                                                                        <!-- Data item -->
                                                                        <div class="col">
                                                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $matierePremiere->id }}" class="btn btn-sm btn-primary-soft mb-0">Place an Order</a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal for each matierePremiere -->
    @foreach ($matierePremieres as $matierePremiere)
        <div class="modal fade" id="exampleModal{{ $matierePremiere->id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Raw Material Demand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('frontOffice.societe.storeDemandeMatierePremiere') }}">
                            @csrf
                            <input type="hidden" name="matiere_premiere_id" value="{{ $matierePremiere->id }}">

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
