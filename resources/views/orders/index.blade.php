@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Order List</span>
    </div>
</div>

<div class="row border-bottom pb-2">
    <div class="col-sm-2">
        <span class="fw-semibold">Order ID</span>
    </div> 

    <div class="col-sm-2">
        <span class="fw-semibold">Status</span>
    </div>

    <div class="col-sm-4">
        Ordered By
    </div>

    <div class="col-sm-4">
        <span class="fw-semibold">Actions</span>
    </div>
</div>

@foreach ($orders as $order)
<div class="row py-2 border-bottom">
    <div class="col-sm-2"> 
        #{{ $order->id }}
    </div>

    <div class="col-sm-2">
        {{ $order->status }}
    </div>

    <div class="col-sm-4">
        {{ $order->firstname }} {{ $order->surname }}
    </div>

    <div class="col-sm-4">
        <a class="btn btn-success" href="{{ route('orders.show',$order->id) }}"><i class="fa fa-eye"></i> View</a>

        @can('order-edit')
        <a class="btn btn-dark" href="{{ route('orders.edit',$order->id) }}"><i class="fa fa-pencil"></i> Edit</a>
        @endcan

        @can('order-delete')
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeOrder{{$order->id}}"><i class="fa fa-trash-can"></i> Delete</button>
        @endcan
    </div>
</div>

<div class="modal fade" id="removeOrder{{$order->id}}" tabindex="-1" aria-labelledby="removeOrder{{$order->id}}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeOrder{{$order->id}}">Delete Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove Order <span class="fw-bold">{{$order->id}}</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                @can('order-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order->id],'style'=>'display:inline'])!!}
                {!! Form::button('<i class="fa fa-trash-can"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endcan
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-sm-12 my-3">
    {!! $orders->links() !!}
</div>

@endsection