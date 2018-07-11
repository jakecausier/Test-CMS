@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="/posts">Back to posts</a>

            <div class="card">
                <div class="card-body">

                    <h1>{{ $post->name }}</h1>

                    @foreach($post->content as $content)
                        <sub>{{ $content->name }}</sub>
                        <p>{{ $content->content }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
