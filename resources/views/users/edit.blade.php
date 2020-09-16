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
                      <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ $user->name }}">
                      <span class="invalid-feedback">
                          {{ $errors->first('name') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" name="username" id="username" value="{{ $user->username }}">
                      <span class="invalid-feedback">
                          {{ $errors->first('username') }}
                      </span>
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
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}>
                            Administrator
                        </label>
                        <label for="STAFF" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="STAFF" value="STAFF" {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}>
                            Staff
                        </label>
                        <label for="CUSTOMER" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}>
                            Customer
                        </label>
                        <span class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" name="phone" id="phone" value="{{ $user->phone }}">
                        <span class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </span>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}" name="address" id="address" rows="2">{{ $user->address }}</textarea>
                      <span class="invalid-feedback">
                          {{ $errors->first('address') }}
                      </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="avatar">Avatar</label>
                      <br>
                      <img src="{{ asset("storage/.$user->avatar") }}" width="240" height="240" class="img-profile mb-2">
                      <input type="file" class="form-control-file {{ $errors->first('avatar') ? 'is-invalid' : '' }}" name="avatar" id="avatar">
                      <small class="text-muted">Keep empty if you not change</small>
                      <span class="invalid-feedback">
                          {{ $errors->first('avatar') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="email">E-mail Address</label>
                      <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ $user->email }}">
                      <span class="invalid-feedback">
                          {{ $errors->first('email') }}
                      </span>
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
