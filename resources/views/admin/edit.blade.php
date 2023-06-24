@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Edit Admin') }}</h5>
                        <small class="text-muted float-end">{{ __('Edit Admin') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name admin') }}</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" value="{{ $admin->name }}" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Email') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" value="{{ $admin->email }}" class="form-control" id="email">
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

                            <button type="button" onclick="UpdateAdmin({{ $admin->id }})"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function UpdateAdmin(id) {


        let formData = new FormData();
        formData.append('_method', 'PUT')
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('role_id', document.getElementById('role_id').value);
        if (document.getElementById('image').files[0] != undefined) {
            formData.append('image', document.getElementById('image').files[0]);
        }
        updateFormData('/admin/update/' + id, formData, '/admin/index')

    }

    function back() {

        window.history.back();
    }
</script>
