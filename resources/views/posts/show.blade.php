@extends('layouts.master')
@section('content')
<div class="row">
    <h1 class="display-3">{{ $post->title }}</h1>
<p>{{ $post->body }}</p>
    <p>
</div>
<hr>
@endsection
