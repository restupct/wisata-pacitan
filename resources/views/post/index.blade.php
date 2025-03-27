@extends('layouts.main')
@section('content')
  <div class="container mt-5 pt-3">
    <h1 class="text-center">Semua post</h1>
    {{-- cari --}}
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="/posts" method="get">
          <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari.." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
          </div>
        </form>
      </div>
    </div>

    @if ($posts->count())
      <div class="card d-block text-center mb-3">
        <img src="{{ asset('storage') . '/' . $posts[0]->gambar }}" alt="{{ $posts[0]->title }}"
          class="img-fluid col-sm-5">
        <div class="card-body text-center">
          <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}"
              class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
          <p>
            <small class="text-muted">
              By. {{ $posts[0]->user->name }} {{ $posts[0]->created_at->diffForHumans() }}
            </small>
          </p>
          <p class="card-text">{!! $posts[0]->excerpt !!}</p>
          <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
        </div>
      </div>


      <div class="container mb-3">
        <div class="row">
          @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)">
                  <a href="/categories/{{ $post->category->slug }}"
                    class="text-decoration-none text-white">{{ $post->category->kategori }}</a>
                </div>
                <img src="{{ asset('storage') . '/' . $post->gambar }}" class="card-img-top"
                  alt="{{ $post->title }}" style="height: 200px">
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <small class="text-muted">
                    By. {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}
                  </small>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
  </div>
  @include('layouts.footer')
@else
  <p class="text-center fs-4">Post tidak ditemukan.</p>
  @endif
@endsection
