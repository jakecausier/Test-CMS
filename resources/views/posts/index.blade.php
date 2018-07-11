@extends('layouts.app')

@section('content')
<div class="container">

    <a href="/posts/create">Add new post</a>

    <div class="card">
        <div class="card-body">
            
            @component('components.posts-table', ['posts' => $posts])
            @endcomponent

            {{ $posts->links() }}

            </nav>
        </div>
    </div>
</div>
@endsection
