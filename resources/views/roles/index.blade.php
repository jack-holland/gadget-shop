@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Role List</span>
    </div>

    @can('role-create')
    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fa-solid fa-circle-plus"></i> New
            Role</a>
    </div>
    @endcan
</div>

<div class="row border-bottom pb-2">
    <div class="col-sm-8">
        <span class="fw-semibold">Name</span>
    </div>

    <div class="col-sm-4">
        <span class="fw-semibold">Actions</span>
    </div>
</div>

@foreach ($roles as $key => $role)
<div class="row border-bottom py-2">
    <div class="col-sm-8">
        <span>{{ $role->name }}</span>
    </div>

    <div class="col-sm-4">
        <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i> View</a>

        @can('product-edit')
        <a class="btn btn-dark" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil"></i> Edit</a>
        @endcan

        @can('role-delete')
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeRole{{$role['id']}}"><i class="fa fa-trash-can"></i> Delete</button>
        @endcan
    </div>
</div>

<div class="modal fade" id="removeRole{{$role['id']}}" tabindex="-1" aria-labelledby="removeRole{{$role['id']}}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeRole{{$role['id']}}">Delete Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove <span class="fw-bold">{{$role['name']}}</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline'])!!}
                {!! Form::button('<i class="fa fa-trash-can"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endcan
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection