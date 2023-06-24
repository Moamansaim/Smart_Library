@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <form action="{{ route('index.role') }}" class="d-flex mt-3" style="text-shadow:3px 3px 10px black ">

                        <input required type="text" name="name" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search...">
                        <button class="btn btn-sm btn-dark">{{ __('Filter') }}</button>
                    </form>
                </div>
            </div>
            <h5 class="card-header">Role</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>{{ __('Name') }}</th>
                            <td>{{ __('Permissions') }}</td>
                            <th>{{ __('Guard Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <?php $e = 1; ?>
                    <tbody class="table-border-bottom-0">
                        @forelse ($roles as $item)
                            <tr>
                                <td>{{ $e++ }}</td>

                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('RolePermission', $item->id) }}" class="btn btn-primary text-white">
                                        {{ $item->permissions->count() }} / <span
                                            class="bx bx-purchase-tag-alt"></span>&nbsp; {{ __('permissions') }}
                                    </a>
                                </td>
                                <td>{{ $item->guard_name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('edit.role', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-2"></i> {{ __('Edit') }}</a>
                                            <button type="button" onclick="deleteRole({{ $item->id }},this)"
                                                class="dropdown-item"><i class="bx bx-trash me-2"></i>
                                                {{ __('Delete') }}</button>
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
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function deleteRole(id, refranses) {

        deleteItem('/role/destroy/', id, refranses)

    }

    function back() {

        window.history.back();
    }
</script>
