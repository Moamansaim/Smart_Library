@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Create Admin') }}</h5>
                        <small class="text-muted float-end">{{ __('Create Admin') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name admin') }}</label>
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
                            <div class="mb-3">
                                <label for="role_id" class="form-label">{{ __('Guard name') }}</label>
                                <select class="form-select" id="role_id" aria-label="Default select example">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Iamge admin') }}</label>
                                <input class="form-control" id="image" type="file">
                            </div>
                            <button type="button" onclick="CreateAdmin()"
                                class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function CreateAdmin() {

        let formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('password_confirmation', document.getElementById('password_confirmation').value);
        formData.append('role_id', document.getElementById('role_id').value);
        formData.append('image', document.getElementById('image').files[0]);
        store('/admin/store', formData);

    }

    function back() {

        window.history.back();
    }
</script>
