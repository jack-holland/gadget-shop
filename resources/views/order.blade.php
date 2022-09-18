@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Your Order (#{{ $order->id }})</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('orders') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go
            Back</a>
    </div>
</div>

@php $total = 0 @endphp
@php $count = 0 @endphp

@foreach($products as $product)
@php $total += $product->price * $product->quantity; @endphp
@endforeach

<div class="row bg-dark text-light rounded p-3 mb-3">
    <div class="col-sm-12">
        <div class="row">
            <div class="col">
                <div class="fw-semibold">Order No</div>
                #{{ $order->id }}
            </div>
            <div class="col">
                <div class="fw-semibold">Purchased Date</div>
                {{ $order->created_at}}
            </div>
            <div class="col">
                <div class="fw-semibold">Status</div>
                {{ $order->status }}

            </div>
            <div class="col">
                <div class="fw-semibold">Order Cost</div>
                £{{ $total }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="fw-semibold fs-5">Order Contents:</div>
    </div>
</div>

<div class="row fw-semibold">
    <div class="col-sm-1">
        Image
    </div>

    <div class="col-sm-5">
        Order Item
    </div>

    <div class="col-sm-3">
        Quantity
    </div>

    <div class="col-sm-3">
        Price
    </div>
</div>

@foreach($products as $product)
    <div class="row my-3 d-flex align-items-center rounded {{ ++$count%2?"":"bg-light" }} p-3">
        <div class="col-sm-1">
            <img src="{{ $product->image }}.png" height="50" class="img-thumbnail" />
        </div>

        <div class="col-sm-5">
            <div class="fw-semibold fs-5">{{ $product->name }}</div>
        </div>

        <div class="col-sm-3">
            {{ $product->quantity}}
        </div>

        <div class="col-sm-3">
            £{{ $product->price * $product->quantity }}
        </div>
    </div>
@endforeach

@endsection