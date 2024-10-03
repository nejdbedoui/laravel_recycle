@extends('index')
@section('title', 'EcoCycle - Matières Premières')


@section('content')
<section>
    @yield('content')

        <!-- Header START -->
        <header class="navbar-light header-sticky">
            <!-- Logo Nav START -->
            <nav class="navbar navbar-expand-xl">
                <div class="container">
                    <!-- Logo START -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="light-mode-item navbar-brand-item" src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                        <img class="dark-mode-item navbar-brand-item" src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                    </a>
                    <!-- Logo END -->

                    <!-- Profile and Notification START -->
                    <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">

                        <!-- Profile dropdown START -->
                        <li class="nav-item ms-3 dropdown">
                            <!-- Avatar -->
                            <a class="avatar avatar-xs p-0" href="#" id="profileDropdown" role="button"
                               data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img class="avatar-img rounded-circle" src="{{ asset('storage/' . Auth::user()->image) }}" alt="avatar">
                            </a>

                            <!-- Profile dropdown START -->
                            <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                                aria-labelledby="profileDropdown">
                                <!-- Profile info -->
                                <li class="px-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <!-- Avatar -->
                                        <div class="avatar me-3">
                                            <img class="avatar-img rounded-circle shadow"
                                                 src="{{ asset('storage/' . Auth::user()->image) }}" alt="avatar">
                                        </div>
                                        <div>
                                            <a class="h6 mt-2 mt-sm-0" href="">{{ Auth::user()->name }}</a>
                                            <p class="small m-0">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>

                                <!-- Links -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url ('/adminCentreRecyclage/profile') }}"><i
                                            class="bi bi-person fa-fw me-2"></i>My Profile</a></li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link class="dropdown-item bg-danger-soft-hover" :href="route('logout')"
                                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <i class="bi bi-power fa-fw me-2"></i>
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- Dark mode options START -->
                                <li>
                                    <div
                                        class="nav-pills-primary-soft theme-icon-active d-flex justify-content-between align-items-center p-2 pb-0">
                                        <span>Mode:</span>
                                        <button type="button" class="btn btn-link nav-link text-primary-hover mb-0 p-0"
                                                data-bs-theme-value="light" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-sun fa-fw mode-switch"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-link nav-link text-primary-hover mb-0 p-0"
                                                data-bs-theme-value="dark" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
                                                <path
                                                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                        <button type="button"
                                                class="btn btn-link nav-link text-primary-hover mb-0 p-0 active"
                                                data-bs-theme-value="auto" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-circle-half fa-fw mode-switch"
                                                 viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                                <!-- Dark mode options END-->
                            </ul>
                            <!-- Profile dropdown END -->
                        </li>
                        <!-- Profile dropdown END -->

                    </ul>
                    <!-- Profile and Notification START -->

                </div>
            </nav>
            <!-- Logo Nav END -->
        </header>
        <!-- Header END -->

        <!-- **************** MAIN CONTENT START **************** -->
        <main>

            <!-- =======================
            Menu item START -->
            <section class="pt-4">
                <div class="container">
                    <div class="card rounded-3 border p-3 pb-2">
                        <!-- Avatar and info START -->
                        <div class="d-sm-flex align-items-center">
                            <div class="avatar avatar-xl mb-2 mb-sm-0">
                                <img class="avatar-img rounded-circle" src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                            </div>
                            <h4 class="mb-2 mb-sm-0 ms-sm-3"><span class="fw-light">Hi</span> {{ Auth::user()->name }}</h4>
                        </div>
                        <!-- Avatar and info START -->

                        <!-- Responsive navbar toggler -->
                        <button class="btn btn-primary w-100 d-block d-xl-none mt-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#dashboardMenu"
                                aria-controls="dashboardMenu">
                            <i class="bi bi-list"></i> Dashboard Menu
                        </button>

                        <!-- Nav links START -->
                        <div class="offcanvas-xl offcanvas-end mt-xl-3" tabindex="-1" id="dashboardMenu">
                            <div class="offcanvas-header border-bottom p-3">
                                <h5 class="offcanvas-title">Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        data-bs-target="#dashboardMenu" aria-label="Close"></button>
                            </div>
                            <!-- Offcanvas body -->
                            <div class="offcanvas-body p-3 p-xl-0">
                                <!-- Nav item -->
                                <div class="navbar navbar-expand-xl">
                                    <ul class="navbar-nav navbar-offcanvas-menu">

                                        <li class="nav-item"><a class="nav-link active" href="agent-dashboard.html"><i
                                                    class="bi bi-house-door fa-fw me-1"></i>Dashboard</a></li>

                                        <li class="nav-item"><a class="nav-link" href="{{url('/matiere-premiere')}}"><i
                                                    class="bi bi-journals fa-fw me-1"></i>List of raw material</a></li>

                                        <li class="nav-item"><a class="nav-link" href="agent-bookings.html"><i
                                                    class="bi bi-bookmark-heart fa-fw me-1"></i>Bookings</a></li>

                                        <li class="nav-item"><a class="nav-link" href="agent-activities.html"><i
                                                    class="bi bi-bell fa-fw me-1"></i>Activities</a></li>

                                        <li class="nav-item"><a class="nav-link" href="agent-earnings.html"><i
                                                    class="bi bi-graph-up-arrow fa-fw me-1"></i>Earnings</a></li>

                                        <li class="nav-item"><a class="nav-link" href="agent-reviews.html"><i
                                                    class="bi bi-star fa-fw me-1"></i>Reviews</a></li>

                                        <li><a class="nav-link" href="agent-settings.html"><i
                                                    class="bi bi-gear fa-fw me-1"></i>Settings</a></li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="dropdoanMenu"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-list-ul fa-fw me-1"></i>Dropdown
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdoanMenu">
                                                <!-- Dropdown menu -->
                                                <li><a class="dropdown-item" href="#">Item 1</a></li>
                                                <li><a class="dropdown-item" href="#">Item 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Nav links END -->
                    </div>
                </div>
            </section>

  <section class="pt-0">
	<div class="container vstack gap-4">
		<!-- Title START -->
		<div class="row">
			<div class="col-12">
				<h1 class="fs-4 mb-0"><i class="bi bi-journals fa-fw me-1"></i>Matières Premières</h1>
			</div>
		</div>

	<!-- Matières Premières table START -->
    <div class="row">
			<div class="col-12">
				<div class="card border">
					<!-- Card header START -->
					<div class="card-header border-bottom">
						<h5 class="card-header-title">Liste des matières Premières</h5>
					</div>
					<!-- Card header END -->
					<div class="card-body">

            <div class="pull-right mb-2">
                <!-- Button to trigger modal -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMatierePremiereModal">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
            </div>    
            <form method="GET" action="{{ route('matiere-premiere.index') }}" class="mb-3">
            <div class="input-group mb-3">
        <input type="text" id="search" class="form-control" placeholder="Rechercher par nom ou quantité" value="{{ request('search') }}">
    </div>
