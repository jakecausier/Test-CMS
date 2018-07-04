<div class="form-group">
    <label for="inputPostTitle">Post Title</label>
    <input name="name" type="text" class="form-control" id="inputPostTitle" aria-describedby="inputPostTitle" value="{{ $post->name ?? '' }}">
</div>

<div class="form-grouo">
    <label for="inputPostContent">The content of the post</label>
    <textarea name="content" class="form-control" id="inputPostContent" rows="3">{{ $post->content ?? '' }}</textarea>
</div>
