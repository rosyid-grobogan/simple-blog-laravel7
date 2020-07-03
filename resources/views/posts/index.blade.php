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
            <h4 class="btn outline">All Post</h4>
        </div>
        <div>
            <a href="/posts/create" class="btn btn-primary">New Post</a>
        </div>
    </div>
</div>


<div class="row">

    @forelse ($posts as $post)
    <div class="card mx-4 mb-4" style="width: 18rem;">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image
                cap</text>
        </svg>
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <div class="text-secondary">
                {{ $post->category->name }}
            </div>

            <p class="card-text">{{Str::limit( $post->body, 100, '') }} </p>

            <a class="btn btn-secondary btn-sm" href="posts/{{ $post->slug }}" role="button">See more &raquo;</a>

        </div>
        <div class="card-footer">
            <small class="text-muted">Published on {{ $post->created_at->format("d F, Y") }}</small>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <form action="/posts/{{ $post->slug }}/delete" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-info">Edit</a>
            </div>
        </div>
    </div>

    @empty
    <div class="col-md-4">
        <div class="alert alert-info">
            There are no posts.
        </div>
    </div>
    @endforelse




</div>
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>


<hr>
@endsection
