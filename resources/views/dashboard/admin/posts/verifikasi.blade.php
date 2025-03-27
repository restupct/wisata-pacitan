@extends('dashboard.layouts.main')
@section('content')
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-8">
        <form action="/dashboard/admin/posts/verifikasi/{{ $post->slug }}" method="post">
          @method('PUT')
          @csrf
          <h1 class="my-3">{{ $post->title }}</h1>
          @if ($post->gambar)
            <img src="{{ asset('storage/' . $post->gambar) }}" class="img-preview img-fluid">
          @endif
          {{-- Body --}}
          <p>{!! $post->body !!}</p>
          @if ($post->galeris()->count())
            <h2>Galeri</h2>
            <div class="row" data-bs-toggle="modal" data-bs-target="#lightbox">
              @foreach ($post->galeris as $galeri)
                <div class="col-12 col-md-6 mb-3">
                  <img src="{{ asset('storage' . '/' . $galeri->gambar) }}" />
                </div>
              @endforeach
            </div>
          @endif
          <div class="mb-3">
            @if ($post->lokasi)
              <h3>Lokasi</h3>
              {!! $post->lokasi !!}
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Verifikasi</button>

          <button type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#modalTolakPost{{ $post->slug }}">Tolak
          </button>
        </form>
        {{-- Tolak Post --}}

        <div class="modal fade" id="modalTolakPost{{ $post->slug }}" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTolakPost">Alasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/dashboard/admin/posts/verifikasi/not-verified/{{ $post->slug }}" method="post">
                  @method('PUT')
                  @csrf
                  <input type="text" name="keterangan" class="form-control">
                  <button type="submit" class="btn btn-danger mt-3">Tolak Post</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
