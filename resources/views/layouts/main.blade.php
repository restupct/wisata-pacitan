<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  {{-- <link rel="stylesheet" href="/css/bootstrap.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
  {{-- CSSKu --}}
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>{{ $title }}</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" href="/">Pacitan</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="/posts">Wisata</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('categories*') ? 'active' : '' }}" href="/login" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($categories as $category)
                <li><a class="dropdown-item" href="/categories/{{ $category->slug }}">{{ $category->kategori }}</a>
                </li>
              @endforeach
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/dashboard">Dahboard</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <form action="/logout" method="post">@csrf<button type="submit" class="dropdown-item">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a href="/login" class="nav-link">Login</a>
            </li>
          @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->
  @yield('content')
  <script src="/js/bootstrap.bundle.min.js"></script>
  <!-- Fontawesome JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

</body>

</html>
