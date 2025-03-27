@extends('layouts.main')
@section('content')
  <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Daftar</div>
          <div class="card-body">
            <form action="/register" method="POST">
              @csrf
              <div class="row mb-3">
                <label for="name" class="col-md-4 form-label">Nama</label>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="alamat" class="col-md-4 form-label">Alamat</label>
                <div class="col-md-6">
                  <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                    value="{{ old('alamat') }}">
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="tanggal_lahir" class="col-md-4 form-label">Tanggal Lahir</label>
                <div class="col-md-6">
                  <input type="date" name="tanggal_lahir"
                    class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                  @error('tanggal_lahir')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="jenis_kelamin" class="form-label col-md-4">Jenis Kelamin</label>
                <div class="col-md-6">
                  <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                  <label for="l">Laki-laki</label>
                  <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                  <label for="p">Perempuan</label>
                  @error('jenis_kelamin')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="no_hp" class="col-md-4 form-label">No HP</label>
                <div class="col-md-6">
                  <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp') }}">
                  @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="email" class="col-md-4 form-label ">Email</label>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="password" class="col-md-4 form-label">Password</label>
                <div class="col-md-6">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <small>Sudah punya akun? <a href="/login">Login</a></small>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
