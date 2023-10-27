@extends('components.app-layout')
@section('title', 'Shopping Cart')

@section('content')

<div class="card mx-auto" style="width: 28rem;  margin-top:30px;">
    <div class="card-body">
        <h5 class="card-title text-center">User Login</h5>
        <hr class="bg-primary" />
        @if(session('success'))
        <div class="text-danger small text-center">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <form action="/customer/login" method="post">
            @csrf
            <!-- Error Message -->
            @error('email')
            <p class="text-danger text-center mt-2">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="nombre" class="block text-sm text-gray-600">User Email</label>
                <input type="text" name="userEmail" class="form-control" value="{{ old('userEmail') }}" required>
                @error('userEmail')
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
            <p class="text-primary"> <a href="/admin/forgotPassword/{{ old('userEmail') }}">Forgot Password?</a></p>
            <div class="text-center">
                <button type="submit" class="btn btn-info">Login Admin</button>
            </div>
        </form>
    </div>
</div>
<br>

@include('components.footer')
@endsection