@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <form action="{{ route('index.book') }}" class="d-flex mt-3" style="text-shadow:3px 3px 10px black ">

                        <input type="text" required name="name" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search...">
                        <button class="btn btn-sm btn-dark">{{ __('Filter') }}</button>
                    </form>
                </div>
            </div>
            <h5 class="card-header">{{ __('Book') }} </h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Vresion') }}</th>
                            <th>{{ __('Language') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <?php $e = 1; ?>
                    <tbody class="table-border-bottom-0">
                        @forelse ($books as $item)
                            <tr>
                                <td>{{ $e++ }}</td>

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->version }}</td>
                                <td>{{ $item->language }}</td>
                                @if ($item->status == 'Active')
                                    <td><span class="badge bg-label-success me-1">{{ $item->status }}</span></td>
                                @else
                                    <td><span class="badge bg-label-danger me-1">{{ $item->status }}</span></td>
                                @endif
                                <td>
                                    <img src="{{ asset('storage/Imagebook/' . $item->image) }}" withd="80px"
                                        height="80px">
                                </td>
                                <td>{{ $item->notes }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('show.book', $item->id) }}"><i
                                                    class='bx bx-show'></i>{{ __('Show') }}</a>
                                            <a class="dropdown-item" href="{{ route('edit.book', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-2"></i>{{ __('Edit') }} </a>
                                            <button type="button" onclick="deletebook({{ $item->id }},this)"
                                                class="dropdown-item"><i class="bx bx-trash me-2"></i>{{ __('Delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="10" class="alert alert-secondary text-center ">
                                    {{ __('There is no data to display') }}
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="container m-3">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function deletebook(id, refranses) {

        deleteItem('/book/destroy/', id, refranses)

    }

    function back() {

        window.history.back();
    }
</script>
