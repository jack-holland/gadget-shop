@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-sm-10">
        <span class="fs-4 fw-semibold">Role Information</span>
    </div>

    <div class="col-sm-2 d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ route('roles.index') }}"><i class="fa-solid fa-circle-chevron-left"></i> Go Back</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="fw-semibold">{{ $role->name }}</div>
    </div>
</div>

<div class="col-sm-12">
    <ul>
        @if(!empty($rolePermissions))
        @foreach($rolePermissions as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    @endif
    </ul>
</div>
@endsection