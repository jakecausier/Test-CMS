@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header"><a href="{{ route('media.create') }}" class="btn btn-info">Add files</a> </div>

            <div class="card-body">

                <media-gallery :media='@json($folders)' delete-url='{{ url('api/contents') }}'>

                </media-gallery>

            </div>
        </div>
    </div>

@endsection
