@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Edit Home Publish') }}</h5>
                        <small class="text-muted float-end">{{ __('Edit Home Publish') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name home') }}</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" value="{{ $home->name }}" class="form-control" id="name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="notes">{{ __('Notes') }}</label>
                                <div class="input-group input-group-merge">

                                    <textarea id="notes" class="form-control">{{ $home->notes }}</textarea>
                                </div>
                            </div>
                            <button type="button" onclick="UpdateHome('{{ $home->id }}')"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function UpdateHome(id) {
        let data = {

            name: document.getElementById('name').value,
            notes: document.getElementById('notes').value

        }
        update('/homePublish/update/' + id, data, '/homePublish/index')

    }

    function back() {

        window.history.back();
    }
</script>
