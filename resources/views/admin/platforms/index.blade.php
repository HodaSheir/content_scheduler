@extends('layouts.admin')

@section('title', 'Platforms')

@section('content')
<h1>Platforms</h1>
<a href="{{ route('admin.platforms.create') }}" class="btn btn-success mb-3">Add New Platform</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>API Key</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($platforms as $platform)
        <tr>
            <td>{{ $platform->name }}</td>
            <td>{{ $platform->api_key }}</td>
            <td>
                <a href="{{ route('admin.platforms.edit', $platform->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('admin.platforms.destroy', $platform->id) }}" method="POST" style="display:inline;">
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
