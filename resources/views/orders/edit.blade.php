@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Editing Order (#{{ $order->id }})</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('orders.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Cancel</a>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="fs-6 alert-heading"><span class="fw-semibold">Error:</span> The following fields cannot be left empty</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::model($order, ['method' => 'PATCH','route' => ['orders.update', $order->id]]) !!}
    <div class="mb-3">
        <label for="order-status" class="form-label">Order Status</label>
        <select class="form-select" aria-label="Order Status" name="status">
            <option value="Processing" {{ $order->status == "Processing" ? 'selected' : '' }}>Processing</option>
            <option value="Out for Delivery" {{ $order->status == "Out for Delivery" ? 'selected' : '' }}>Out for Delivery</option>
            <option value="Completed" {{ $order->status == "Completed" ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ $order->status == "Cancelled" ? 'selected' : '' }}>Cancelled</option>
          </select>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-pencil"></i> Edit Order</button>
    </div>   
{!! Form::close() !!}

@endsection