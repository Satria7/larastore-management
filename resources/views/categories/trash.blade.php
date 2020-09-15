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
            <a href="{{ route("categories.index") }}" class="mr-2">Published</a>
            <a href="{{ route("categories.trash") }}" class="btn btn-success mr-2">Trash</a>
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
                    <a href="{{ route("categories.restore", [$category->id]) }}" class="btn btn-success btn-sm">Restore</a>
                    <form action="{{ route("categories.delete-permanent", [$category->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Delete permanent this category?')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">Permanent delete</button>
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
