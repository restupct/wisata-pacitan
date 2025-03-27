<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Galeri;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
  public function simpanKategori(Request $request)
  {
    $validatedData = $request->validate([
      'kategori' => 'required|unique:categories'
    ]);
    $validatedData['slug'] = Str::slug($request->kategori);
    Category::create($validatedData);
    return back()->with('success', 'Kategori baru sudah ditambahkan!');
  }

  public function index()
  {
    return view('dashboard.posts.index', [
      'posts' => Post::latest()->where('user_id', auth()->user()->id)->get()
    ]);
  }

  public function create()
  {
    return view('dashboard.posts.create', [
      'categories' => Category::all()
    ]);
  }
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|unique:posts',
      'gambar' => 'image|file|max:2048',
      'body' => 'required'
    ]);

    $post = new Post();
    $post->title = $request->title;
    $post->slug = Str::slug($request->title);
    $post->category_id = $request->category_id;
    $post->body = $request->body;
    $post->user_id = auth()->user()->id;
    $post->excerpt = Str::limit(strip_tags($request->body), 100, '...');
    $post->lokasi = $request->lokasi;
    if (auth()->user()->role == "admin") {
      $post->status = 1;
      $post->published_at = now()->format('d M Y');
    }
    if ($request->file('gambar')) {
      $post->gambar = $request->file('gambar')->store('post-images');
    }

    $post->save();


    if ($request->galeri) {
      foreach ($request->galeri as $foto) {
        $g['post_id'] = $post->id;
        $g['gambar'] = $foto->store('post-galeries');
        Galeri::create($g);
      }
    }


    return redirect('/dashboard/posts')->with('success', 'Post Anda sudah ditambahkan, silahkan tunggu persetujuan admin sebelum post Anda ditampilkan di website ini.')->with('successAdmin', 'Post sudah ditambahkan.');
  }
  public function show(Post $post)
  {
    return view('dashboard.posts.show', ['post' => $post]);
  }

  public function edit(Post $post)
  {
    return view('dashboard.posts.edit', [
      'post' => $post,
      'categories' => Category::all()
    ]);
  }
  public function update(Request $request, Post $post)
  {
    $rules = [
      'title' => 'required',
      'category_id' => 'required',
      'gambar' => 'image|file|max:4096',
      'body' => 'required'
    ];

    $validatedData = $request->validate($rules);
    if ($request->file('gambar')) {
      if ($request->gambarLama) {
        Storage::delete($request->gambarLama);
      }
      $validatedData['gambar'] = $request->file('gambar')->store('post-images');
    }

    $validatedData['slug'] = Str::slug($request->title);
    $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...');
    $validatedData['lokasi'] = $request->lokasi;
    if ($post->status == 2) {
      $validatedData['status'] = 0;
      $validatedData['keterangan'] = null;
    }
    Post::where('id', $post->id)
      ->update($validatedData);

    if ($request->galeri) {
      foreach ($request->galeri as $foto) {
        $g['post_id'] = $post->id;
        $g['gambar'] = $foto->store('post-galeries');
        Galeri::create($g);
      }
    }

    return redirect('/dashboard/posts')->with('success', 'Postingan Anda sudah diperbarui!')->with('successAdmin', 'Post sudah diperbarui.');;
  }

  public function destroy(Post $post)
  {
    if ($post->gambar) {
      Storage::delete($post->gambar);
    }
    $post->comments()->each(function ($comment) {
      if ($comment) {
        $comment->delete();
      }
    });

    $post->galeris()->each(function ($galeris) {
      if ($galeris->gambar) {
        Storage::delete($galeris->gambar);
      }
      $galeris->delete();
    });

    Post::destroy($post->id);

    $user = User::find($post->user_id);
    $p = Post::where('user_id', $user->id)->where('status', 1)->count();

    // Ubah rating user
    if ($p <= 1) {
      $user = User::find($post->user_id);
      $user->rating = 0;
      $user->save();
    } elseif ($p <= 2) {
      $user = User::find($post->user_id);
      $user->rating = 2;
      $user->save();
      // dd($user);
    } elseif ($p <= 3) {
      $user = User::find($post->user_id);
      $user->rating = 3;
      $user->save();
      // dd($user);
    } elseif ($p <= 4) {
      $user = User::find($post->user_id);
      $user->rating = 4;
      $user->save();
      // dd($user);
    } elseif ($p <= 5) {
      $user = User::find($post->user_id);
      $user->rating = 5;
      $user->save();
      // dd($user);
    }

    return redirect('/dashboard/posts')->with('success', 'Postingan Anda sudah dihapus!')->with('successAdmin', 'Post sudah dihapus.');
  }
}
