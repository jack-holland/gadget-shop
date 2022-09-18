@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Products</span>
    </div>

    @can('product-create')
    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-success" href="{{ route('products.create') }}"><i class="fa-solid fa-circle-plus"></i> New
            Product</a>
    </div>
    @endcan
</div>

<div class="row border-bottom pb-2">
    <div class="col-sm-4">
        <span class="fw-semibold">Product</span>
    </div>

    <div class="col-sm-2">
        <span class="fw-semibold">Price</span>
    </div>

    <div class="col-sm-2">
        <span class="fw-semibold">Category</span>
    </div>

    <div class="col-sm-4">
        <span class="fw-semibold">Actions</span>
    </div>
</div>

@foreach ($products as $product)
<div class="row py-2 border-bottom">
    <div class="col-sm-4">
        {{ $product['name'] }}
    </div>

    <div class="col-sm-2">
        £{{ $product['price'] }}
    </div>

    <div class="col-sm-2">
        {{ ucfirst($product['category']) }}
    </div>

    <div class="col-sm-4">
        <a class="btn btn-success" href="{{ route('showproduct',$product->id) }}"><i class="fa fa-eye"></i> View</a>

        @can('product-edit')
        <a class="btn btn-dark" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-pencil"></i> Edit</a>
        @endcan

        @can('product-delete')
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeProduct{{$product['id']}}"><i
                class="fa fa-trash-can"></i> Delete</button>
        @endcan
    </div>
</div>

<div class="modal fade" id="removeProduct{{$product['id']}}" tabindex="-1"
    aria-labelledby="removeProduct{{$product['id']}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeProduct{{$product['id']}}">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove <span class="fw-bold">{{$product['name']}}</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-can"></i> Delete</button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-sm-12 my-3">
    {!! $products->links() !!}
</div>


@endsection