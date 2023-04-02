@extends('layouts.auth')
@section('title', 'Login')
@section('loginbox')
    <div class="login-box shadow p-0 m-auto bg-white rounded">
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
                <p class="login-box-msg">Register New User Account</p>

                <form action="{{ route('register') }}" method="post">
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name') }}" placeholder="Full Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-fw fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mt-3">
                        <select id="roles" name="roles"
                            class="form-control select2 @error('roles') is-invalid @enderror" required autocomplete="roles">
                            <option value="" selected disabled>Choose a role</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('roles')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" value="{{ old('email') }}" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-fw fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="seePassword()">
                                <span id="icon" class="fa-fw fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="seeConfirmPassword()">
                                <span id="icon2" class="fa-fw fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <p class="m-0 text-center">
                    <a href="{{ route('login') }}" class="text-muted">Already have an account</a>
                </p>
            </div>
        </div>
    </div>
@endsection

<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/') }}plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Select a Role",
            allowClear: true,
            dropdownCssClass: 'text-sm p-0'
        });
    });

    function seePassword() {
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

    function seeConfirmPassword() {
        var x = document.getElementById("password_confirmation");
        var icon = document.getElementById("icon2");
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
