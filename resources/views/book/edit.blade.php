@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Edit Book') }}</h5>
                        <small class="text-muted float-end">{{ __('Edit Book') }}</small>
                    </div>
                    <div class="card-body">
                        <form id="restForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name Book') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" value="{{ $book->name }}" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Vresion') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="{{ $book->version }}" id="version">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="homePublish_id" class="form-label">{{ __('Language') }}</label>
                                <select class="form-select" id="language" aria-label="Default select example">
                                    <option value="en" @if ($book->language == 'en') selected @endif>English
                                    </option>
                                    <option value="ar" @if ($book->language == 'ar') selected @endif>Arabic</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">{{ __('Category') }}</label>
                                <select class="form-select" id="category_id" aria-label="Default select example">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $book->category_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="writer_id" class="form-label">{{ __('Writer') }}</label>
                                <select class="form-select" id="writer_id" aria-label="Default select example">
                                    @foreach ($writer as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $book->writer_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="homePublish_id" class="form-label">{{ __('Home Publish') }}</label>
                                <select class="form-select" id="homePublish_id" aria-label="Default select example">
                                    @foreach ($homePublish as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $book->homePublish_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" @if ($book->status == 'Active') checked @endif
                                    value="Active" type="checkbox" id="status">
                                <label class="form-check-label" for="status">{{ __('Status') }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Image book') }}</label>
                                <input class="form-control" id="image" type="file">
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">{{ __('Pdf book') }}</label>
                                <input class="form-control" id="pdf" type="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="notes">{{ __('Notes') }}</label>
                                <div class="input-group input-group-merge">
                                    <textarea id="notes" class="form-control">{{ $book->notes }}</textarea>
                                </div>
                            </div>
                            <button type="button" onclick="EditBook('{{ $book->id }}')"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function EditBook(id) {

        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', document.getElementById('name').value);
        formData.append('version', document.getElementById('version').value);
        formData.append('language', document.getElementById('language').value);
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('writer_id', document.getElementById('writer_id').value);
        formData.append('homePublish_id', document.getElementById('homePublish_id').value);
        formData.append('status', document.getElementById('status').checked);
        formData.append('notes', document.getElementById('notes').value);
        if (document.getElementById('image').files[0] != undefined) {
            formData.append('image', document.getElementById('image').files[0])
        }
        if (document.getElementById('pdf').files[0] != undefined) {
            formData.append('notes', document.getElementById('notes').value);
        }

        updateBook('/book/update/' + id, formData, '/book/index')



    }

    function updateBook(url, data, href) {

        axios.post(url, data)
            .then(function(response) {

                window.location.href = href
                console.log(response);
            })
            .catch(function(error) {
                console.log(error.response.data);
            });

    }

    function success(data) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

    }

    Toast.fire({
        icon: data.icon,
        title: data.title
    })

    function back() {

        window.history.back();
    }
</script>
