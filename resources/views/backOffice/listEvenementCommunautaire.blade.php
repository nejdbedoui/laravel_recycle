@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Community Events List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Community Events List</h1>
                    <div class="d-grid"><a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                           class="btn btn-primary-soft mb-0"><i class="bi bi-person-fill-add me-2"></i>Add
                            Community Events</a></div>
                </div>
            </div>
        </div>

        <!-- agent list START -->
        <div class="row g-4">
            @foreach ($evenements as $evenement)
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-transparent">
                        <!-- Image -->
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $evenement->image) }}" class="card-img"
                                 alt="{{ $evenement->nom }}">
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
                                        <!-- dropdown items -->
                                        <ul class="dropdown-menu dropdown-menu-end min-w-auto shadow rounded small"
                                            aria-labelledby="dropdownAction1">
                                            <li><a href="{{ route('backOffice.editEvenementCommunautaire', $evenement->id) }}" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                                        class="bi bi-pencil-square fa-fw me-2"></i>Edit</a></li>
                                            <li>
                                                <form method="POST" action="{{ route('backOffice.deleteEvenementCommunautaire', $evenement->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"><i class="bi bi-trash fa-fw me-2"></i>Remove</button>
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
                            <h5 class="card-title mt-2">
                                <a href="{{ route('backOffice.detailEvenementCommunautaire', $evenement->id) }}">{{ $evenement->nom }}</a>
                            </h5>
                            <h6 class="fw-light mb-0">Date: {{ ($evenement->date) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Community Events</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('backOffice.storeEvenementCommunautaire') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Enter name</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Enter date</label>
                                <x-text-input class="form-control" type="date" name="date" required/>
                                <x-input-error :messages="$errors->get('date')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Enter description</label>
                                <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                          required></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Community Events</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('backOffice.updateEvenementCommunautaire', ['id' => $evenement->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Enter name</label>
                                <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $evenement->nom) }}" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Enter date</label>
                                <x-text-input class="form-control" type="date" name="date" value="{{ old('date', $evenement->date) }}" required/>
                                <x-input-error :messages="$errors->get('date')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Enter description</label>
                                <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                          required>{{ old('description', $evenement->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload image</label>
                                <input class="form-control" type="file" name="image"/>
                                <x-input-error :messages="$errors->get('image')" class="mt-2"/>

                                @if($evenement->image)
                                    <div class="mt-3">
                                        <p>Current Image:</p>
                                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="Event Image" style="max-width: 100%; height: auto;">
                                    </div>
                                @endif
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
