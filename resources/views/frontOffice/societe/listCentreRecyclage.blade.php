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
                                <h4 class="card-header-title">Recycling Center List</h4>
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
                                            <th scope="col" class="border-0 rounded-start">Name</th>
                                            <th scope="col" class="border-0">Address</th>
                                            <th scope="col" class="border-0">Capacity (Kg)</th>
                                            <th scope="col" class="border-0 rounded-end">Action</th>
                                        </tr>
                                        </thead>

                                        <!-- Table body START -->
                                        <tbody class="border-top-0">
                                        <!-- Table item -->
                                        @foreach ($centreRecyclages as $centreRecyclage)
                                            <tr>
                                                <td> <h6 class="mb-0">{{ $centreRecyclage->nom }}</h6> </td>
                                                <td> <h6 class="mb-0 fw-light">{{ $centreRecyclage->adresse }}</h6> </td>
                                                <td> <h6 class="mb-0 fw-light">{{ $centreRecyclage->capacite }}</h6> </td>
                                                <td> <a href="{{ route('frontOffice.societe.detailCentreRecyclage', $centreRecyclage->id) }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-eye-fill fa-fw"></i></a> </td>
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
@endsection
