@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Create category') }}</h5>
                        <small class="text-muted float-end">{{ __('Create category') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name Category') }}</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="notes">{{ __('Notes') }}</label>
                                <div class="input-group input-group-merge">

                                    <textarea id="notes" class="form-control"></textarea>
                                </div>
                            </div>
                            <button type="button" onclick="CreateCategory()"
                                class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function CreateCategory() {
        let data = {

            name: document.getElementById('name').value,
            notes: document.getElementById('notes').value

        }
        store('/category/store', data)

    }

    function back() {

        window.history.back();
    }
</script>
