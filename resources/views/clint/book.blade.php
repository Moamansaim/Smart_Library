@extends('layout.cms')
@section('content')
    <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>


    <div class="container mt-5">
        <div class="row">
            @forelse ($book as $item)
                <div class="col-lg-3 col-md-4 col-sm-12 mt-3">
                    <div class="card h-100 w-100">
                        <div class="card-body">
                            <h5 class="card-title ">{{ $item->name }}</h5>
                            <h6 class="card-subtitle text-muted ">{{ $item->version }}</h6>
                        </div>
                        <img class="img-fluid" style="margin:auto" width="60%" height="100%"
                            src="{{ asset('storage/imagebook/' . $item->image) }}" alt="Card image cap">
                        <div class="card-body" style="margin:auto">
                            <p class="card-text">{{ $item->notes }}</p>
                            <a href="{{ route('download.book', $item->id) }}" class="card-link"> <i
                                    class='bx bxs-download'></i>{{ __('Download') }}</a>
                            <a href="{{ route('file.book', $item->id) }}" class="card-link"><i
                                    class='bx bx-show'></i>{{ __('Show') }} </a>
                            <form>
                                @csrf
                                <button type="button" onclick="Favorite({{ $item->id }})"
                                    class="btn  btn-outline-dark btn-sm mt-3" style="margin-left:50px"><i
                                        class='bx bxs-bookmarks'></i>{{ __('Favorite') }} </button>
                            </form>

                        </div>
                    </div>
                </div>
            @empty

                <div class="container mt-5">
                    <div class="alert alert-secondary text-center text-dark">{{ __('There are no books to display') }}
                    </div>
                </div>
            @endforelse
        </div>


    </div>
@endsection


<script>
    function Favorite(id) {

        let data = {

            book_id: id

        }

        store('/clint/favorite', data)

    }


    function back() {

        window.history.back();
    }
</script>
