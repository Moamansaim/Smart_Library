@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Changing Password') }}</h5>
                        <small class="text-muted float-end">{{ __('Changing Password') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('New Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="new_password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Password Confirmation') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="new_password_confirmation">
                                </div>
                            </div>

                            <button type="button" onclick="ChangPassword()"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



<script>
    function ChangPassword() {

        let data = {

            password: document.getElementById('password').value,
            new_password: document.getElementById('new_password').value,
            new_password_confirmation: document.getElementById('new_password_confirmation').value,

        };

        store('/password/Chang', data)


    }

    function back() {

        window.history.back();
    }
</script>
