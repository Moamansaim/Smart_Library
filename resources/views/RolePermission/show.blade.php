@extends('layout.cms')
@section('content')
    <div class="container mt-5">
        <button class="btn  btn-success mb-3" onclick="back()">{{ __('back') }}</button>
        <div class="card">
            <h5 class="card-header">{{ $role->name }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Guard Name') }}</th>
                            <th>{{ __('Add') }}</th>
                        </tr>
                    </thead>
                    <?php $e = 1; ?>
                    <tbody class="table-border-bottom-0">
                        @forelse ($permissions as $item)
                            <tr>
                                <td>{{ $e++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->guard_name }}</td>
                                <td>
                                    <div class="form-check mt-3">
                                        <input @if ($item->assigned) checked @endif
                                            onclick="checkPer({{ $role->id }},{{ $item->id }})"
                                            class="form-check-input" type="checkbox" value="" id="defaultCheck1">

                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="5" class="alert alert-secondary text-center ">
                                    {{ __('There is no data to display') }}
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="container m-3">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function checkPer(roleid, perid) {

        // Make a request for a user with a given ID

        let data = {

            roleid: roleid,
            perid: perid


        }

        store('/Role/Permission/store', data);

    }

    function back() {

        window.history.back();
    }
</script>
