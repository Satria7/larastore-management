@extends('layouts.master')

@section('title')
    Detail Category
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $category->name }}</h4>
        <p class="card-text">{{ $category->slug }}</p>
        @if ($category->image)
            <img src="{{ asset("storage/".$category->image) }}" width="300">
        @endif
    </div>
</div>
        </div>
    </div>
@endsection
