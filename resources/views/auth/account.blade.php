@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-12">
        <span class="fs-4 fw-semibold">My Account</span>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-12 mb-3">
        <a href="{{ route('details') }}" class="text-decoration-none text-dark">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-2 bg-light d-flex align-items-center justify-content-center fs-1 text-danger">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body border-start">
                            <h5 class="card-title">Change your details</h5>
                            <p class="card-text">Update your First Name, Surname and E-Mail Address.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>

    <div class="col-sm-12 mb-3">
        <a href="{{ route('password') }}" class="text-decoration-none text-dark">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-2 bg-light d-flex align-items-center justify-content-center fs-1 text-danger">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body border-start">
                            <h5 class="card-title">Change your Password</h5>
                            <p class="card-text">Here you can change your current Password to something different.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>

    <div class="col-sm-12 mb-3">
        <a href="{{ route('orders') }}" class="text-decoration-none text-dark">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-2 bg-light d-flex align-items-center justify-content-center fs-1 text-danger">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body border-start">
                            <h5 class="card-title">Order History</h5>
                            <p class="card-text">Get support for past orders, check the status of your orders and
                                request a cancellation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>
</div>
@endsection