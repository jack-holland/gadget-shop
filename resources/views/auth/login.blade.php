@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-5">
        <img src="/images/login.svg" alt="Graphic of person with a laptop" class="img-fluid border-none" />
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-6">
        <p class="fs-4 fw-semibold mb-3">Login</p>

        <p>Creating an account with Gadget Shop allows you to checkout easier. You can also view and track orders in your account. </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password">Password</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                </div>

                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                    <small>Don't have an account with us? <a href="{{ route('register') }}">Register</a></small>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection