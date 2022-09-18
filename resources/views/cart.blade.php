@extends('layouts.app')

@section('content')

@if(count(session('cart')) > 0 )
<div class="row fw-semibold py-1">
    <div class="col-sm-6">
        Product
    </div>

    <div class="col-sm-1">
        Quantity
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-2">
        Subtotal
    </div>

    <div class="col-sm-2">

    </div>
</div>

@php $total = 0 @endphp
@php $count = 0 @endphp
@if(session('cart'))
@foreach(session('cart') as $id => $details)
@php $total += $details['price'] * $details['quantity']; @endphp
<div class="row mb-3 p-3 rounded {{ ++$count%2?"":"bg-light" }}" data-id="{{ $id }}">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ $details['image'] }}.png" height="50" class="img-thumbnail" />
            </div>

            <div class="col-sm-10">
                <div class="fs-4 fw-bold">{{ $details['name'] }}</div>
                <div>£{{ $details['price'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-1">
        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
    </div>

    <div class="col-sm-1"></div>

    <div class="col-sm-2">
        £{{ $details['price'] * $details['quantity'] }}
    </div>

    <div class="col-sm-2">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeItem{{$id}}"><i
                class="fa fa-trash-can"></i> Remove</button>
    </div>
</div>

<div class="modal fade" id="removeItem{{$id}}" tabindex="-1" aria-labelledby="removeItem{{$id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeItem{{$id}}">Remove Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove <span class="fw-bold">{{$details['name']}}</span> from your cart?
            </div>
            <div class="modal-footer" data-id="{{ $id }}">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger remove-from-cart"><i class="fa fa-trash-can"></i>
                    Remove</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<div class="row border-bottom border-top py-3 my-3">
    <div class="col-sm-12 p-0">
        <p class="d-flex justify-content-end fs-5 p-0 m-0">
            <span class="fw-bold me-2">Total:</span>£{{ $total }}
        </p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 d-flex justify-content-end">
        <a href="{{ url('/') }}" class="btn btn-dark me-3"><i class="fa fa-basket-shopping"></i> Continue Shopping</a>
        <form  method="POST" action="{{ route('purchase') }}">
            @csrf
            <button class="btn btn-danger"><i class="fa fa-cart-shopping"></i> Purchase</button>
        </form>
    </div>
</div>
@else
<div class="row my-3">
    <div class="col-sm-4 offset-sm-4 d-grid gap-2">
        <img src="/images/empty-cart.svg" alt="Picture of an Empty Shopping Cart" class="img-fluid mb-1" />
        <div class="fs-5 fw-semibold mt-3 text-center mb-1">Your Shopping Cart is empty.</div>
        <a href="{{ url('/') }}" class="btn btn-dark me-3"><i class="fa fa-basket-shopping"></i> Continue Shopping</a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents(".row").attr("data-id"),
                quantity: ele.parents(".row").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('remove.from.cart') }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents(".modal-footer").attr("data-id")
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
</script>
@endsection