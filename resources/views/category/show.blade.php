{{-- @dd($posts) --}}
@extends('layouts.main')
@section('content')
  <div class="container mt-5 pt-3">
    @if ($posts->count())
      <div class="card d-block text-center mb-3">
        <img src="{{ asset('storage') . '/' . $posts[0]->gambar }}" alt="{{ $posts[0]->title }}"
          class="img-fluid col-sm-5" >
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
    @else
      <p class="text-center fs-4">Post tidak ditemukan.</p>
    @endif

    <div class="container mb-3">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)">
                <a href="/categories/{{ $post->category->slug }}"
                  class="text-decoration-none text-white">{{ $post->category->kategori }}</a>
              </div>
              <img src="{{ asset('storage') . '/' . $post->gambar }}" alt="{{ $post->title }}" class="card-img-top"
                style="height: 175px" alt="{{ $post->title }}">
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
@endsection
