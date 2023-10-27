@extends('dashboard.dash-layout')
@section('title', 'Admin Products')

@section('content')
<!-- /. NAV SIDE  -->
<div id="page-inner">
    <div class="row">
        <div class="col-md-12 mb-2">
            <h2 class="text-primary">Users</h2>
        </div>
    </div>
    <div class="row">
        @if(session('success'))
        <div class="text-danger small text-center">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        <div class="col-lg-12 col-md-6">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="text-primary">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>User Status</th>
                        <th>Created at</th>
                        <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $item)
                    <tr class="md:table-fixed border-b dark:border-neutral-500">
                        <td class="whitespace-wrap px-3 py-2">{{ $users->firstItem() + $loop->index }}</td>
                        <td class="whitespace-wrap px-3 py-2 w-25" v-if="isEditable">{{ $item->name }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $item->email }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $item->user_type }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $item->user_status }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $item->created_at }}</td>
                        <td>
                            <form method="post" action="/admin/userUpdate/{{$item->email}}">
                                @csrf
                                <select name="user_status">
                                    <option value="Active" {{ $item['user_status'] === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Deactive" {{ $item['user_status'] === 'Deactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                        </td>
                        <td>
                            <button class="btn btn-link">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="mx-auto text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <!-- /. ROW  -->
</div>

@endsection