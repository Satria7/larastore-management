@extends('layouts.master')

@section('title')
    List Users
@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <div class="d-sm-flex align-items-center justify-content-between">
        <a href="{{ route("users.create") }}" class="btn btn-primary">Add new User</a>
        <form action="{{ route("users.index") }}" class="d-sm-inline-block form-inline">
            <div class="form-group">
              <input type="text" class="form-control mr-1" placeholder="Filter email..." name="keyword" value="{{ Request::get("keyword") }}">
              <select name="status" id="status" class="form-control mr-1">
                  <option value="" selected disabled>Status</option>
                  <option value="ACTIVE">Active</option>
                  <option value="INACTIVE">Inactive</option>
              </select>
              <button type="submit" class="btn btn-primary">Filter User</button>
            </div>
          </form>
        </div>
    </div>
    <div class="card-body">
            @if (session("status"))
                <div class="alert alert-success" role="alert">
                    {{ session("status") }}
                </div>
            @endif
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>E-mail address</th>
                <th>Status</th>
                <th>Avatar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->status == "ACTIVE")
                        <span class="badge badge-success">
                            {{ $user->status }}
                        </span>
                    @else
                        <span class="badge badge-danger">
                            {{ $user->status }}
                        </span>
                    @endif
                </td>
                <td>
                    @if ($user->avatar)
                        <img src="{{ asset("storage/".$user->avatar) }}" style="height: 50px; width: 50px; object-fit:cover; object-position:center; border-radius: 50%;">
                    @else
                        <img src="{{ $user->avatar }}" style="height: 50px; width: 50px; object-fit:cover; object-position:center; border-radius: 50%;">
                    @endif
                </td>
                <td>
                    <a href="{{ route("users.show", [$user->id]) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route("users.edit", [$user->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route("users.destroy", [$user->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this user?')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
<div class="pagination mt-2">
    {{ $users->links() }}
</div>
@endsection
