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
                    <form action="{{ route("books.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="title">Book Title</label>
                          <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="cover">Book Cover</label>
                          <input type="file" class="form-control-file" name="cover" id="cover">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="categories[]" multiple id="categories" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock">
                        </div>
                        <div class="form-group">
                          <label for="author">Author</label>
                          <input type="text" name="author" id="author" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="publisher">Publisher</label>
                          <input type="text" name="publisher" id="publisher" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Book Price</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <hr>
                        <div class="form-acton">
                            <button name="save_action" class="btn btn-primary" value="PUBLISH">Publish Book</button>
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
</script>

@endsection
