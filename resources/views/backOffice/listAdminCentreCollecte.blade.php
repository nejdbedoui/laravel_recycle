@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Collection Center Admin List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Collection Center Admin List</h1>
                    <div class="d-grid"><a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary-soft mb-0"><i class="bi bi-person-fill-add me-2"></i>Add Collection Center Admin</a>	</div>
                </div>
            </div>
        </div>

        <!-- Search and select START -->
        <div class="row g-3 align-items-center justify-content-between mb-5">
            <!-- Search -->
            <div class="col-md-12">
                <form class="rounded position-relative">
                    <input class="form-control pe-5" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
                </form>
            </div>
        </div>
        <!-- Search and select END -->

        <!-- agent list START -->
        <div class="row g-4">
            @foreach ($adminCentreCollectes as $adminCentreCollecte)
                <!-- Card item -->
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card border h-100">
                        <!-- Card body -->
                        <div class="card-body text-center pb-0">
                            <!-- Avatar Image -->
                            <div class="avatar avatar-xl flex-shrink-0 mb-3">
                                <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $adminCentreCollecte->image) }}" alt="avatar">
                            </div>
                            <!-- Title -->
                            <h5 class="mb-1">{{ $adminCentreCollecte->name }}</h5>
                            <small><i class="bi bi-person-badge me-1"></i>{{ $adminCentreCollecte->matricule }}</small>
                            <!-- Info and rating -->
                            <div class="d-flex justify-content-between mt-3">
                                <h6 class="mb-0 small"><span class="fw-light">Email Address:</span></h6>
                                <h6 class="mb-0 small">{{ $adminCentreCollecte->email }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <h6 class="mb-0 small"><span class="fw-light">Phone Number:</span></h6>
                                <h6 class="mb-0 small">{{ $adminCentreCollecte->telephone }}</h6>
                            </div>
                        </div>
                        <!-- card footer -->
                        <div class="card-footer d-flex gap-3 align-items-center">
                            <a href="{{ route('backOffice.detailAdminCentreCollecte', $adminCentreCollecte->id) }}" class="btn btn-sm btn-primary-soft mb-0 w-100">View detail</a>

                            <!-- Toggle enable/disable buttons -->
                            @if($adminCentreCollecte->enable)
                                <form action="{{ route('user.disable', $adminCentreCollecte->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger-soft flex-shrink-0 mb-0">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.enable', $adminCentreCollecte->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info-soft flex-shrink-0 mb-0">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                </form>
                            @endif
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Collection Center Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="text-start" method="POST" action="{{ route('backOffice.addAdminCentreCollecte') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Enter name</label>
                            <x-text-input class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Enter email</label>
                            <x-text-input class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="mb-3 position-relative">
                            <label class="form-label">Enter password</label>
                            <x-text-input id="psw-input" class="form-control fakepassword"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password" />
                            <span class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3">
											<i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
										</span>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <x-text-input class="form-control"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Button -->
                        <div><button type="submit" data-bs-dismiss="modal" class="btn btn-primary w-100 mb-0">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
