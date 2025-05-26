<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
  <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
          {{-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.platforms.index') }}">Platforms</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings') }}">Settings</a></li> --}}
      </ul>
  </div>
</nav>
