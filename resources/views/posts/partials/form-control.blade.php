@php
//dd($post->tags)
@endphp
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
        placeholder="Title .." value="{{ old('title') ?? $post->title }}">
    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
        <option value="" disabled>Choose Category</option>
        @forelse ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $post->catgory_id ? 'selected' : '' }}>
            {{ $category->name }}</option>
        @empty
        <option disabled>No thing</option>
        @endforelse
    </select>
    @error('category')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="tag">Tags</label>
    <select name="tags[]" class="form-control selectTags @error('tags') is-invalid @enderror" id="tags" multiple>
        @foreach ($post->tags as $tag)
        <option value="{{ $tag->id }}" {{ $post }} selected>{{ $tag->name }}</option>
        @endforeach
        @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" {{ $post }}>{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="body">Post</label>
    <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body"
        rows="3">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>
