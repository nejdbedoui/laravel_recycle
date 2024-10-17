@extends('frontOffice.adminCentreRecyclage.adminCentreRecyclageDashboard')

@section('dashboard-content')
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-trash fa-fw me-1"></i>Waste Demand List</h1>
                </div>
            </div>

            <!-- Title -->
            <div class="card border">
                <div class="row g-4 mt-2 mb-2 me-2 ms-2">
                    <!-- Type de déchets list START -->

                    <div class="card shadow mt-5">

                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Table head -->
                            <div class="bg-light rounded p-3 d-none d-sm-block">
                                <div class="row row-cols-7 g-4">
                                    <div class="col"><h6 class="mb-0">Collection Center</h6></div>
                                    <div class="col"><h6 class="mb-0">Waste</h6></div>
                                    <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Status</h6></div>
                                    <div class="col"><h6 class="mb-0">Order Date</h6></div>
                                    <div class="col"><h6 class="mb-0">Action</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($demandeDechets as $demandeDechet)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Company:</small>
                                        <h6 class="fw-light mb-0">{{ $demandeDechet->dechet->centreCollecte->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Waste:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->dechet->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Quantity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->quantite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Status:</small>
                                        <h6 class="mb-0">{{ $demandeDechet->etat }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Order Date:</small>
                                        <h6 class="mb-0 fw-normal">{{ $demandeDechet->created_at }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        @if ($demandeDechet->etat == 'On_Hold')
                                            <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $demandeDechet->id }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                                <form action="{{ route('frontOffice.adminCentreRecyclage.deleteDemandeDechet', $demandeDechet->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-soft px-2 mb-0">
                                                        <i class="bi bi-trash fa-fw"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <!-- Card body END -->
                    </div>
                    <!-- Type de déchets list END -->
                </div>
            </div>

        </div>
    </section>

    <!-- Modal for each demandeDechet -->
    @foreach ($demandeDechets as $demandeDechet)
        <div class="modal fade" id="exampleModal{{ $demandeDechet->id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Waste Demand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('frontOffice.adminCentreRecyclage.updateDemandeDechet', $demandeDechet->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Quantity input -->
                            <div class="mb-3">
                                <label class="form-label">Enter quantity (Kg)</label>
                                <input type="number" class="form-control" name="quantite"
                                       value="{{ old('quantite', $demandeDechet->quantite) }}" required autofocus>
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                            </div>

                            <!-- Button -->
                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
