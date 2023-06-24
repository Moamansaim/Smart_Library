@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card mb-4">
            <h5 class="card-header">{{ $profile->first_name ?? 'admin' }} {{ $profile->last_name ?? 'admin' }}</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">

                    @if ($profile->image ?? '')
                        <img src="{{ asset('storage/profile/' . $profile->image) }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar">
                    @endif


                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="formAccountSettings">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                            <input class="form-control" value="{{ $profile->first_name ?? null }}" type="text"
                                id="firstName" name="firstName">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                            <input class="form-control" value="{{ $profile->last_name ?? null }}" type="text"
                                name="lastName" id="lastName">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input class="form-control" value="{{ $profile->email ?? null }}" type="text" id="email"
                                name="email"placeholder="john.doe@example.com">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">{{ __('Organization') }}</label>
                            <input type="text" value="{{ $profile->organization ?? null }}" class="form-control"
                                id="organization" name="organization">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">{{ __('Phone Number') }}</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"></span>
                                <input type="text" value="{{ $profile->phone_number ?? null }}" id="phoneNumber"
                                    name="phoneNumber" class="form-control" placeholder="202 555 0111">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">{{ __('Address') }}</label>
                            <input type="text" value="{{ $profile->address ?? null }}" class="form-control"
                                id="address" name="address" placeholder="Address">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">{{ __('State') }}</label>
                            <input class="form-control" value="{{ $profile->state ?? null }}" type="text" id="state"
                                name="state" placeholder="California">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">{{ __('Zip Code') }}</label>
                            <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465"
                                maxlength="6">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="Language" class="form-label">{{ __('Language') }}</label>
                            <input type="text" value="{{ $profile->language ?? null }}" class="form-control"
                                id="Language" maxlength="6">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">{{ __('Country') }}</label>
                            <input type="text" value="{{ $profile->country ?? null }}" class="form-control"
                                id="zipCode" maxlength="6">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">{{ __('Currency') }} </label>
                            <input type="text" value="{{ $profile->currency ?? null }}" class="form-control"
                                id="zipCode" maxlength="6">
                        </div>


                    </div>

                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection


<script>
    function back() {

        window.history.back();
    }
</script>
