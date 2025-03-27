<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPARI | Dashboard</title>
  {{-- JQUERy --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="/css/dashboard.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  {{-- trix --}}
  <link rel="stylesheet" href="/css/trix.css">
  <script type="text/javascript" src="/js/trix.js"></script>


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>

</head>

<body>

  @include('dashboard.layouts.header')

  <div class="container-fluid">
    <div class="row">
      @include('dashboard.layouts.sidebar')

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('content')
      </main>
    </div>
  </div>

  {{-- Bootstrap JS --}}
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

  <script src="/js/dashboard.js"></script>
</body>

</html>
