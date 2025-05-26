@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
<h1>Posts</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Platform</th>
            <th>Status</th>
            <th>Scheduled Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>
              @foreach($post->platforms as $platform)
                {{ $platform->name }}@if (!$loop->last), @endif
              @endforeach
            </td>
            <td>{{ $post->status }}</td>
            <td>{{ $post->scheduled_time }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
