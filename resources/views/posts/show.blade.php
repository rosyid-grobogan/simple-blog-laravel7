@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8">
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
        <img src="{{ $post->takeImage }}" alt="{{ $post->slug }}" class="card-image-top"
            style="height: 570px; object-fit: cover; object-position: center;">
        <div class="col-md-12 mt-4">
            <p>{!! nl2br($post->body) !!}</p>
        </div>
    </div>

    <div class="col-md-4">
        @forelse ($posts as $post)
        <div class="card mb-4">
            <a href="{{ route('posts.show', $post->slug) }}" class="d-flex justify-content-center">
                <img src="{{ $post->takeImage }}" alt="{{ $post->slug }}" class="card-image-top"
                    style="height: 350px; object-fit: cover; object-position: center;">
            </a>

            <div class="card-body">
                <div class="text-secondary">
                    <a class="text-dark"
                        href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                </div>
                <h5 class="card-title"><a class="text-dark"
                        href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a></h5>
                <p class="card-text">{{Str::limit( $post->body, 100, '') }} </p>
                <div class="row justify-content-between px-3 pt-3">
                    <div class="text-secondary">
                        Wrote by {{ $post->author->name }}
                    </div>
                    <div class="text-secondary">
                        <small class="text-muted">Published on {{ $post->created_at->format("d F, Y") }}</small>
                    </div>
                </div>
            </div>

            @can('update', $post)
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('posts.show', $post->slug) }}/delete" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('posts.show', $post->slug) }}/edit" class="btn btn-info">Edit</a>
                </div>
            </div>
            @endcan
        </div>
        @empty
        <div class="col-md-4">
            <div class="alert alert-info">
                There are no posts.
            </div>
        </div>
        @endforelse
    </div>

</div>
<hr>
@endsection
