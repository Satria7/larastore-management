@extends('layouts.master')

@section('title')
    User Detail
@endsection

@section('content')
<div class="row">
            <div class="col-sm-4 text-center">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset("storage/".$user->avatar) }}" width="250" height="250" class="mb-2">
            <h4>{{ $user->name }}</h4>
                </div>
            </div>
            <hr>
            <a href="{{ route("users.edit", [$user->id]) }}" class="btn btn-primary">Edit Profile</a>
            <a href="" class="btn btn-warning">Back</a>
        </div>
        <div class="col-sm-8">
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Detail User</h4>
        <b>Name</b>
        <p>{{ $user->name }}</p>
        <b>Username</b>
        <p>{{ $user->username }}</p>
        <b>E-mail address</b>
        <p>{{ $user->email }}</p>
        <b>Phone Number</b>
        <p>{{ $user->phone }}</p>
        <b>Address</b>
        <p>{{ $user->address }}</p>
        <b>Roles</b>
        <br>
        @foreach (json_decode($user->roles) as $role)
            <span class="badge badge-success">{{ $role }}</span>
        @endforeach
    </div>
</div>
        </div>
</div>
@endsection
