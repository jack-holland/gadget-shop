@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Your Orders</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('account') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go
            Back</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="fw-semibold">Order #</div>
    </div>

    <div class="col">
        <div class="fw-semibold">Purchase Date</div>
    </div>

    <div class="col">
        <div class="fw-semibold">Status</div>
    </div>

    <div class="col">
        <div class="fw-semibold">Total</div>
    </div>

    <div class="col"></div>
</div>

@php $total = 0 @endphp
@php $count = 0 @endphp
@foreach($orders as $order)
@php $total += $order->price * $order->quantity; @endphp
<div class="row mb-1 {{ ++$count%2?"":" bg-light" }} p-2 rounded">
    <div class="col">
        #{{ $order->id }}
    </div>

    <div class="col">
        {{ $order->created_at }}
    </div>

    <div class="col">
        {{ $order->status}}
    </div>

    <div class="col">
        £{{ $total }}
    </div>

    <div class="col">
        <a class="btn btn-danger btn-sm" href="{{ route('order', $order->id) }}"><i class="fa-solid fa-chevron-right"></i> More Info</a>
    </div>
</div>
@endforeach

@endsection