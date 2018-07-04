@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="/users">Back to users</a>

            <div class="card">
                <div class="card-body">

                    <h1>{{ $user->name }}</h1>
                    <h4>{{ $user->email }}</h4>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
