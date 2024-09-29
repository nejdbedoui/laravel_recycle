@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Waste List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Waste List</h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addWasteModal" class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Add Waste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Waste list START -->
        <div class="row g-4">
            @foreach ($dechets as $dechet)
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-transparent">
                        <!-- Image -->
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $dechet->image) }}" class="card-img" alt="{{ $dechet->nom }}">
                            <div class="card-img-overlay d-flex flex-column p-3">
                                <!-- Card overlay top -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div></div>
                                    <!-- Buttons -->
                                    <div class="list-inline-item dropdown">
                                        <!-- Dropdown button -->
                                        <a href="#" class="btn btn-sm btn-round btn-light" role="button"
                                           id="dropdownAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown items -->
                                        <ul class="dropdown-menu dropdown-menu-end min-w-auto shadow rounded small"
                                            aria-labelledby="dropdownAction1">
                                            <li>
                                                <a href="{{ route('backOffice.editDechet', $dechet->id) }}" class="dropdown-item">
                                                    <i class="bi bi-pencil-square fa-fw me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('backOffice.deleteDechet', $dechet->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-trash fa-fw me-2"></i>Remove
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-3 pb-0">
                            <!-- Title -->
                            {{--                            <h5 class="card-title mt-2">--}}
                            {{--                                <a href="{{ route('backOffice.detailDechet', $dechet->id) }}">{{ $dechet->nom }}</a>--}}
                            {{--                            </h5>--}}
                            {{--                            <h6 class="fw-light mb-0">Type: {{ $dechet->typeDechet->nom }}</h6>--}}
                            <h6 class="fw-light mb-0">Quantity: {{ $dechet-> quantite  }}</h6>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <!-- Title -->
{{--                            <h5 class="card-title mt-2">--}}
{{--                                <a href="{{ route('backOffice.detailDechet', $dechet->id) }}">{{ $dechet->nom }}</a>--}}
{{--                            </h5>--}}
{{--                            <h6 class="fw-light mb-0">Type: {{ $dechet->typeDechet->nom }}</h6>--}}
                            <h6 class="fw-light mb-0">Status: {{ $dechet->etat ? 'Available' : 'Unavailable' }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Waste list END -->

        <!-- Modal for adding new waste -->
        <div class="modal fade" id="addWasteModal" tabindex="-1" aria-labelledby="addWasteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addWasteModalLabel">Add Waste</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.storeDechet') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Enter name</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label">Select type</label>--}}
{{--                                <select class="form-control" name="type_dechet_id" required>--}}
{{--                                    @foreach($typesDechets as $typeDechet)--}}
{{--                                        <option value="{{ $typeDechet->id }}">{{ $typeDechet->nom }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <x-input-error :messages="$errors->get('type_dechet_id')" class="mt-2"/>--}}
{{--                            </div>--}}

                            <div class="mb-3">
                                <label class="form-label">Upload image</label>
                                <input class="form-control" type="file" name="image" required/>
                                <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
