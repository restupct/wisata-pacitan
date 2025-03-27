@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User</h1>
  </div>
  <div class="table-responsive col-lg-9">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Alamat</th>
          <th scope="col">Rating</th>
          <th scope="col">Jumlah Post</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->alamat }}</td>
            <td>
              @for ($i = 0; $i < $user->rating; $i++)
                <span class="fa fa-star checked"></span>
              @endfor
            </td>
            <td>{{ $user->posts->count() }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
