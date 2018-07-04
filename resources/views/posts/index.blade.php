@extends('layouts.app')

@section('content')
<div class="container">

    <a href="/posts/create">Add new post</a>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Author</th>
                        <th scope="col">Name</th>
                        <th scope="col">Content</th>
                        <th scope="col">Added on</th>
                        <th scope="col">Updated on</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td><a href="{{ route('users.show', $post->author)}}">{{ optional($post->author)->name }}</a></td>
                            <td><a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a></td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->created_at->format('d M, Y') }}</td>
                            <td>{{ $post->updated_at->format('d M, Y') }}</td>
                            <td><a href="{{ $post->edit_path }}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
