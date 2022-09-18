@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <p class="fs-4 fw-semibold">Search Results</p>
    </div>

    <div class="col-sm-6 d-flex justify-content-end align-items-center gap-2 fw-semibold">
        <span>Home</span> <i class="fa-solid fa-chevron-right text-danger"></i> <span>Search</span>
    </div>
</div>

<div class="row">
    @foreach($products as $product)
    <div class="col-sm-3">
        <div class="card">
            <img src="{{ $product->image }}.png" class="card-img-top p-3" alt="{{ $product->name }}">
            <div class="card-body border-top">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-truncate">£{{ $product->price }}</p>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item d-grid bg-light gap-2">
                    <a type="button" class="btn btn-danger" href="{{ route('showproduct', $product->id) }}"><i class="fa-solid fa-circle-chevron-right"></i> More Details</a>
                    <a type="button" class="btn btn-dark" href="{{ route('add.to.cart', $product->id) }}"><i class="fa-solid fa-basket-shopping"></i> Add to Basket</a>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection