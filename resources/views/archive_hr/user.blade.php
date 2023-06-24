@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card">
            <h5 class="card-header"></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <?php $e = 1; ?>
                    <tbody class="table-border-bottom-0">
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $e++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td> <del class="text-danger">{{ $item->name }}</del> </td>
                                <td> <del class="text-danger">{{ $item->email }}</del> </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" onclick="restoreUser({{ $item->id }})"
                                                class="dropdown-item"><i class='bx bx-redo'></i>
                                                {{ __('Restore') }}</button>
                                            <button type="button" onclick="forceDelete({{ $item->id }},this)"
                                                class="dropdown-item"><i class="bx bx-trash me-2"></i>
                                                {{ __('Permanent delete') }} </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="5" class="alert alert-secondary text-center ">There is no data to display
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="container m-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function forceDelete(id, refranses) {

        deleteItem('/user/forceDelete/', id, refranses)

    }


    function restoreUser(id) {

        axios.post('/user/restore/' + id)
            .then(function(response) {
                success(response.data)
                window.location.href = '/user/archive'
                console.log(response);
            })
            .catch(function(error) {
                success(error.response.data)
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

        Toast.fire({
            icon: data.icon,
            title: data.title
        })
    }

    function back() {

        window.history.back();
    }
</script>
