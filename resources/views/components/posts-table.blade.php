<table class="table">
    <thead>
        <tr>
            @if ($show_author ?? true)<th scope="col">Author</th> @endif
            <th scope="col">Name</th>
            <th scope="col">Content</th>
            <th scope="col">Added on</th>
            <th scope="col">Updated on</th>
            <th scope="col">Live?</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $key => $post)
            <tr>
                @if ($show_author ?? true)<td><a href="{{ route('users.show', $post->author)}}">{{ optional($post->author)->name }}</a></td>@endif
                <td><a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a></td>
                <td>{{ $post->snippet }}</td>
                <td>{{ $post->created_at->format('d M, Y') }}</td>
                <td>{{ $post->updated_at->format('d M, Y') }}</td>
                <td>{{ ($post->live['live'] ?? false) ? 'True' : 'False' }}</td>
                <td><a href="{{ $post->edit_path }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
