<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Login</title>
    <!-- Favicon-->
    <!-- Bootstrap icons-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>

<div class="card mx-auto" style="width: 28rem;  margin-top:30px;">
    <div class="card-body">
        <h5 class="card-title text-center">Dashboard User Login</h5>
        <hr class="bg-primary" />
        @if(session('success'))
        <div class="text-danger small text-center">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <form action="/admin/login" method="post">
            @csrf
            <!-- Error Message -->
            @error('email')
            <p class="text-danger text-center mt-2">{{ $message }}</p>
            @enderror

            <div class="form-group mb-3">
                <label for="nombre" class="block text-sm text-gray-600">User Email</label>
                <input type="text" name="email" class="form-control" value="iqbal@gmail.com" required>
                @error('email')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="nombre" class="block text-sm text-gray-600">Password</label>
                <input type="password" name="password" class="form-control" value="iqbal">
                @error('password')
                <p class="text-danger small mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="userType" class="block mb-2 text-sm text-gray-600">User Type</label>
                <select name="user_type" class="form-control">
                    <option value="Admin">Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Support" selected>Support</option>
                </select>
            </div>

            <p class="text-primary"> <a href="/admin/forgotPassword/{{ old('email') }}">Forgot Password?</a></p>
            <div class="text-center">
                <button type="submit" class="btn btn-info">Login Admin</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
