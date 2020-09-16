@extends('layouts.master')

@section('title')
    Add Book
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    @if (session("status"))
                        <div class="alert alert-success">
                            {{ session("status") }}
                        </div>
                    @endif
                    <form action="{{ route("books.update", [$book->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                          <label for="title">Book Title</label>
                          <input type="text" name="title" id="title" class="form-control {{ $errors->first('title') ? 'is-invalid' : '' }}" value="{{ $book->title }}">
                          <span class="invalid-feedback">
                              {{ $errors->first('title') }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="cover">Book Cover</label>
                          <br>
                          @if ($book->cover)
                              <img src="{{ asset("storage/".$book->cover) }}" width="500">
                          @endif
                          <input type="file" class="form-control-file {{ $errors->first('cover') ? 'is-invalid' : '' }}" name="cover" id="cover">
                          <small class="text-muted">Kosongka jika tidak ingin merubah</small>
                          <span class="invalid-feedback">
                              {{ $errors->first('cover') }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="slug">Slug</label>
                          <input type="text" name="slug" id="slug" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}" value="{{ $book->slug }}">
                          <span class="invalid-feedback">
                              {{ $errors->first('slug') }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="3">{{ $book->description }}</textarea>
                          <span class="invalid-feedback">
                              {{ $errors->first('description') }}
                          </span>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="categories[]" multiple id="categories" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control {{ $errors->first('stock') ? 'is-invalid' : '' }}" name="stock" id="stock" value="{{ $book->stock }}">
                            <span class="invalid-feedback">
                                {{ $errors->first('stock') }}
                            </span>
                        </div>
                        <div class="form-group">
                          <label for="author">Author</label>
                          <input type="text" name="author" id="author" class="form-control {{ $errors->first('author') }}" value="{{ $book->author }}">
                          <span class="invalid-feedback">
                              {{ $errors->first('author') }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="publisher">Publisher</label>
                          <input type="text" name="publisher" id="publisher" class="form-control {{ $errors->first('publisher') ? 'is-invalid' : '' }}" value="{{ $book->publisher }}">
                          <span class="invalid-feedback">
                              {{ $errors->first('publisher') }}
                          </span>
                        </div>
                        <div class="form-group">
                            <label for="price">Book Price</label>
                            <input type="number" name="price" id="price" class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" value="{{ $book->price }}">
                            <span class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="PUBLISH" {{ $book->status == "PUBLISH" ? "selected" : "" }}>Publish</option>
                                <option value="DRAFT" {{ $book->statuus == "DRAFT" ? "selected" : "" }}>Draft</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-acton">
                            <button name="save_action" class="btn btn-primary" value="PUBLISH">Update Book</button>
                            <button name="save_action" class="btn btn-warning" value="DRAFT">Save as Draft</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
    ajax: {
        url: 'http://127.0.0.1:8000/ajax/categories/search',
        processResults: function(data){
        return {
            results: data.map(function(item){return {id: item.id, text: item.name} })
        }
        }
    }
    });

    var categories = {!! $book->categories !!}
    categories.forEach(function(category){
      var option = new Option(category.name, category.id, true, true);
      $('#categories').append(option).trigger('change');
    });

</script>

@endsection
