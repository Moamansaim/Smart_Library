@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Create User') }}</h5>
                        <small class="text-muted float-end">{{ __('Create User') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name user') }}</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Email') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Password Confirmation') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="password_confirmation">
                                </div>
                            </div>
                            <button type="button" onclick="CreateUser()"
                                class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function CreateUser() {
        let data = {

            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value

        }
        store('/user/store', data)

    }

    function back() {

        window.history.back();
    }
</script>
