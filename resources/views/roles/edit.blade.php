@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Edit Roles</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('roles.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Cancel</a>
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

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="mb-3">
        <label for="role-name" class="form-label">Role Name</label>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="permissions" class="form-label">Permissions</label>
            @foreach($permission as $value)
                <div class="form-check form-switch">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-check-input')) }}{{ $value->name }}
                </div>
            @endforeach
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-pencil"></i> Edit Product</button>
    </div>

</div>
{!! Form::close() !!}
@endsection