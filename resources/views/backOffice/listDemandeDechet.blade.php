@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Waste Demand List</h1>
                </div>
            </div>
        </div>

        <!-- Type de déchets list START -->
        <div class="row g-4">
            <div class="card shadow mt-5">

                <!-- Card body START -->
                <div class="card-body">
                    <!-- Table head -->
                    <div class="bg-light rounded p-3 d-none d-sm-block">
                        <div class="row row-cols-7 g-4">
                            <div class="col"><h6 class="mb-0">Recycling Center</h6></div>
                            <div class="col"><h6 class="mb-0">Collection Center</h6></div>
                            <div class="col"><h6 class="mb-0">Raw Material</h6></div>
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
                                <small class="d-block d-sm-none">Recycling Center:</small>
                                <h6 class="fw-light mb-0">{{ $demandeDechet->centreRecyclage->nom }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-sm-none">Company:</small>
                                <h6 class="fw-light mb-0">{{ $demandeDechet->dechet->centreCollecte->nom }}</h6>
                            </div>

                            <!-- Data item -->
                            <div class="col">
                                <small class="d-block d-sm-none">Raw Material:</small>
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
                                @php
                                    // Vérification directe de l'existence d'un déplacement pour la demande de déchet
                                    $deplacementExiste = \App\Models\Deplacement::where('demande_dechet_id', $demandeDechet->id)->exists();
                                @endphp

                                @if (!$deplacementExiste)
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $demandeDechet->id }}"
                                       class="btn btn-sm btn-primary-soft px-2 mb-0">
                                        Add Trip
                                    </a>
                                @endif
                            </div>


                        </div>
                    @endforeach
                </div>
                <!-- Card body END -->
            </div>
        </div>
    </div>


    <!-- Modal -->
    @foreach ($demandeDechets as $demandeDechet)
        <div class="modal fade" id="exampleModal{{ $demandeDechet->id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel{{ $demandeDechet->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $demandeDechet->id }}">Add Trip</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST"
                              action="{{ route('backOffice.storeTrip', ['demandeDechetId' => $demandeDechet->id]) }}">
                            @csrf

                            <input type="hidden" name="demande_dechet_id" value="{{ $demandeDechet->id }}">

                            <div class="mb-3">
                                <label class="form-label">Enter Date</label>
                                <input class="form-control date-input" type="date" name="date"
                                       id="date-input-{{ $demandeDechet->id }}" required>
                                <x-input-error :messages="$errors->get('date')" class="mt-2"/>
                            </div>

                            <!-- Chauffeur select input -->
                            <div class="mb-3">
                                <label for="chauffeur_id" class="form-label">Driver</label>
                                <select class="form-select" name="chauffeur_id"
                                        id="chauffeur-select-{{ $demandeDechet->id }}" required>
                                    <option value="" disabled selected>Select a driver</option>
                                </select>
                                <x-input-error :messages="$errors->get('chauffeur_id')" class="mt-2"/>
                            </div>

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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner tous les champs de date dans chaque modal
        document.querySelectorAll('.date-input').forEach(function (dateInput) {
            dateInput.addEventListener('change', function () {
                var selectedDate = this.value;  // Récupérer la date sélectionnée
                var demandeId = this.closest('.modal-body').querySelector('input[name="demande_dechet_id"]').value; // ID de la demande

                if (selectedDate) {
                    // Envoyer la requête AJAX
                    fetch(`/getAvailableDrivers?date=${selectedDate}`)
                        .then(response => response.json())
                        .then(data => {
                            // Sélectionner le select du chauffeur correspondant
                            var chauffeurSelect = document.querySelector(`#chauffeur-select-${demandeId}`);
                            chauffeurSelect.innerHTML = '<option value="" disabled selected>Select a driver</option>';

                            // Si des chauffeurs sont disponibles, les ajouter dans le select
                            if (data.length > 0) {
                                data.forEach(function (chauffeur) {
                                    var option = document.createElement('option');
                                    option.value = chauffeur.id;
                                    option.textContent = `${chauffeur.matricule} : ${chauffeur.name}`;
                                    chauffeurSelect.appendChild(option);
                                });
                            } else {
                                // Aucun chauffeur disponible
                                var option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No drivers available';
                                option.disabled = true;
                                chauffeurSelect.appendChild(option);
                            }
                        })
                        .catch(error => console.error('Error fetching drivers:', error));
                }
            });
        });
    });

</script>
