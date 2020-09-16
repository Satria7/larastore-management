@extends('layouts.master')

@section('title')
    Forbidden
@endsection

@section('content')
              <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto" data-text="403">403</div>
            <p class="lead text-gray-800 mb-5">{{ $exception->getMessage() }}</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="index.html">&larr; Back to Dashboard</a>
          </div>
@endsection
