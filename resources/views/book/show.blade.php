@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="col-md-6 col-lg-6 mb-3">
            <div class="card h-50 w-75">
                <div class="card-body  ">
                    <h5 class="card-title">{{ __('Name') }}: {{ $book->name }}</h5>
                    <h6 class="card-subtitle text-muted"> <span class="text-primary"> Version: </span> {{ $book->version }}
                    </h6>
                </div>
                <img src="{{ asset('storage/imagebook/' . $book->image) }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"><span class="text-primary">{{ __('Language') }}: </span> {{ $book->language }}</p>
                    <p class="card-text"><span class="text-primary">{{ __('Category') }}: </span>
                        {{ $book->category->name }}</p>
                    <p class="card-text"><span class="text-primary">{{ __('Writer') }}:</span> {{ $book->writer->name }}
                    </p>
                    <p class="card-text"><span class="text-primary">{{ __('Home Publish') }}</span>:
                        {{ $book->homePublish->name }}</p>
                    <p class="card-text"><span class="text-primary">{{ __('Notes') }}:</span> {{ $book->notes }}</p>
                    <a href="{{ route('download.book', $book->id) }}" class="card-link"> <i class='bx bxs-download'></i>
                        {{ __('Download') }}</a>
                    <a href="{{ route('file.book', $book->id) }}" class="card-link"><i
                            class='bx bx-show'></i>{{ __('Show') }} </a>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function back() {

        window.history.back();
    }
</script>
