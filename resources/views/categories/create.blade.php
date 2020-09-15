@extends('layouts.master')

@section('title')
    Add Category
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">

                @if (session("status"))
                    <div class="alert alert-success">
                        {{ session("status") }}
                    </div>
                @endif

                <form action="{{ route("categories.store") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="image">Category Image</label>
                  <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <hr>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                    <a href="" class="btn btn-warning">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
