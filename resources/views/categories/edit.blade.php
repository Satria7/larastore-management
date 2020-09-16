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
                  <input type="text" name="name" id="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" value="{{ $category->name }}">
                  <span class="invalid-feedback">
                      {{ $errors->first('name') }}
                  </span>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}" value="{{ $category->slug }}">
                    <span class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </span>
                </div>
                <div class="form-group">
                  <label for="image">Category Image</label>
                  <br>
                  @if ($category->image)
                      <img src="{{ asset("storage/".$category->image) }}" width="300">
                  @endif
                  <input type="file" class="form-control-file {{ $errors->first('image') ? 'is-invalid' : '' }}" name="image" id="image">
                  <small class="text-muted">Kosongkan jika tidaak ingin merubah</small>
                  <span class="invalid-feedback">
                      {{ $errors->first('image') }}
                  </span>
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
