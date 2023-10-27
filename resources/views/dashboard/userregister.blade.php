@extends('dashboard.dash-layout')
@section('title', 'Dashboard')

@section('content')

<div class="card mx-auto" style="width: 28rem;  margin-top:30px;">
    <div class="card-body">

        <h5 class="card-title text-center">User Registration</h5>
        <hr class="bg-primary" />
        @if(session('success'))
        <div class="text-danger small text-center">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <form action="/admin/userregistration" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="block text-sm text-gray-600">User Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="block text-sm text-gray-600">User Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="nombre" class="block text-sm text-gray-600">Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="nombre" class="block text-sm text-gray-600">Verify Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="userType" class="block mb-2 text-sm text-gray-600">User Type</label>
                <select name="user_type" class="form-control">
                    <option value="Admin">Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Support" selected>Support</option>
                </select>
                @error('userType')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-info">Registration</button>
            </div>
        </form>
    </div>
</div>

@endsection