@extends('layouts.master', ['title' => 'Edit Post'] )
@section('jumbotron')
<div class="jumbotron">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">


            <form action="/posts/{{ $post->slug }}/edit" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('posts.partials.form-control')
            </form>
        </div>
    </div>
</div>
@stop
