@extends('dashboard.dash-layout')
@section('title', 'User Authorities')

@section('content')

<div class="card mx-auto container mt-5">
    <a href="/admin/users"><h6>Users</h6></a>
    <a href="/admin/userregistration"><h6>New User</h6></a>
    @if(session('success'))
    <div class="text-danger text-center">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-lg">
            <!-- Authorities -->
            <p>Authorities Panel : {{ session('userAuthority') }}</p>
            <form action="/admin/authorities" method="post">
                <input type="text" name="email" value="iqbal@gmail.com" class="form-control mb-3" placeholder="User's email">
                @error('email')
                    <p class="text-danger mt-1"><b>{{ $message }}</b></p>
                @enderror
                @csrf
                @foreach($allAuthorities as $item)
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" name="{{ $item->authority_name}}" value="{{ $item->authority_route}}" class="form-control-sm">
                        </div>
                    </div>
                    <input type="text" name="" value="{{ $item->authority_name}}" class="form-control form-control-sm input-group-text">
                </div>
                @endforeach

                <div class="text-center mb-2">
                    <button type="submit" class="btn btn-info">Authorities Transfer</button>
                </div>
            </form>
        </div>

        <div class="col-lg">
            <!-- User Authorities -->
            <p>User Authorities Panel : {{ session('userAuthority') }}</p>
            <form>
            @csrf
            <div class="input-group mt-1 mb-3">
                <input type="text" name="search" class="form-control" placeholder="User's email"  value="iqbal@gmail.com">
            </div>
            </form>
                
            <table class="table table-striped">
                <tbody>
                    @foreach($userAuthorities as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->authority_name }}</td>
                        <td>{{ $item->authority_route }}</td>
                        <td>
                            <form method="POST" action="/admin/authorityDelete/?id={{$item->id}}&email={{ $item->email }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>


@endsection