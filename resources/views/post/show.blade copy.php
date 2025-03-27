{{-- @dd($post->galeris) --}}
@extends('layouts.main')
@section('content')
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-lg-8">
        <article>
          <header class="mb-4">
            {{-- Judul --}}
            <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
            {{-- Penulis --}}
            <div class="text-muted fst-italic mb-2">Dipublish tanggal {{ $post->published_at }}, oleh
              {{ $post->user->name }}
            </div>
            {{-- Kategori --}}
            <a href="/categories/{{ $post->category->slug }}"
              class="badge bg-secondary text-decoration-none link-light">{{ $post->category->kategori }}</a>
          </header>
          {{-- Gambar --}}
          @if ($post->gambar)
            <img src="{{ asset('storage/' . $post->gambar) }}" class="img-preview img-fluid">
          @endif
          <p>{!! $post->body !!}</p>

          {{-- Galeri --}}
          @if ($post->galeris()->count())
            <h2>Galeri</h2>
            <div class="row">
              @foreach ($post->galeris as $galeri)
                <div class="col-12 col-md-6">
                  <img src="{{ asset('storage/' . $galeri->gambar) }}" />
                </div>
              @endforeach
            </div>
          @endif
          {{-- Akhir Galeri --}}
          @if ($post->lokasi)
            <h1>Lokasi</h1>
            {!! $post->lokasi !!}
          @endif

        </article>
        <hr>
        {{-- Komentar --}}

        <div class="card bg-light">
          <div class="card-body">
            <form action="/comments" method="post">
              @csrf
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              {{-- @if (auth()->user())
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                    readonly>
                @else
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              @endif --}}
              <div class="mb-3">
                <label for="email">Email</label>
                @if (auth()->user())
                  <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                    readonly>
                @else
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                @endif
              </div>
              <div class="mb-3">
                <input class="star star-5" value="5" id="star-5" type="radio" name="rating" />
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" value="4" id="star-4" type="radio" name="rating" />
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" value="3" id="star-3" type="radio" name="rating" />
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" value="2" id="star-2" type="radio" name="rating" />
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" value="1" id="star-1" type="radio" name="rating" />
                <label class="star star-1" for="star-1"></label>
              </div>
              <div class="mb-3">
                <label for="komentar">Komentar</label>
                <textarea name="komentar" class="form-control"></textarea>
                <button type="submit" class="btn btn-primary mt-2">Komentar</button>
              </div>
            </form>

            <ul class="list-unstyled activity-list">
              @foreach ($post->comments as $comment)
                <li>
                  <img src="/gambar/user.png" alt="Avatar" class="img-circle pull-left avatar">
                  <p>{{ $comment->email }}</p>
                  <p>
                    @if ($comment->rating)
                      @for ($i = 0; $i < $comment->rating; $i++)
                        <span class="fa fa-star checked"></span>
                      @endfor
                    @endif
                  </p>
                  <p>{{ $comment->komentar }}</p>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>


      {{-- Side Widget --}}
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-header">Cari</div>
          <div class="card-body">
            <div class="input-group">
              <form action="/posts" class="d-flex">
                <input type="text" name="search" class="form-control " placeholder="Cari.."
                  value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
              </form>
            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header">Kategori</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <ul class="mb-0">
                  @foreach ($categories as $category)
                    <li><a href="/categories/{{ $category->slug }}"
                        class="text-decoration-none">{{ $category->kategori }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header">Post terbaru</div>
          <div class="card-body">
            <div class="row">
              <div>
                <ul>
                  @foreach ($posts as $p)
                    <li><a href="/posts/{{ $p->slug }}" class="text-decoration-none">{{ $p->title }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
