@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10 fw-semibold">
        <span>Home</span> <i class="fa-solid fa-chevron-right text-danger"></i> <span>{{ $category }} <i class="fa-solid fa-chevron-right text-danger"></i> <span>{{ $product['name'] }}</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
		<a class="btn btn-danger" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa-solid fa-circle-chevron-left"></i> Go Back</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <img src="{{ $product['image'] }}-large.png" alt="{{ $product['name'] }}" class="img-thumbnail p-3" />
    </div>

    <div class="col-sm-8">
        <div class="fw-semibold fs-4 mb-1">{{ $product['name'] }}</div>
        <div class="mb-3">£{{ $product['price'] }}</div>
        <a type="button" class="btn btn-danger mb-3" href="{{ route('add.to.cart', $product->id) }}"><i class="fa-solid fa-basket-shopping"></i> Add to Basket</a>

        <div class="fs-4 fw-semibold">
            Product Description
        </div>
        <div style="white-space: pre-wrap;">{{ $product['description'] }}</div>
    </div>
</div>
@endsection