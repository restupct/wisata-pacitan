@extends('layouts.main')
@section('content')
  <!-- Jumbotron -->
  <div class="jumbotron text-center">
    <h1 class="display-4 fw-bold">Pacitan Indah</h1>
    <p class="lead">Selamat datang di website Pariwisata Pacitan</p>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="1"
        d="M0,96L48,117.3C96,139,192,181,288,213.3C384,245,480,267,576,261.3C672,256,768,224,864,229.3C960,235,1056,277,1152,282.7C1248,288,1344,256,1392,240L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
      </path>
    </svg>
  </div>
  <!-- Akhir Jumbotron -->
  <!-- Wisata -->
  <section id="wisata">
    <div class="container mt-5 mb-5">
      <div class="row text-center mb-3">
        <div class="col">
          <h2>Pariwisata teratas</h2>
        </div>
        <div class="row">
          @foreach ($posts as $post)
            <div class="col-md">
              <div class="card">
                <a href="#"><img src="{{ asset('storage') }}/{{ $post->gambar }}" class="card-img-top" style="height: 175px"
                    alt="pangasan"></a>
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">{{ $post->excerpt }}<a href="posts/{{ $post->slug }}">Read
                      more</a></p>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
    </div>
  </section>
  <!-- Akhir Wisata -->
  <!-- About -->
  <section id="about">
    <div class="container mb-5">
      <div class="row text-center">
        <div class="col">
          <h2>Tentang</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <p>Kabupaten Pacitan terletak di bagian ujung Selatan barat daya Provinsi Jawa Timur, dengan luas wilayah
            1.389,8716Km.
            Luas
            tersebut sebagian besar berupa perbukitan yaitu kurang lebih 85%, gunung – gunung kecil lebih kurang 300
            buah menyebar
            di seluruh wilayah Kabupaten Pacitan dan jurang terjal dan selebihnya adalah adalah
            daratan</p>
        </div>
        <div class="col-md-4">
          <p>Pacitan memiliki julukan "Kota 1001 Goa" hal itu dikarenakan banyaknya goa-goa yang menawan dan eksotis
            yang ada di Pacitan, seperti Goa Gong, Goa Tabuhan dan masih banyak lagi. Selain memiliki banyak goa, wisata
            di Pacitan juga beragam. Banyak pantai, sungai dll yang tak kalah menawannya.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir About -->
  @include('layouts.footer')
@endsection
