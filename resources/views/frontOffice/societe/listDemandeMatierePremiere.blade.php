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
                                <h4 class="card-header-title">Raw Material Demand List</h4>
                            </div>
                            <!-- Card header END -->

                            <!-- Card body START -->
                            <div class="card-body">

                                <!-- Hotel room list START -->
                                <div class="table-responsive border-0">
                                    <table class="table align-middle p-4 mb-0 table-hover table-shrink">
                                        <!-- Table head -->
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 rounded-start">Recycling Center</th>
                                            <th scope="col" class="border-0">Raw Material</th>
                                            <th scope="col" class="border-0">Quantity (Kg)</th>
                                            <th scope="col" class="border-0">Order Status</th>
                                            <th scope="col" class="border-0">Order Date</th>
                                            <th scope="col" class="border-0 rounded-end">Action</th>
                                        </tr>
                                        </thead>

                                        <!-- Table body START -->
                                        <tbody class="border-top-0">
                                        <!-- Table item -->
                                        @foreach ($demandesMatierePremieres as $demandesMatierePremiere)
                                            <tr>
                                                <td> <h6 class="mb-0 fw-light">{{ $demandesMatierePremiere->matierePremiere->centreRecyclage->nom }}</h6> </td>
                                                <td> <h6 class="mb-0 fw-light">{{ $demandesMatierePremiere->matierePremiere->nom }}</h6> </td>
                                                <td> <h6 class="mb-0 fw-light">{{ $demandesMatierePremiere->quantite }}</h6> </td>
                                                <td> <h6 class="mb-0">{{ $demandesMatierePremiere->etat }}</h6> </td>
                                                <td> <h6 class="mb-0 fw-light">{{ $demandesMatierePremiere->created_at }}</h6> </td>
                                                <td>
                                                    <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                        @if ($demandesMatierePremiere->etat == 'On_Hold')
                                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $demandesMatierePremiere->id }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                                            <form action="{{ route('frontOffice.societe.deleteDemandeMatierePremiere', $demandesMatierePremiere->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger-soft px-2 mb-0">
                                                                    <i class="bi bi-trash fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!-- Table body END -->
                                    </table>
                                </div>
                                <!-- Hotel room list END -->
                            </div>
                            <!-- Card body END -->
                        </div>
                    </div>
                </div>
                <!-- Booking table END -->
            </div>
        </section>
    </div>

    <!-- Modal for each demandesMatierePremiere -->
    @foreach ($demandesMatierePremieres as $demandesMatierePremiere)
        <div class="modal fade" id="exampleModal{{ $demandesMatierePremiere->id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Raw Material Demand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('frontOffice.societe.updateDemandeMatierePremiere', $demandesMatierePremiere->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Quantity input -->
                            <div class="mb-3">
                                <label class="form-label">Enter quantity (Kg)</label>
                                <input type="number" class="form-control" name="quantite"
                                       value="{{ old('quantite', $demandesMatierePremiere->quantite) }}" required autofocus>
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
