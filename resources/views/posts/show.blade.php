@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $post->title }}</h1>

        <div class="text-secondary">
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a> on
            {{ $post->created_at->format("d F, Y") }}
            @foreach ($post->tags as $tag)
            <a href="#"><span class="badge badge-primary">{{ $tag->name }} <span
                        class="badge badge-pill badge-light">{{ $tag->count() }}</span></span></a>
            @endforeach
        </div>
        <hr>
    </div>

    <div class="col-md-12">
        <p>{{ $post->body }}</p>
    </div>
</div>
<hr>
@endsection
