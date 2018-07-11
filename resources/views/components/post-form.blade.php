<div class="form-group">
    <label for="inputPostTitle">Post Title</label>
    <input name="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" id="inputPostTitle" aria-describedby="inputPostTitle" value="{{ old('name') ?: $post->name ?? '' }}">
    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
</div>

<div class="form-grouo">
    <label for="inputPostContent">Content</label>
    <textarea name="content[1][content]" class="form-control @if ($errors->has('content.1.content')) is-invalid @endif" id="inputPostContent" rows="3">{{ old('content.1.content') ?: $post->main_content ?? '' }}</textarea>
    <div class="invalid-feedback">{{ $errors->first('content.1.content') }}</div>

    <input hidden name="content[1][name]" value="{{ App\Post::$main_content_name }}">
    <input hidden name="content[1][type]" value="{{ App\Post::$main_content_type }}">
</div>

<div class="form-check mt-4">
    <input name="inputPostLive" type="checkbox" class="form-check-input" @if($post->live['inputPostLive'] ?? false) checked @endif>
    <label class="form-check-label" for="inputPostLive">Is Live?</label>
</div>

@if (!$errors->isEmpty())
    <div class="alert alert-danger mt-4" role="alert">
        <strong>Please fix the following errors:</strong></br>
        @foreach ($errors->all() as $key => $error)
            {{ $error }}</br>
        @endforeach
    </div>
@endif
