<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardAdminPostController extends Controller
{
  public function verifikasi(Post $post)
  {
    return view('dashboard.admin.posts.verifikasi', ['post' => $post]);
  }

  public function verified(Request $request, Post $post)
  {
    // dd($post->user_id);
    $post = Post::find($post->id);
    $post->status = 1;
    $post->published_at = now()->format('d M Y');
    $post->save();

    $user = User::find($post->user_id);
    $p = Post::where('user_id', $user->id)->where('status', 1)->count();

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

    return redirect('/dashboard/admin/posts')->with('success', 'Post sudah diverifikasi');
  }

  public function notVerified(Request $request, Post $post)
  {
    $post = Post::find($post->id);
    $post->status = 2;
    $post->keterangan = $request->keterangan;
    $post->save();

    return redirect('/dashboard/admin/posts')->with('success', 'Post tidak memenuhi kriteria');
  }

  public function index()
  {
    return view('dashboard.admin.posts.index', [
      'posts' => Post::latest()->get()
    ]);
  }
  public function show(Post $post)
  {
    return view('dashboard.admin.posts.show', ['post' => $post]);
  }


  public function edit(Post $post)
  {
    return view('dashboard.admin.posts.edit', [
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
      'body' => 'required',
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

    Post::where('id', $post->id)
      ->update($validatedData);

    return redirect('/dashboard/admin/posts')->with('success', 'Post sudah diperbarui!');
  }

  public function destroy(Post $post)
  {
    if ($post->gambar) {
      Storage::delete($post->gambar);
    }
    Post::destroy($post->id);

    $user = User::find($post->user_id);
    $p = Post::where('user_id', $user->id)->where('status', 1)->count();

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

    return redirect('/dashboard/admin/posts')->with('success', 'Post sudah dihapus!');
  }
}
