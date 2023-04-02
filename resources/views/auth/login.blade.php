@extends('layouts.auth')
@section('title', 'Login')
@section('loginbox')
    <div class="login-box shadow p-0 mb-5 bg-white rounded">
        <!-- /.login-logo -->
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                @if ($setting)
                    @if ($setting->path_logo_login)
                        <img src="{{ asset('storage/logo/' . $setting->path_logo_login) }}" height="100px" alt="">
                    @endif
                @else
                    <img src="{{ asset('/') }}dist/img/logo hermina horozontal.png" height="100px" alt="">
                @endif
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            id="username" value="{{ old('username') }}" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-fw fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="myFunction()">
                                <span id="icon" class="fa-fw fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <p class="m-0 text-center">
                    <a href="{{ route('register') }}" class="text-muted">Register a new account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
<script>
    function myFunction() {
        var x = document.getElementById("password");
        var icon = document.getElementById("icon");
        if (x.type === "password") {
            x.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            x.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
