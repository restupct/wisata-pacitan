<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
          <span data-feather="file"></span>
          Post
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}"
          href="/dashboard/users/{{ auth()->user()->id }}">
          <span data-feather="user"></span>
          Profil
        </a>
      </li>
    </ul>
    {{-- Admin --}}
    @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Admin</h6>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/admin/posts*') ? 'active' : '' }}"
            href="/dashboard/admin/posts">
            <span data-feather="file-text"></span>
            Semua Post
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/admin/categories*') ? 'active' : '' }}"
            href="/dashboard/admin/categories">
            <span data-feather="grid"></span>
            Kategori
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/admin/users*') ? 'active' : '' }}" href="/dashboard/admin/users">
            <span data-feather="users"></span>
            User
          </a>
        </li>
      </ul>
    @endcan
  </div>
</nav>
