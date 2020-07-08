@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $post->title }}</h1>
        <div class="text-secondary">
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a> on
            {{ $post->created_at->format("d F, Y") }}
            @foreach ($post->tags as $tag)
            <a href="/tags/{{ $tag->slug }}"><span class="badge badge-primary">{{ $tag->name }} </a>
            @endforeach
        </div>
        <div class="text-secondary">
            Wrote by {{ $post->author->name }}
        </div>

        @can('delete', $post)
        <div class="d-flex justify-content-between">
            <form action="{{ route('posts.destroy', $post->slug) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-info">Edit</a>
        </div>
        @endcan

        <hr>
    </div>
    <img src="{{ $post->takeImage }}" alt="{{ $post->slug }}" class="card-image-top"
        style="height: 570px; object-fit: cover; object-position: center;">
    <div class="col-md-12 mt-4">
        <p>{!! nl2br($post->body) !!}</p>
    </div>
</div>
<hr>
@endsection
