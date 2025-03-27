@extends('dashboard.layouts.main')
@section('content')
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-8">
        <h1 class="my-3">{{ $post->title }}</h1>
        <div class="mb-3">
          <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span>Kembali ke post</a>
          {{-- Edit --}}
          <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span
              data-feather="edit"></span>Edit</a>
          {{-- Hapus --}}
          <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')"><span data-feather="x-circle">
              </span>Hapus</button>
          </form>
        </div>
        {{-- Gambar --}}
        @if ($post->gambar)
          <img src="{{ asset('storage/' . $post->gambar) }}" class="img-preview img-fluid">
        @endif
        {{-- Body --}}
        <div class="mb-3">
          <p>{!! $post->body !!}</p>
        </div>
        @if ($post->galeris()->count())
          <h2>Galeri</h2>
          <div class="row" data-bs-toggle="modal" data-bs-target="#lightbox">
            @foreach ($post->galeris as $galeri)
              <div class="col-12 col-md-6">
                <img src="{{ asset('storage' . '/' . $galeri->gambar) }}" />
              </div>
            @endforeach
          </div>
          {{-- Akhir Galeri --}}
        @endif
        @if ($post->lokasi)
          <h3>Lokasi</h3>
          {!! $post->lokasi !!}
        @endif
      </div>
    </div>
  </div>
@endsection
