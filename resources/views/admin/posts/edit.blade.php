@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<h2>Edit Post</h2>

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Scheduled Time</label>
        <input type="datetime-local" name="scheduled_time" class="form-control" 
               value="{{ old('scheduled_time', \Carbon\Carbon::parse($post->scheduled_time)->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="scheduled" @selected($post->status == 'scheduled')>Scheduled</option>
            <option value="published" @selected($post->status == 'published')>Published</option>
            <option value="failed" @selected($post->status == 'failed')>Failed</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Platforms</label>
        <select name="platform_ids[]" class="form-select" multiple>
            @foreach($platforms as $platform)
                <option value="{{ $platform->id }}" 
                        @selected($post->platforms->pluck('id')->contains($platform->id))>
                    {{ $platform->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