</form>
						
                <!-- Success message -->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                                <p>{{ $message }}</p>
                </div>
                @endif

    <!-- Table to display data -->
  <!-- Matières Premières list START -->
  <div class="table-responsive border-0">
  @if ($matieresPremieres->count())
  <table class="table align-middle p-4 mb-0 table-hover table-shrink  text-center">
            <!-- Table head -->
               
            <thead class="table-light">
               <tr>
                   <th scope="col" class="border-0">S.No</th>
                   <th scope="col" class="border-0">Nom</th>
                   <th scope="col" class="border-0">Quantité</th>
                   <th scope="col" class="border-0 rounded-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matieresPremieres as $matierePremiere)
                <tr>
                    <td>{{ $matierePremiere->id }}</td>
                    <td>{{ $matierePremiere->nom }}</td>
                    <td>{{ $matierePremiere->quantite }}</td>
                    <td class="action-buttons">
                        <a class="btn btn-outline-info btn-sm" href="{{ route('matiere-premiere.show', $matierePremiere->id) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('matiere-premiere.edit', $matierePremiere->id) }}">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('matiere-premiere.destroy', $matierePremiere->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière première ?')">
                              <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-4">
    {!! $matieresPremieres->links('pagination::bootstrap-5') !!}
</div>

<style>
    .pagination .page-item {
        margin: 0 5px; /* Adjust the value as needed for your desired gap */
    }
</style>

@endif

</div>

<!-- Modal for adding a new Matière Première -->
<div class="modal fade" id="addMatierePremiereModal" tabindex="-1" aria-labelledby="addMatierePremiereLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMatierePremiereLabel">Ajouter Matière Première</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('matiere-premiere.store') }}" method="POST">
                    @csrf
                    <!-- Nom Field -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <!-- Quantité Field -->
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantite" name="quantite" required>
                    </div>

                    <div class="form-group">
                        <label for="centre_recyclage_id">Centre de Recyclage</label>
                        <select name="centre_recyclage_id" id="centre_recyclage_id" class="form-control" required>
                            @foreach($centres as $centre)
                            <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<!-- Footer START -->
<footer class="bg-dark p-3">
    <div class="container">
        <div class="row align-items-center">

            <!-- Widget -->
            <div class="col-md-3">
                <div class="text-center text-md-start mb-3 mb-md-0">
                    <a href="{{ url('/') }}">
                        <img class="h-50px" src="{{ Vite::asset('resources/assets/images/logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>

            <!-- Widget -->
            <div class="col-md-5">
                <div class="text-body-secondary text-primary-hover"> Copyrights ©2024 MASTERMINDS. Build by <a href="" class="text-body-secondary">ESPRIT</a>.
                </div>
            </div>

            <!-- Widget -->
            <div class="col-md-4">
                <ul class="list-inline mb-0 text-center text-md-end">
                    <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-facebook"></i></a></li>
                    <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-instagram"></i></a></li>
                    <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-linkedin-in"></i></a></li>
                    <li class="list-inline-item ms-2"><a href=""><i class="text-white fab fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- =======================
Footer END -->
<script>
    // Listen for input changes
    document.getElementById('search').addEventListener('input', function() {
        const searchQuery = this.value;

        // Create a new URL with the search parameter
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchQuery);

        // Redirect to the new URL
        window.location.href = url.toString();
    });
</script>
@endsection
