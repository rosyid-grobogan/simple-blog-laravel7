@extends('layouts.master', ['title' => 'All Post'])
@section('jumbotron')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a
            jumbotron and three supporting pieces of content. Use it as a starting point to create something more
            unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
    </div>
</div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div>
            @isset ($category)
            <h4>Category: {{ $category->name }}</h4>
            @endisset
            @isset($tag)
            <h4>Tags: {{ $tag->name }}</h4>
            @endisset
            @if (!isset($category) && !isset($tag))
            <h4>All Post</h4>
            @endif
        </div>
        @if(Auth::check())
        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
        </div>
        @else
        <div>
            <a href="{{ route('login') }}" class="btn btn-primary">Login to create new post</a>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-7">
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
<div class="d-flex justify-content-center">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
<hr>
@endsection
