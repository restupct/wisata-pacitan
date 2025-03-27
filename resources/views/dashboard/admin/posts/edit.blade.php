@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $post->title }}</h1>
    <h3>Penulis : {{ $post->user->name }}</h3>
  </div>

  {{-- Form --}}
  <div class="col-lg-8">
    <form action="/dashboard/admin/posts/{{ $post->slug }}" method="post" class="mb-5"
      enctype="multipart/form-data">
      @method('put')
      @csrf
      {{-- Judul --}}
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title', $post->title) }}">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      {{-- Kategori --}}
      <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select name="category_id" class="form-select">
          @foreach ($categories as $category)
            @if (old('category_id', $post->category_id) == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->kategori }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->kategori }}</option>
            @endif
          @endforeach
        </select>
      </div>
      {{-- Gambar --}}
      <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Post</label>
        <input type="hidden" name="gambarLama" value="{{ $post->gambar }}">
        @if ($post->gambar)
          <img src="{{ asset('storage/' . $post->gambar) }}" alt=""
            class="mb-3 img-preview img-fluid col-sm-5 d-block">
        @endif
        <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">
        @error('gambar')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      {{-- Body --}}
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
      </div>
      {{-- Lokasi --}}
      <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <button type="button" class="border-0" data-bs-toggle="modal" data-bs-target="#editLokasi"><span
            data-feather="help-circle"></span></button>
        <div class="modal fade" id="editLokasi">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Cara menambah lokasi :</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Untuk memasukkan lokasi, silahkan buka <a href="https://www.google.com/maps"
                    class="text-decoration-none" target="_blank" rel="noopener noreferrer">Maps</a>, ketik nama wisata
                  yang ingin ditambahkan, klik
                  <strong>Bagikan</strong> -> <strong>Sematkan peta</strong> -> Pilih Ukuran -> <strong>Salin
                    HTML</strong> lalu <i>paste</i> atau tempelkan ke dalam form lokasi.
                </p>
                <center>
                  <img src="{{ asset('storage/1.png') }}" style="width: 400px">
                  <img src="{{ asset('storage/2.png') }}" style="width: 400px">
                </center>
              </div>
            </div>
          </div>
        </div>
        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
          value="{{ old('lokasi', $post->lokasi) }}">
        @error('lokasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
  </div>

  <script>
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })
  </script>
@endsection
