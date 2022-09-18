@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Edit User</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('users.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Cancel</a>
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

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        {!! Form::text('firstname', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        {!! Form::text('surname', null, array('placeholder' => 'Surname','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','')) !!}
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-dark"><i class="fa fa-pencil"></i> Edit User</button>
    </div>
</div>
{!! Form::close() !!}

@endsection