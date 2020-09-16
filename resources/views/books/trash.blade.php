@extends('layouts.master')

@section('title')
    List Books
@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <div class="d-sm-flex align-items-center justify-content-between">
        <div class="action-naviation">
            <a href="{{ route("books.create") }}" class="btn btn-primary mr-3">Add new category</a>
            <a href="{{ route("books.index") }}" class="mr-3 {{ Request::get('status') == NULL && Request::path() == 'books' ? 'font-weight-bold text-success' : '' }} ">All Book</a>
            <a href="{{ route("books.index", ['status' => 'publish']) }}" class="mr-3 {{ Request::get('status') == 'publish' ? 'font-weight-bold text-success' : '' }}">Publishhed</a>
            <a href="{{ route("books.index", ['status' => 'draft']) }}" class="mr-3 {{ Request::get('status') == 'draft' ? 'font-weight-bold text-success' : '' }}">Draft</a>
            <a href="{{ route("books.trash") }}" class="mr-3 {{ Request::path() == 'books/trash' ? 'font-weight-bold text-success' : '' }}">Trash</a>
        </div>
        <form action="{{ route("books.index") }}" class="d-sm-inline-block form-inline">
            <div class="form-group">
              <input type="text" class="form-control mr-1" placeholder="Filter title..." name="keyword" value="{{ Request::get("keyword") }}">
              <button type="submit" class="btn btn-primary">Filter Book</button>
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
                    <form action="{{ route("books.restore", [$book->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Restore this book?')">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                    </form>
                    <form action="{{ route("books.delete-permanent", [$book->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Move this Book to Trash?')">
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
