@extends('layouts.master')

@section('title')
    List Books
@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <div class="d-sm-flex align-items-center justify-content-between">
        <a href="{{ route("books.create") }}" class="btn btn-primary">Add new Book</a>
        <form action="{{ route("books.index") }}" class="d-sm-inline-block form-inline">
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
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Categories</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>
                    @if ($book->cover)
                        <img src="{{ asset("storage/".$book->cover) }}" width="100">
                    @endif
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    @if ($book->status == "DRAFT")
                        <span class="badge badge-warning">{{ $book->status }}</span>
                    @else
                        <span class="badge badge-success">{{ $book->status }}</span>
                    @endif
                </td>
                <td>
                    <ul class="pl-3">
                        @foreach ($book->categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $book->stock }}</td>
                <td>{{ $book->price }}</td>
                <td>
                    <a href="{{ route("books.show", [$book->id]) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route("books.edit", [$book->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route("books.destroy", [$book->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this user?')">
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
    {{ $books->links() }}
</div>
@endsection
