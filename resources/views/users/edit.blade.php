@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route("users.update", [$user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="name">Full Name</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="form-check">
                        <label for="active" class="form-check-label mr-4">
                            <input type="radio" class="form-check-input" name="status" id="active" value="ACTIVE" {{ $user->status == "ACTIVE" ? "checked" : "" }}>
                            Active
                        </label>
                        <label for="inactive" class="form-check-label mr-4">
                            <input type="radio" class="form-check-input" name="status" id="inactive" value="INACTIVE" {{ $user->status == "INACTIVE" ? "checked" : "" }}>
                            Inactive
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles[]">Roles</label>
                        <div class="form-check">
                        <label for="ADMIN" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}>
                            Administrator
                        </label>
                        <label for="STAFF" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="STAFF" value="STAFF" {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}>
                            Staff
                        </label>
                        <label for="CUSTOMER" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}>
                            Customer
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control" name="address" id="address" rows="2">{{ $user->address }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="avatar">Avatar</label>
                      <br>
                      <img src="{{ asset("storage/.$user->avatar") }}" width="240" height="240" class="img-profile mb-2">
                      <input type="file" class="form-control-file" name="avatar" id="avatar">
                      <small class="text-muted">Keep empty if you not change</small>
                    </div>
                    <div class="form-group">
                      <label for="email">E-mail Address</label>
                      <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
