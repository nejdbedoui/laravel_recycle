@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Trips List</h1>
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
                            <div class="col"><h6 class="mb-0">Driver</h6></div>
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
                                <small class="d-block d-sm-none">Driver:</small>
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-xs flex-shrink-0">
                                        <img class="avatar-img rounded-circle"
                                             src="{{ asset('storage/' . $deplacement->chauffeur->image) }}"
                                             alt="avatar">
                                    </div>
                                    <!-- Info -->
                                    <div class="ms-2">
                                        <h6 class="mb-0 fw-normal">{{ $deplacement->chauffeur->matricule }}
                                            : {{ $deplacement->chauffeur->name }}</h6>
                                    </div>
                                </div>
                            </div>

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
                                @php
                                    $deplacementDate = \Carbon\Carbon::parse($deplacement->date)->startOfDay();
                                    $currentDate = \Carbon\Carbon::now()->startOfDay();

                                    $daysDifference = $currentDate->diffInDays($deplacementDate, false);
                                @endphp

                                @if ($deplacement->etat == 'In_Progress')
                                    @if ($daysDifference >= 2 && $deplacementDate > $currentDate)
                                        <div class="d-flex gap-2 mt-2 mt-sm-0">
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $deplacement->id }}"
                                               class="btn btn-sm btn-primary-soft px-2 mb-0"><i
                                                    class="bi bi-pencil-square fa-fw"></i></a>

                                            <form method="POST" action="{{ route('backOffice.deleteTrip', $deplacement->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-soft px-2 mb-0">
                                                    <i class="bi bi-trash fa-fw"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                <!-- Card body END -->
            </div>
        </div>

    </div>


    <!-- Modal update -->
    @foreach ($deplacements as $deplacement)
        <div class="modal fade" id="exampleModal{{ $deplacement->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Trip</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.updateTrip', ['id' => $deplacement->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Enter Date</label>
                                <input class="form-control date-input" type="date" name="date"
                                       value="{{ $deplacement->date }}" id="date-input-{{ $deplacement->id }}" required>
                                <x-input-error :messages="$errors->get('date')" class="mt-2"/>
                            </div>

                            <!-- Chauffeur select input -->
                            <div class="mb-3">
                                <label for="chauffeur_id" class="form-label">Driver</label>
                                <select class="form-select" name="chauffeur_id" id="chauffeur-select-{{ $deplacement->id }}" required>
                                    <option value="{{ $deplacement->chauffeur->id }}" selected>{{ $deplacement->chauffeur->matricule }} : {{ $deplacement->chauffeur->name }}</option>
                                    <!-- Les chauffeurs disponibles seront ajoutés ici via AJAX -->
                                </select>
                                <x-input-error :messages="$errors->get('chauffeur_id')" class="mt-2"/>
                            </div>

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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.date-input').forEach(function (dateInput) {
            dateInput.addEventListener('change', function () {
                var selectedDate = this.value;  // Récupérer la date sélectionnée
                var deplacementId = this.closest('.modal').id.replace('exampleModal', '');  // ID du déplacement

                if (selectedDate) {
                    // Envoyer la requête AJAX pour récupérer les chauffeurs disponibles
                    fetch(`/getAvailableDriversUpdate?date=${selectedDate}&deplacement_id=${deplacementId}`)
                        .then(response => response.json())
                        .then(data => {
                            var chauffeurSelect = document.querySelector(`#chauffeur-select-${deplacementId}`);

                            // Conserver l'option du chauffeur actuel (s'il est déjà sélectionné)
                            var currentSelectedDriver = chauffeurSelect.querySelector('option[selected]');
                            chauffeurSelect.innerHTML = '';  // Effacer les options actuelles

                            if (currentSelectedDriver) {
                                chauffeurSelect.appendChild(currentSelectedDriver);  // Réinsérer le chauffeur actuel
                            }

                            // Ajouter les chauffeurs disponibles (en excluant le chauffeur déjà sélectionné)
                            if (data.length > 0) {
                                data.forEach(function (chauffeur) {
                                    if (!currentSelectedDriver || chauffeur.id != currentSelectedDriver.value) {
                                        var option = document.createElement('option');
                                        option.value = chauffeur.id;
                                        option.textContent = `${chauffeur.matricule} : ${chauffeur.name}`;
                                        chauffeurSelect.appendChild(option);
                                    }
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
