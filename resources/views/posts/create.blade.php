@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="/posts">Back to posts</a>

            <div class="card">
                <div class="card-body">
                    
                    <h1 class="mb-4">Creating new post</h1>

                    {{ $errors }}

                    <form method="POST" action="{{ route('posts.store') }}">

                        @component('components.post-form')
                        @endcomponent

                        @csrf

                        <button type="submit" class="mt-4 btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
