@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
  </div>
  @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
  @endif

  {{-- Form --}}
  <div class="col-lg-8">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
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
          <img src="{{ asset('storage/' . $post->gambar) }}" alt="" class="mb-3 img-preview img-fluid col-sm-5 d-block">
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
      {{-- Galeri --}}
      {{-- Input --}}
      {{-- Galeri --}}
      <label for="galeri" class="form-label">Galeri</label>
      <div class="mb-3 increment input-group control-group">
        <input type="file" name="galeri[]" class="form-control">
        <button type="button" class="btn btn-success">+</button>
      </div>
      {{-- Colne --}}
      <div class="clone d-none">
        <div class="mb-3 input-group control-group">
          <input type="file" name="galeri[]" class="form-control">
          <button type="button" class="btn btn-danger">-</button>
        </div>
      </div>
      @if ($post->galeris()->count())
        <h2>Galeri</h2>
        <div class="row" data-bs-toggle="modal" data-bs-target="#lightbox">
          @foreach ($post->galeris as $galeri)
            <div class="col-12 col-md-6">
              <img src="{{ asset('storage' . '/' . $galeri->gambar) }}" />
              {{-- Trigger Hapus --}}
              <button type="button" class="badge bg-danger border-0 mt-2" data-bs-toggle="modal"
                data-bs-target="#modalHapusGambar{{ $galeri->id }}">
                <span data-feather="x-circle"></span>
              </button>
            </div>
          @endforeach
        </div>
        {{-- Akhir Galeri --}}
      @endif
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
  {{-- Modal Hapus --}}
  @if ($post->galeris()->count())
    <div class="modal fade" id="modalHapusGambar{{ $galeri->id }}" tabindex="-1" aria-labelledby="modalHapusGambar"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h5>Yakin ingin hapus gambar?</h5>
          </div>
          <div class="modal-footer">
            <form action="/galeri/{{ $galeri->id }}" method="POST">
              @method('delete')
              @csrf
              <input type="hidden" name="gambar" value="{{ $galeri->gambar }}">
              <button type="submit" class="btn btn-primary">Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
    </div>
  @endif
  {{-- Akhir Hapus --}}

  <script>
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $(".btn-success").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
      });

      $("body").on("click", ".btn-danger", function() {
        $(this).parents(".control-group").remove();
      });

    });
  </script>
@endsection
