@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Post Baru</h1>
  </div>

  {{-- Form --}}
  <div class="col-lg-8">
    <form action="/dashboard/posts" method="post" class="mb-5" enctype="multipart/form-data">
      @csrf
      {{-- Judul --}}
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      {{-- Kategori --}}
      <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select name="category_id" class="form-select mb-2">
          @foreach ($categories as $category)
            @if (old('category_id') == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->kategori }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->kategori }}</option>
            @endif
          @endforeach
        </select>
        {{-- Tambah Kategori --}}
        <button type="button" class="btn btn-primary " data-bs-toggle="modal"
          data-bs-target="#modalTambahKategori">Tambah Kategori
        </button>


        {{-- Akhir Tambah Kategori --}}
      </div>

      {{-- Uplodad img --}}
      <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Post</label>
        <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar"
          multiple>
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
        <input type="hidden" name="body" id="body" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
      </div>
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
      {{-- Akhir Galeri --}}
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
          value="{{ old('lokasi') }}">
        @error('lokasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Buat Post</button>
    </form>
  </div>
  {{-- Modal --}}
  <div class="modal fade" id="modalTambahKategori" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahKategori">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/dashboard/posts/category" method="post">
            @csrf
            <label for="kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="kategori" class="form-control">
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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
