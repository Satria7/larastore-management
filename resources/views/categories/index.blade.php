@extends('layouts.master')

@section('title')
    List Category
@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <div class="d-sm-flex align-items-center justify-content-between">
        <div class="action-naviation">
            <a href="{{ route("categories.create") }}" class="btn btn-primary mr-3">Add new category</a>
            <a href="{{ route("categories.index") }}" class="btn btn-success mr-2">Publishhed</a>
            <a href="{{ route("categories.trash") }}" class="mr-2">Trash</a>
        </div>
        <form action="{{ route("categories.index") }}" class="d-sm-inline-block form-inline">
            <div class="form-group">
              <input type="text" class="form-control mr-1" placeholder="Filter name..." name="keyword" value="{{ Request::get("keyword") }}">
              <button type="submit" class="btn btn-primary">Filter Category</button>
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
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    @if ($category->image)
                        <img src="{{ asset("storage/".$category->image) }}" width="150">
                    @endif
                </td>
                <td>
                    <a href="{{ route("categories.show", [$category->id]) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route("categories.edit", [$category->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route("categories.destroy", [$category->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Move this category to trash?')">
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
    {{ $categories->links() }}
</div>
@endsection
