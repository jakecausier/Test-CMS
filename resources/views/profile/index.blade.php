@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h1>{{ $user->name }}</h1>
        </div>
    </div>
</div>
@endsection
