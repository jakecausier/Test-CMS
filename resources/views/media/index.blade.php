@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('media.create') }}" class="btn btn-info">Add files</a> </div>

                    <div class="card-body">
                        @foreach ($folders as $folder)
                            <h1>{{ $folder->name }}</h1>
                            @if ($folder->contentByType('media')->count())
                                <table class="table">
                                    <th>Filename</th>
                                    <th>Filesize</th>
                                    <th>Image Preview</th>
                                    @foreach ($folder->contentByType('media') as $content)
                                        <tr>
                                            <td><a href="{{ $content->image_url }}" target="_blank">{{ $content->name }}</a></td>
                                            <td>{{ $content->meta['size'] }} bytes</td>
                                            <td><img src="{{ $content->image_url }}" class="img-fluid"></td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                You have no files yet!
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
