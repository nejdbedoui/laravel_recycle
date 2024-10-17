@extends('frontOffice.chauffeur.chauffeurDashboard')

@section('dashboard-content')

    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-truck fa-fw me-1"></i>Trips List</h1>
                </div>
            </div>
            <!-- Title END -->

            <div class="col-lg-8 col-xl-12">
                <div class="vstack gap-4">

                    <!-- Personal info START -->
                    <div class="card border">

                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Table head -->
                            <div class="bg-light rounded p-3 d-none d-sm-block">
                                <div class="row row-cols-7 g-4">
                                    <div class="col"><h6 class="mb-0">Recycling Center</h6></div>
                                    <div class="col"><h6 class="mb-0">Collection Center</h6></div>
                                    <div class="col"><h6 class="mb-0">Waste</h6></div>
                                    <div class="col"><h6 class="mb-0">Quantity (Kg)</h6></div>
                                    <div class="col"><h6 class="mb-0">Delivered Status</h6></div>
                                    <div class="col"><h6 class="mb-0">Delivered Date</h6></div>
                                    <div class="col"><h6 class="mb-0">Action</h6></div>
                                </div>
                            </div>

                            <!-- Table data -->
                            @foreach ($deplacements as $deplacement)
                                <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Recycling Center:</small>
                                        <h6 class="fw-light mb-0">{{ $deplacement->demandeDechet->centreRecyclage->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Collection Center:</small>
                                        <h6 class="fw-light mb-0">{{ $deplacement->demandeDechet->dechet->centreCollecte->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Waste:</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->demandeDechet->dechet->nom }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Quantity (Kg):</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->demandeDechet->quantite }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Delivered Status:</small>
                                        <h6 class="mb-0">{{ $deplacement->etat }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        <small class="d-block d-sm-none">Delivered Date:</small>
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->date }}</h6>
                                    </div>

                                    <!-- Data item -->
                                    <div class="col">
                                        @if ($deplacement->etat == 'In_Progress')
                                            <form
                                                action="{{ route('frontOffice.chauffeur.deliveredDeplacement', $deplacement->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary-soft mb-0">
                                                    Delivered
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
