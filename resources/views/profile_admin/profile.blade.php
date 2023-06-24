@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Profile Details') }}</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">

                    @if ($user->profile->image)
                        <img src="{{ asset('storage/profile/' . $user->profile->image) }}" alt="user-avatar"
                            class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar">
                    @endif

                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">{{ __('Upload new photo') }}</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden=""
                                accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">{{ __('Reset') }}</span>
                        </button>


                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="formAccountSettings">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                            <input class="form-control" value="{{ $user->profile->first_name ?? null }}" type="text"
                                id="firstName" name="firstName">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                            <input class="form-control" value="{{ $user->profile->last_name }}" type="text"
                                name="lastName" id="lastName">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input class="form-control" value="{{ $user->profile->email }}" type="text" id="email"
                                name="email"placeholder="john.doe@example.com">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">{{ __('Organization') }}</label>
                            <input type="text" value="{{ $user->profile->organization }}" class="form-control"
                                id="organization" name="organization">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">{{ __('Phone Number') }}</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">US (+1)</span>
                                <input type="text" value="{{ $user->profile->phone_number }}" id="phoneNumber"
                                    name="phoneNumber" class="form-control" placeholder="202 555 0111">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">{{ __('Address') }}</label>
                            <input type="text" value="{{ $user->profile->address }}" class="form-control" id="address"
                                name="address" placeholder="Address">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">{{ __('State') }}</label>
                            <input class="form-control" value="{{ $user->profile->state }}" type="text" id="state"
                                name="state" placeholder="California">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">{{ __('Zip Code') }}</label>
                            <input type="text" value="{{ $user->profile->zip_code }}" class="form-control"
                                id="zipCode" name="zipCode" placeholder="231465" maxlength="6">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">{{ __('Country') }}</label>
                            <select id="country" class="select2 form-select">
                                @foreach ($countries as $code => $value)
                                    <option value="{{ $code }}" @if ($code == $user->profile->country) selected @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="language" class="form-label">{{ __('Language') }}</label>
                            <select id="language" class="select2 form-select">
                                @foreach ($languages as $code => $value)
                                    <option value="{{ $code }}" @if ($code == $user->profile->language) selected @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="currency" class="form-label">{{ __('Currency') }}</label>
                            <select id="currency" class="select2 form-select">
                                @foreach ($currencies as $code => $value)
                                    <option value="{{ $value }}" @if ($value == $user->profile->currency) selected @endif>
                                        {{ $code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" onclick="UpdateProfile()" class="btn btn-primary me-2">Save
                            changes</button>
                        <button type="button" onclick="cancelProfile({{ $user->profile->id }})"
                            class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection


<script>
    function cancelProfile(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                trashItem(id);
            }
        })
    }


    function trashItem(id) {

        axios.delete('/profile/cancel/' + id)
            .then(function(response) {
                successDelete(response.data)
                window.location.herf = '/profile/myProfile'
                console.log(response);
            })
            .catch(function(error) {
                console.log(error.response.data);
            });

    }


    function successDelete(data) {

        Swal.fire({
            position: 'center',
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1500
        })
    }

    function UpdateProfile() {

        let formData = new FormData();
        if (document.getElementById('upload').files[0]) {
            formData.append('upload', document.getElementById('upload').files[0]);
        }
        formData.append('firstName', document.getElementById('firstName').value);
        formData.append('lastName', document.getElementById('lastName').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('organization', document.getElementById('organization').value);
        formData.append('phoneNumber', document.getElementById('phoneNumber').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('state', document.getElementById('state').value);
        formData.append('zipCode', document.getElementById('zipCode').value);
        formData.append('country', document.getElementById('country').value);
        formData.append('language', document.getElementById('language').value);
        formData.append('currency', document.getElementById('currency').value);
        store('/profile/update', formData)

    }

    function back() {

        window.history.back();
    }
</script>
