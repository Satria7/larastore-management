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
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="roles[]">Roles</label>
                        <div class="form-check">
                        <label for="ADMIN" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="ADMIN" value="ADMIN">
                            Administrator
                        </label>
                        <label for="STAFF" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="STAFF" value="STAFF">
                            Staff
                        </label>
                        <label for="CUSTOMER" class="form-check-label mr-4">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="CUSTOMER" value="CUSTOMER">
                            Customer
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control" name="address" id="address" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="avatar">Avatar</label>
                      <input type="file" class="form-control-file" name="avatar" id="avatar">
                    </div>
                    <div class="form-group">
                      <label for="email">E-mail Address</label>
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                      <label for="password_confirmation">Password Confirmation</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
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
