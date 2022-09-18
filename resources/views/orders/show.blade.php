@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Order Information</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('orders.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go
            Back</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div><span class="fw-semibold">Status</span> {{ $orders->status }}</div>
        <div><span class="fw-semibold">Ordered by</span> {{ $orders->firstname }} {{ $orders->surname }}</div>
        <div><span class="fw-semibold">Order created</span> {{ $orders->created_at }}</div>
    </div>

    <div class="col-sm-12 mt-3">
        @php $total = 0 @endphp
        @foreach($products as $product)
        @php $total += $product->price * $product->quantity; @endphp
        <div class="row bg-light rounded p-3 mb-3 d-flex align-items-center">
            <div class="col-sm-1">
                <img src="{{ $product->image }}.png" class="img-thumbnail" />
            </div>
            <div class="col-sm-7 fw-semibold fs-4">
                {{ $product->name }}
            </div>
            <div class="col-sm-2 text-center">
                <div class="fw-semibold">Price</div>
                <div>£{{ $product->price * $product->quantity }}</div>
            </div>
            <div class="col-sm-2 text-center">
                <div class="fw-semibold">Quantity</div>
                <div>{{ $product->quantity }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="col-sm-12 d-flex justify-content-end">
        <div class="fs-5"><span class="fw-semibold">Total:</span> £{{ $total }}</div> 
    </div>
</div>
    @endsection