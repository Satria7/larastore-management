@extends('layouts.master')

@section('title')
    Add Category
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">


                <form action="{{ route("categories.update", [$category->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
                </div>
                <div class="form-group">
                  <label for="image">Category Image</label>
                  <br>
                  @if ($category->image)
                      <img src="{{ asset("storage/".$category->image) }}" width="300">
                  @endif
                  <input type="file" class="form-control-file" name="image" id="image">
                  <small class="text-muted">Kosongkan jika tidaak ingin merubah</small>
                </div>
                <hr>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="" class="btn btn-warning">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
