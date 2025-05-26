@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row my-4">
    <!-- Scheduled Posts Widget -->
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Scheduled Posts</div>
            <div class="card-body">
                <h5 class="card-title">{{ $scheduledPosts }}</h5>
            </div>
        </div>
    </div>
    <!-- Published Posts Widget -->
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Published Posts</div>
            <div class="card-body">
                <h5 class="card-title">{{ $publishedPosts }}</h5>
            </div>
        </div>
    </div>
    <!-- Publishing Success Rate Widget -->
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Success Rate</div>
            <div class="card-body">
                <h5 class="card-title">{{ $successRate }}%</h5>
            </div>
        </div>
    </div>
    <!-- Posts Per Platform Widget -->
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Posts Per Platform</div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach($platformStats as $platform )
                        <li>{{ $platform->name }}: {{ $platform->posts_count }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Calendar View -->
<div class="row">
    <div class="col-12">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('styles')
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
@endpush
