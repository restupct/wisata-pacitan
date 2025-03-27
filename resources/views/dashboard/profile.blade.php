@extends('dashboard.layouts.main')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>{{ auth()->user()->role }}</h1>
  </div>
  @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
  @endif
  {{-- Modal Hapus Foto --}}
  <div class="modal fade" id="hapus_foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Foto Profil</h5>
        </div>
        <div class="modal-body">
          <form action="/dashboard/users/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="hapusFoto" value="true">
            <input type="hidden" name="fotoLama" value="{{ auth()->user()->foto }}">
            <p>Anda yakin ingin <strong>menghapus</strong> foto?</p>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Yakin</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Akhir Modal Hapus Foto --}}
  {{-- Modal Update Foto --}}
  <div class="modal fade" id="ubah_foto_profil">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Foto Profil</h5>
        </div>
        <div class="modal-body">
          <form action="/dashboard/users/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="ubah_foto_profil" value="true">
            {{-- Foto Lama --}}
            <input type="hidden" name="fotoLama" value="{{ auth()->user()->foto }}">

            <div>
              <label for="formFile" class="form-label">Foto</label>
              <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
              @error('foto')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" data-bs-target="#confirm_update_foto"
                data-bs-toggle="modal">Simpan</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal confirm update foto --}}
  <div class="modal fade" id="confirm_update_foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Foto</h5>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin <strong>memperbarui</strong> data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-target="#ubah_foto_profil"
            data-bs-toggle="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Yakin</button>
        </div>
      </div>
    </div>
  </div>
  </form>

  {{-- Akhir Modal Update Foto Profil --}}


  {{-- Modal Update Data Diri --}}
  <div class="modal fade" id="ubah_data_diri">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Data Diri</h5>
        </div>
        <div class="modal-body">
          <form action="/dashboard/users/{{ auth()->user()->id }}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="ubah_data_diri" value="true">

            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ auth()->user()->name }}">
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                value="{{ auth()->user()->alamat }}">
              @error('alamat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                value="{{ auth()->user()->tanggal_lahir }}">
            </div>
            <div class="mb-3">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-select">
                @if (auth()->user()->jenis_kelamin == 'L')
                  <option selected value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                @else
                  <option value="L">Laki-Laki</option>
                  <option selected value="P">Perempuan</option>
                @endif
              </select>
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">No HP</label>
              <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ auth()->user()->no_hp }}">
              @error('no_hp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" data-bs-target="#confirm_update_data_diri"
                data-bs-toggle="modal">Simpan</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal confirm update data diri --}}
  <div class="modal fade" id="confirm_update_data_diri">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Data Diri</h5>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin <strong>memperbarui</strong> data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-target="#ubah_data_diri"
            data-bs-toggle="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Yakin</button>
        </div>
      </div>
    </div>
  </div>
  </form>


  {{-- Modal Update Akun --}}
  <div class="modal fade" id="ubah_akun">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Akun</h5>
        </div>
        <div class="modal-body">
          <form action="/dashboard/users/{{ auth()->user()->id }}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="ubah_akun" value="true">

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ auth()->user()->email }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" data-bs-target="#confirm_update_akun"
                data-bs-toggle="modal">Simpan</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal confirm update akun --}}
  <div class="modal fade" id="confirm_update_akun">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Akun</h5>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin <strong>memperbarui</strong> data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-target="#ubah_akun"
            data-bs-toggle="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Yakin</button>
        </div>
      </div>
    </div>
  </div>
  </form>

  {{-- Akhir Modal Update Akun --}}



  <div class="row">
    <div class="col-md-4 text-center justify-content-center">
      <div class="card-body">
        @if (auth()->user()->foto)
          <img src="{{ asset('storage') }}/{{ auth()->user()->foto }}" class="img img-fluid imgprofil mb-3">
        @else
          <img src="{{ asset('storage') }}/profile-images/user.png" class="img img-fluid imgprofil mb-3">
        @endif
        <button type="button" class="badge bg-primary border-0" data-bs-toggle="modal" id="btnklikfoto"
          data-bs-target="#ubah_foto_profil"><span data-feather="edit"></span></button>
        <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal"
          data-bs-target="#hapus_foto"><span data-feather="x-circle"></span></button>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <table>
            <tr>
              <td>
                <h5>{{ auth()->user()->name }}</h5>
              </td>
            </tr>
            <tr>
              <td>
                @for ($i = 0; $i < auth()->user()->rating; $i++)
                  <span class="fa fa-star checked"></span>
                @endfor
              </td>
            </tr>
            <tr>
              <td>Alamat : {{ auth()->user()->alamat }}</td>
            </tr>
            <tr>
              <td>Tanggal Lahir : {{ auth()->user()->tanggal_lahir }}</td>
            </tr>
            <tr>
              <td>
                @if (auth()->user()->jenis_kelamin == 'L')
                  Jenis Kelamin : Laki-laki
                @else
                  Jenis Kelamin : Perempuan
                @endif
              </td>
            </tr>
            <tr>
              <td>No HP : {{ auth()->user()->no_hp }}</td>
            </tr>
            <tr>
              <td><button type="button" class="badge bg-primary border-0" id="btnklik" data-bs-toggle="modal"
                  data-bs-target="#ubah_data_diri"><span data-feather="edit"></span></button></td>
            </tr>

          </table>
          <hr>
          <table>
            <h5>Akun</h5>
            <tr>
              <td>{{ auth()->user()->email }}</td>
            </tr>
            <tr>
              <td>********</td>
            </tr>
          </table>
          <button type="button" class="badge bg-primary border-0" data-bs-toggle="modal" data-bs-target="#ubah_akun"
            id="btnklikakun"><span data-feather="edit"></span></button>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  <!-- Ubah FotoProfil -->
  @error('foto')
    <script type="text/javascript">
      var klik = document.getElementById('btnklikfoto');
      klik.click()
    </script>
  @enderror
  <!-- Ubah Data -->
  @error('name')
    <script type="text/javascript">
      var klik = document.getElementById('btnklik');
      klik.click()
    </script>
  @enderror
  @error('alamat')
    <script type="text/javascript">
      var klik = document.getElementById('btnklik');
      klik.click()
    </script>
  @enderror
  @error('no_hp')
    <script type="text/javascript">
      var klik = document.getElementById('btnklik');
      klik.click()
    </script>
  @enderror

  {{-- Ubah Akun --}}
  @error('email')
    <script type="text/javascript">
      var klik = document.getElementById('btnklikakun');
      klik.click()
    </script>
  @enderror
  @error('password')
    <script type="text/javascript">
      var klik = document.getElementById('btnklikakun');
      klik.click()
    </script>
  @enderror
@endsection
