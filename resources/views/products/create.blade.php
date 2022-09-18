@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">New Product</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('products.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Cancel</a>
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

<div class="row">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="product-name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="product-name" aria-describedby="product-name">
        </div>

        <div class="mb-3">
            <label for="product-description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="product-details" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="product-image" class="form-label">Image</label>
            <input type="text" name="image" class="form-control" id="product-image" aria-describedby="product-image">
        </div>

        <label for="product-price" class="form-label">Price</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="product-price">£</span>
            <input type="text" name="price" class="form-control" aria-label="Price" aria-describedby="product-price">
        </div>

        <div class="mb-3">
            <label class="form-label">Product Category</label>
            <select class="form-select" name="category" aria-label="Default select example">
                <option selected>Select a Category</option>
                <option value="computer">Computers</option>
                <option value="laptop">Laptops</option>
                <option value="mobile">Mobile Phones</option>
                <option value="television">Televisions</option>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-circle-plus"></i>  Create Product</button>
        </div>

    </form>
</div>

@endsection