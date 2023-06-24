@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Create permissions') }}</h5>
                        <small class="text-muted float-end">{{ __('Create permissions') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name permissions') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="guard_name" class="form-label">{{ __('Guard name') }}</label>
                                <select class="form-select" id="guard_name" aria-label="Default select example">
                                    <option value="admin">admin</option>
                                    <option value="web">user</option>
                                </select>
                            </div>

                            <button type="button" onclick="Createpermissions()"
                                class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function Createpermissions() {
        let data = {
            name: document.getElementById('name').value,
            guard_name: document.getElementById('guard_name').value,
        }
        store('/permissions/store', data)

    }

    function back() {

        window.history.back();
    }
</script>
