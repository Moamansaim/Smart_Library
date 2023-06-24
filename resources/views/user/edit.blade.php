@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Edit User') }}</h5>
                        <small class="text-muted float-end">{{ __('Edit User') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name user') }}</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" value="{{ $user->name }}" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Email') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" value="{{ $user->email }}" class="form-control" id="email">
                                </div>
                            </div>

                            <button type="button" onclick="UpdateUser({{ $user->id }})"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function UpdateUser(id) {
        let data = {

            name: document.getElementById('name').value,
            email: document.getElementById('email').value,


        }
        update('/user/update/' + id, data, '/user/index')

    }

    function back() {

        window.history.back();
    }
</script>
