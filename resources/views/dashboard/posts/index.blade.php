@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Post Saya</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      @if (auth()->user()->role != 'admin')
        {{ session('success') }}
      @else
        {{ session('successAdmin') }}
      @endif
    </div>
  @endif
  <div class="table-responsive col-lg-8">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Tambah Post</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">Kategori</th>
          @if (auth()->user()->role != 'admin')
            <th scope="col">Status</th>
            <th scope="col">Keterangan</th>
          @endif
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->kategori }}</td>
            @if (auth()->user()->role != 'admin')
              <td>
                @if ($post->status == 2)
                  <div class="badge bg-danger">Ditolak</div>
                @elseif($post->status == 1)
                  <div class="badge bg-success">Terverifikasi</div>
                @else
                  <div class="badge bg-secondary">Dalam proses</div>
                @endif
              </td>
              <td>
                @if ($post->keterangan)
                  {{ $post->keterangan }}
                @else
                  -
                @endif
              </td>
            @endif

            <td>
              {{-- Lihat --}}
              <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
              {{-- Edit --}}
              <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                  data-feather="edit"></span></a>
              {{-- Hapus --}}
              <button class="badge bg-danger border-0" type="button" data-bs-toggle="modal"
                data-bs-target="#modalHapusPost{{ $post->slug }}">
                <span data-feather="x-circle"></span></button>
              <div class="modal fade" id="modalHapusPost{{ $post->slug }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Hapus Post</h5>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin hapus post : <strong>{{ $post->title }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <form action="/dashboard/posts/{{ $post->slug }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Yakin</button>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
