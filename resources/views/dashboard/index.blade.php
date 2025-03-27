@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
  </div>

  @can('admin')
    <div class="row">
      <p>Admin</p>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Semua Post</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $seluruh_post }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Post sudah diverifikasi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_sudah_verifikasi }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Post belum diverifikasi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_belum_verifikasi }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Post ditolak</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_ditolak }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endcan



  <div class="row">
    <p>User</p>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Semua Post</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_berdasar_user }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Post Terverifikasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_berdasar_user_1 }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Post Belum Diverifikasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_berdasar_user_0 }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Post ditolak</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_post_berdasar_user_2 }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
