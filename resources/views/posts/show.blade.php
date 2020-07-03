@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $post->title }}</h1>
        <div class="text-secondary">
            {{ $post->category->name }}
        </div>
    </div>
    <div class="col-md-12">
        <p>{{ $post->body }}</p>
    </div>
</div>
<hr>
@endsection
