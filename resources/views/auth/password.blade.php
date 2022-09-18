@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Change Password</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('account') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go Back</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
            @csrf
        
            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}  mb-3">
                <label for="new-password" class="col-md-4 control-label">Current Password</label>
        
                <div class="col-md-12">
                    <input id="current-password" type="password" class="form-control" name="current-password" required>
        
                    @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}  mb-3">
                <label for="new-password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-12">
                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                    @if ($errors->has('new-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new-password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                <div class="col-md-12">
                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-md-offset-4">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-key"></i> Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-3">
        <img src="/images/password.svg" alt="Graphic of person changing password" class="img-fluid border-none my-3" />
    </div>
</div>

@endsection