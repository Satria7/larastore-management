@extends('layouts.master')

@section('title')
    Add User
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route("users.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="name">Full Name</label>
                      <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name" id="name">
                      <span class="invalid-feedback">
                          {{ $errors->first('name') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" id="username" {{ $errors->first('username') ? 'is-invalid' : '' }}>
                      <span class="invalid-feedback">
                          {{ $errors->first('username') }}
                      </span>
                    </div>
                    <div class="form-group">
                        <label for="roles[]">Roles</label>
                        <div class="form-check">
                        <label for="ADMIN" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="ADMIN" value="ADMIN">
                            Administrator
                        </label>
                        <label for="STAFF" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="STAFF" value="STAFF">
                            Staff
                        </label>
                        <label for="CUSTOMER" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input {{ $errors->first('roles') ? 'is-invalid' : '' }}" name="roles[]" id="CUSTOMER" value="CUSTOMER">
                            Customer
                        </label>
                      <span class="invalid-feedback">
                          {{ $errors->first('roles') }}
                      </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" name="phone" id="phone">
                      <span class="invalid-feedback">
                          {{ $errors->first('phone') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}" name="address" id="address" rows="2"></textarea>
                      <span class="invalid-feedback">
                          {{ $errors->first('address') }}
                      </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="avatar">Avatar</label>
                      <input type="file" class="form-control-file {{ $errors->first('avatar') ? 'is-invalid' : '' }}" name="avatar" id="avatar">
                      <span class="invalid-feedback">
                          {{ $errors->first('avatars') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="email">E-mail Address</label>
                      <input type="email" class="form-control {{ $errors->first('avatar') ? 'is-invalid' : '' }}" name="email" id="email">
                      <span class="invalid-feedback">
                          {{ $errors->first('email') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" name="password" id="password">
                      <span class="invalid-feedback">
                          {{ $errors->first('password') }}
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="password_confirmation">Password Confirmation</label>
                      <input type="password" class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
                      <span class="invalid-feedback">
                          {{ $errors->first('password_confirmation') }}
                      </span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add User</button>
                        <a href="" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
