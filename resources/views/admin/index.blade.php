@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3"  onclick="back()" >{{ __('back') }}</button>
        <div class="card">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                   <form action="{{   route('index.admin')   }}" class="d-flex mt-3" style="text-shadow:3px 3px 10px black " >
                     
                    <input type="text" name="name" required class="form-control border-0 shadow-none" placeholder="Search..."
                        aria-label="Search...">
                        <button class="btn btn-sm btn-dark">{{ __('Filter') }}</button>
                   </form>
                </div>
            </div>
            <h5 class="card-header">{{ __('Admin') }} </h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Profile') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <?php $e = 1; ?>
                    <tbody class="table-border-bottom-0">
                        @forelse ($admins as $item)
                            <tr>
                                <td>{{ $e++ }}</td>
                               
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="{{ route('ShowProfile.admin', $item->id) }}"
                                        class="btn rounded-pill btn-icon btn-primary">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </td>
                                @if ($item->image)
                                    <td>
                                        <img class="Admin_image" src="{{ asset('storage/AdminImage/' . $item->image) }}">
                                    </td>
                                @else
                                    <td>
                                        <img class="Admin_image" src="{{ asset('storage/placebo_admin/admin.png') }}">
                                    </td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('edit.admin', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <button type="button" onclick="deleteUser({{ $item->id }},this)"
                                                class="dropdown-item"><i class="bx bx-trash me-2"></i> Delete</button>
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
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function deleteUser(id, refranses) {

        deleteItem('/admin/destroy/', id, refranses)

    }

    
    function back(){

        window.history.back();
    }

</script>

<style>
    .Admin_image {

        width: 60px;
        height: 60px;
        border-radius: 100%;


    }
</style>
