@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori</h1>
  </div>
  @if (session()->has('success'))
    <div class="alert alert-success col-lg-6" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-responsive col-lg-6">
    {{-- Tambah Kategori --}}
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalTambahKategori">Tambah
      Kategori
    </button>

    <div class="modal fade" id="modalTambahKategori" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahKategori">Tambah Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/dashboard/admin/categories" method="post">
              @csrf
              <label for="kategori" class="form-label">Nama Kategori</label>
              <input type="text" name="kategori" class="form-control">
              <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- Akhir Tambah Kategori --}}
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kategori</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->kategori }}</td>
            <td>
              {{-- Edit --}}
              <!-- Button trigger modal -->
              <button type="button" class="badge bg-warning border-0" data-bs-toggle="modal"
                data-bs-target="#modalEditKategori{{ $category->slug }}">
                <span data-feather="edit"></span>
              </button>

              <div class="modal fade" id="modalEditKategori{{ $category->slug }}" tabindex="-1"
                aria-labelledby="modalEditKategori" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalEditKategori">Ubah Nama Kategori</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      {{-- Isi --}}
                      <div class="mb-3">
                        <form action="/dashboard/admin/categories/{{ $category->slug }}" method="post">
                          @method('put')
                          @csrf
                          <label for="kategori" class="form-label">Kategori</label>
                          <input type="text" name="kategori" class="form-control"
                            value="{{ old('kategori', $category->kategori) }}">
                          <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                      </div>
                    </div>
                    {{-- Akhir isi --}}
                    </form>
                  </div>
                </div>
              </div>
              {{-- Hapus --}}
              {{-- Trigger --}}
              <button class="badge bg-danger border-0" data-bs-toggle="modal"
                data-bs-target="#modalHapusKategori{{ $category->slug }}">
                <span data-feather="x-circle"></span>
              </button>

              <div class="modal fade" id="modalHapusKategori{{ $category->slug }}" tabindex="-1"
                aria-labelledby="modalHapusKategori" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h5>Yakin ingin hapus kategori : {{ $category->kategori }}?</h5>
                    </div>
                    <div class="modal-footer">
                      <form action="/dashboard/admin/categories/{{ $category->slug }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-primary">Hapus</button>
                      </form>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
              {{-- Akhir Hapus --}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
