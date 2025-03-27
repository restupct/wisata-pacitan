@extends('layouts.main')
@section('content')
  <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>
        @endif

        @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>
        @endif
        <div class="card">

          <div class="card-header">Login</div>
          <div class="card-body">
            <form action="/login" method="POST">
              @csrf
              <div class="row mb-3">
                <label for="email" class="col-md-4 form-label">Email</label>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" autofocus required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="password" class="col-md-4 form-label">Password</label>
                <div class="col-md-6">
                  <input type="password" name="password" class="form-control">
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <small>Belum punya akun? <a href="/register">Daftar Sekarang!</a></small>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
