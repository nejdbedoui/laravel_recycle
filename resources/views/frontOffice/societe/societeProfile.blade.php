@extends('frontOffice.societe.societeDashboard')

@section('dashboard-content')
    <div class="col-lg-8 col-xl-9">
        <div class="vstack gap-4">

            <!-- Personal info START -->
            <div class="card border">
                <!-- Card header -->
                <div class="card-header border-bottom">
                    <h4 class="card-header-title">Personal Information</h4>
                </div>

                <!-- Card body START -->
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form >

                    <!-- Form START -->
                    <form class="row g-3" method="post" action="{{ route('frontOffice.societeProfile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Profile photo -->
                        <div class="col-12">
                            <label class="form-label">Upload your profile photo<span
                                    class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                    <!-- Avatar place holder -->
                                    <span class="avatar avatar-xl">
												<img id="uploadfile-1-preview"
                                                     class="avatar-img rounded-circle border border-white border-3 shadow"
                                                     src="{{ asset('storage/' . $user->image) }}" alt="">
											</span>
                                </label>
                                <!-- Upload button -->
                                <label class="btn btn-sm btn-primary-soft mb-0" for="uploadfile-1">Change</label>
                                <input id="uploadfile-1" class="form-control d-none" type="file" name="image">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Full Name<span class="text-danger">*</span></label>
                            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email address<span class="text-danger">*</span></label>
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-6">
                            <label class="form-label">Mobile number<span class="text-danger">*</span></label>
                            <x-text-input class="form-control" type="text" name="telephone" :value="old('telephone', $user->telephone)" required autocomplete="telephone" />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                        <!-- Registration Number -->
                        <div class="col-md-6">
                            <label class="form-label">Registration Number<span class="text-danger">*</span></label>
                            <x-text-input class="form-control" type="text" name="matricule" :value="old('matricule', $user->matricule)" required autocomplete="matricule" />
                            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <x-text-input class="form-control" type="text" name="adresse" :value="old('adresse', $user->adresse)" required autocomplete="adresse" />
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                        </div>

                        <!-- Resend Verification Email Link -->
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="col-12">
                                <p class="text-sm mt-2 text-gray-800">
                                    Your email address is unverified.
                                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Click here to re-send the verification email.
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        A new verification link has been sent to your email address.
                                    </p>
                                @endif
                            </div>
                        @endif

                        <!-- Button -->
                        <div class="col-12 text-end">
                            <x-primary-button class="btn btn-primary mb-0">{{ __('Save Changes') }}</x-primary-button>
                        </div>
                    </form>
                    <!-- Form END -->
                </div>
                <!-- Card body END -->
            </div>
            <!-- Personal info END -->

            <!-- Update Password START -->
            <div class="card border">
                <!-- Card header -->
                <div class="card-header border-bottom">
                    <h4 class="card-header-title">Update Password</h4>
                </div>

                <!-- Card body START -->
                <form class="card-body" method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <!-- Current password -->
                    <div class="mb-3">
                        <label class="form-label">Current password</label>
                        <x-text-input name="current_password" type="password" class="form-control" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                    <!-- New password -->
                    <div class="mb-3">
                        <label class="form-label"> Enter new password</label>
                        <div class="input-group">
                            <x-text-input id="psw-input" name="password" type="password" class="form-control fakepassword" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            <span class="input-group-text p-0 bg-transparent">
										<i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
									</span>
                        </div>
                    </div>
                    <!-- Confirm -->
                    <div class="mb-3">
                        <label class="form-label">Confirm new password</label>
                        <x-text-input name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mb-0">Change Password</button>
                    </div>
                </form>
                <!-- Card body END -->
            </div>
            <!-- Update Password END -->
        </div>
    </div>
@endsection
