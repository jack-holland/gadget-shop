@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-5">
        <img src="/images/register.svg" alt="Graphic of person signing into application" class="img-fluid border-none" />
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6">
                <span class="fs-4 fw-semibold">Register</span>
            </div>

            <div class="col-sm-6 d-flex justify-content-end">
                <a class="btn btn-dark" href="{{ route('login') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go
                    Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="my-3">
                    <label for="firstname" class="form-label">First Name</label>

                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"
                        name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                    @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Surname</label>

                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                        name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                    @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail Address</label>

                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" required autocomplete="password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>

                    <input id="password" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" value="{{ old('password_confirmation') }}" required
                        autocomplete="password_confirmation">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection