@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-6">
        <p class="fs-4 fw-semibold">Order Complete</p>
    </div>

    <div class="col-sm-6 d-flex justify-content-end align-items-center gap-2 fw-semibold">
        <span>Home</span> <i class="fa-solid fa-chevron-right text-danger"></i> <span>Order Complete</span>
    </div>
</div>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body text-center">
                <div class="fs-4 fw-semibold mb-2">Thank you for your order</div>
                <div class="mb-2">Your order has been placed and will be processed as soon as possible.</div>
                <div>
                    <a type="button" class="btn btn-danger" href="{{ route('orders') }}">View your Order</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection