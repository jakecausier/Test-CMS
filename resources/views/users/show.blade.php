@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="">Back to users</a>

            <div class="card mb-4">
                <div class="card-body">

                    <h1>{{ $user->name }}</h1>
                    <h4>{{ $user->email }}</h4>

                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <h1>All posts by {{ $user->name }}</h1>

                    @component('components.posts-table', ['posts' => $user->posts, 'show_author' => false])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
