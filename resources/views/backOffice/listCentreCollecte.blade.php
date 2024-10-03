@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Driver List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Centre de collecte List</h1>
                    <div class="d-grid"><a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary-soft mb-0"><i class="bi bi-person-fill-add me-2"></i>Add Zone</a>	</div>
                </div>
            </div>
        </div>

        <!-- Search and select START -->
        <div class="row g-3 align-items-center justify-content-between mb-5">
            <!-- Search -->
            <div class="col-md-12">
                <form class="rounded position-relative" method="GET" action="{{ route('backOffice.listCentreCollecte') }}">
                    <input class="form-control pe-5" name="name" :value="old('name')" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
                </form>
            </div>
        </div>
        <!-- Search and select END -->

        <!-- agent list START -->
        <div class="row g-4">
            @foreach ($centresCollectes as $centreCollecte)
                <!-- Card item -->
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card border h-100">
                        <!-- Card body -->
                        <div class="card-body text-center pb-0">
                            <!-- Avatar Image -->
                            <div >
                                  </div>
                            <!-- Title -->
                            <h5 class="mb-1">{{ $centreCollecte->nom }}</h5>
                            <small><i class="bi bi-person-badge me-1"></i>{{ $centreCollecte->adresse }}</small>

                        </div>
                        <!-- card footer -->
                        <div class="card-footer d-flex gap-3 align-items-center">
                            <a href="{{ route('backOffice.detailCentreCollecte', $centreCollecte->id) }}" class="btn btn-sm btn-primary-soft mb-0 w-100">View detail</a>

                            <form action="{{ route('CentreCollecte.delete', $centreCollecte->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger-soft flex-shrink-0 mb-0">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- agent list END -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Centre de Collecte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST" action="{{ route('backOffice.addCentreCollecte') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Adresse</label>
                            <x-text-input class="form-control" type="text" name="adresse" :value="old('adresse')" required autofocus autocomplete="adresse" />
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Capacity</label>
                            <x-text-input class="form-control" type="number" name="capacite" :value="old('capacite')" required autofocus autocomplete="capacite" />
                            <x-input-error :messages="$errors->get('capacite')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Choose a Zone</label>
                            <select class="form-control" name="zone_id" required>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->id }} - {{ $zone->nom }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('zone_id')" class="mt-2" />
                        </div>
                        <!-- Button -->
                        <div><button type="submit" data-bs-dismiss="modal" class="btn btn-primary w-100 mb-0">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
