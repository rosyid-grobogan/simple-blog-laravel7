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
    <label for="body">Post</label>
    <textarea name="body" class="form-control" id="body" rows="3">{{ old('body') ?? $post->body }}</textarea>
</div>

<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>
