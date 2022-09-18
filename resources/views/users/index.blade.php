@extends('layouts.app')

@section('content')

<div class="row mb-3">
  <div class="col-sm-10">
    <span class="fs-4 fw-semibold">User Management</span>
  </div>

  @can('user-create')
  <div class="col-sm-2 d-flex justify-content-end">
    <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fa-solid fa-circle-plus"></i> New User</a>
  </div>
  @endcan
</div>

<div class="row border-bottom pb-2">
  <div class="col-sm-2">
    <span class="fw-semibold">First Name</span>
  </div>

  <div class="col-sm-2">
    <span class="fw-semibold">Surname</span>
  </div>

  <div class="col-sm-2">
    <span class="fw-semibold">E-Mail</span>
  </div>

  <div class="col-sm-2">
    <span class="fw-semibold">Roles</span>
  </div>

  <div class="col-sm-4">
    <span class="fw-semibold">Actions</span>
  </div>
</div>

@foreach ($data as $key => $user)
<div class="row py-2 border-bottom">
  <div class="col-sm-2">
    {{ $user->firstname }}
  </div>

  <div class="col-sm-2">
    {{ $user->surname }}
  </div>

  <div class="col-sm-2">
    {{ $user->email }}
  </div>

  <div class="col-sm-2">
    @if(!empty($user->getRoleNames()))
    @foreach($user->getRoleNames() as $roles)
    <span class="badge text-bg-danger">{{ $roles }}</span>
    @endforeach
    @else
    <span class="badge text-bg-secondary">User</span>
    @endif
  </div>

  <div class="col-sm-4">
    <a class="btn btn-dark" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil"></i> Edit</a>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeUser{{$user['id']}}"><i
        class="fa fa-trash-can"></i> Delete</button>
  </div>
</div>

<div class="modal fade" id="removeUser{{$user['id']}}" tabindex="-1" aria-labelledby="removeUser{{$user['id']}}"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeUser{{$user['id']}}">Delete User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove <span class="fw-bold">{{$user['firstname']}} {{$user['surname']}}</span> from
        the User System?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
        {{ Form::button('<i class="fa fa-trash-can"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger'] ) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endforeach


@endsection