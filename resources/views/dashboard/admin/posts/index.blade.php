@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Post</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
  @elseif (session()->has('danger'))
    <div class="alert alert-danger col-lg-8" role="alert">
      {{ session('danger') }}
    </div>
  @endif
  <div class="table-responsive col-md-8">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">Kategori</th>
          <th scope="col">Penulis</th>
          <th scope="col">Status</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->kategori }}</td>
            <td>{{ $post->user->name }}</td>
            {{-- Status --}}
            <td>
              @if ($post->status == 2)
                <div class="badge bg-danger">Ditolak</div>
              @elseif($post->status == 1)
                <div class="badge bg-success text-decoration-none link-light">Terverifikasi</div>
              @else
                <a href="/dashboard/admin/posts/verifikasi/{{ $post->slug }}"
                  class="badge bg-primary text-decoration-none link-light">Verifikasi</a>
              @endif
            </td>
            <td>
              @if ($post->keterangan)
                {{ $post->keterangan }}
              @else
                -
              @endif
            </td>
            <td>
              <a href="/dashboard/admin/posts/{{ $post->slug }}" class="badge bg-info"><span
                  data-feather="eye"></span></a>
              {{-- Edit --}}
              <a href="/dashboard/admin/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                  data-feather="edit"></span></a>
              {{-- Hapus --}}
              <button class="badge bg-danger border-0" type="button" data-bs-toggle="modal"
                data-bs-target="#modalHapusPost{{ $post->slug }}"><span data-feather="x-circle"></span></button>
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
                      <form action="/dashboard/admin/posts/{{ $post->slug }}" method="POST">
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
