@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">New Role</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('roles.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Cancel</a>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="mb-3">
        <label for="role-name" class="form-label">Role Name</label>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="permissions" class="form-label">Permissions</label>
        @foreach($permission as $value)
        <div class="form-check form-switch">
            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }} {{ $value->name }}
        </div>
    @endforeach
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Create Role</button>
    </div>
</div>
{!! Form::close() !!}
@endsection