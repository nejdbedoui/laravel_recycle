@extends('frontOffice.adminCentreRecyclage.adminCentreRecyclageDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-house-door fa-fw me-1"></i>Recycling Center Detail</h1>
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
                                        <a href="{{ route('frontOffice.adminCentreRecyclage.editCentreRecyclage', $centreRecyclage->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

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
                                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
                                                    class="bi bi-geo-alt-fill"></i></div>
                                            <div class="ms-2">
                                                <small>Address</small>
                                                <h6 class="fw-normal small mb-0"><a
                                                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($centreRecyclage->adresse) }}" target="_blank">{{ $centreRecyclage->adresse }}</a></h6>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-md bg-mode h6 mb-0 rounded-circle flex-shrink-0"><i
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

                            <div class="col-md-8 col-xxl-9">
                                <!-- Personal info START -->
                                <div class="card shadow">
                                    <!-- Card header -->
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal22" class="btn btn-sm btn-primary-soft">
                                            <i class="bi bi-plus-lg fa-fw me-2"></i>Add Recycling Type
                                        </a>
                                    </div>
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
                                                            <div class="col"><h6 class="mb-0">Name</h6></div>
                                                            <div class="col"><h6 class="mb-0">Description</h6></div>
                                                            <div class="col"><h6 class="mb-0">Action</h6></div>
                                                        </div>
                                                    </div>

                                                    <!-- Table data -->
                                                    @foreach ($typeRecyclages as $typeRecyclage)
                                                        <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <small class="d-block d-sm-none">Name:</small>
                                                                <h6 class="fw-light mb-0">{{ $typeRecyclage->nom }}</h6>
                                                            </div>

                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <small class="d-block d-sm-none">Description:</small>
                                                                <h6 class="mb-0 fw-normal">{{ $typeRecyclage->description }}</h6>
                                                            </div>

                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                                    <a data-bs-toggle="modal" data-bs-target="#editDechetModal2-{{ $typeRecyclage->id }}"  class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                                                    <form method="POST" action="{{ route('frontOffice.adminCentreRecyclage.deleteTypeRecyclage', $typeRecyclage->id) }}">
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

                                <div class="card shadow mt-4">
                                    <!-- Card header -->
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary-soft">
                                            <i class="bi bi-plus-lg fa-fw me-2"></i>Add Raw Material
                                        </a>
                                    </div>
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
                                                            <div class="col"><h6 class="mb-0">Name</h6></div>
                                                            <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                                            <div class="col"><h6 class="mb-0">Action</h6></div>
                                                        </div>
                                                    </div>

                                                    <!-- Table data -->
                                                    @foreach ($matierePremieres as $matierePremiere)
                                                        <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <small class="d-block d-sm-none">Name:</small>
                                                                <h6 class="fw-light mb-0">{{ $matierePremiere->nom }}</h6>
                                                            </div>

                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <small class="d-block d-sm-none">Quantity:</small>
                                                                <h6 class="mb-0 fw-normal">{{ $matierePremiere->quantite }}</h6>
                                                            </div>

                                                            <!-- Data item -->
                                                            <div class="col">
                                                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                                    <a data-bs-toggle="modal" data-bs-target="#editDechetModal-{{ $matierePremiere->id }}"  class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                                                    <form method="POST" action="{{ route('frontOffice.adminCentreRecyclage.deleteMatierePremiere', $matierePremiere->id) }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Recycling Center</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST"
                          action="{{ route('frontOffice.adminCentreRecyclage.updateCentreRecyclage', ['id' => $centreRecyclage->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $centreRecyclage->nom) }}" required/>
                            <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter Address</label>
                            <x-text-input class="form-control" type="text" name="adresse" value="{{ old('adresse', $centreRecyclage->adresse) }}" required/>
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter Capacity (Kg)</label>
                            <x-text-input class="form-control" type="number" name="capacite" value="{{ old('capacite', $centreRecyclage->capacite) }}" required/>
                            <x-input-error :messages="$errors->get('capacite')" class="mt-2"/>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Save changes</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Raw Material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST"
                          action="{{ route('frontOffice.adminCentreRecyclage.storeMatierePremiere') }}">
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

                        <div>
                            <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for updating type de déchet -->
    @foreach ($matierePremieres as $matierePremiere)
        <div class="modal fade" id="editDechetModal-{{ $matierePremiere->id }}" tabindex="-1" aria-labelledby="editDechetModalLabel-{{ $matierePremiere->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editDechetModalLabel-{{ $matierePremiere->id }}">Edit Raw Material</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('frontOffice.adminCentreRecyclage.updateMatierePremiere', ['id' => $matierePremiere->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $matierePremiere->nom) }}" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity (Kg)</label>
                                <x-text-input class="form-control" type="text" name="quantite" value="{{ old('quantite', $matierePremiere->quantite) }}" required/>
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="exampleModal22" tabindex="-1" aria-labelledby="exampleModalLabel22" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel22">Add Recycling Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST"
                          action="{{ route('frontOffice.adminCentreRecyclage.storeTypeRecyclage') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="nom" required/>
                            <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Enter description</label>
                            <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                      required></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
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
    @foreach ($typeRecyclages as $typeRecyclage)
        <div class="modal fade" id="editDechetModal2-{{ $typeRecyclage->id }}" tabindex="-1" aria-labelledby="editDechetModalLabel2-{{ $typeRecyclage->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editDechetModalLabel2-{{ $typeRecyclage->id }}">Edit Recycling Type</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('frontOffice.adminCentreRecyclage.updateTypeRecyclage', ['id' => $typeRecyclage->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $typeRecyclage->nom) }}" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                          required>{{ old('description', $typeRecyclage->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
