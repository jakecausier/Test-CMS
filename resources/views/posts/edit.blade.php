@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                    <h1 class="mb-4">Editing {{ $post->name }}</h1>

                    {{ $errors }}

                    <form method="POST" action="{{ route('posts.update', $post) }}">

                        @method('PUT')

                        @component('components.post-form', compact('post'))
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
