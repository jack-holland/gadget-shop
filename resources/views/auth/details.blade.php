@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Change Details</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('account') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go Back</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <form class="form-horizontal" method="POST" action="{{ route('changeDetailsPost') }}">
            @csrf
        
            <div class="form-group mb-3">
                <label for="new-password" class="col-md-4 control-label">First Name</label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="new-password" class="col-md-4 control-label">Surname</label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="surname" value="{{ $user->surname }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="new-password" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-md-offset-4">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-user-pen"></i> Change Details
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-3">
        <img src="/images/details.svg" alt="Graphic of person changing password" class="img-fluid border-none my-3" />
    </div>
</div>

@endsection