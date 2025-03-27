<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    return view('post.index', [
      'title' => 'Semua Post',
      'posts' => Post::latest()->filter()->status()->get(),
      'categories' => Category::all()
    ]);
  }
  public function show(Post $post)
  {
    return view('post.show', [
      'title' => $post->title,
      'posts' => Post::where('status', 1)->latest()->limit(5)->get(),
      'post' => $post,
      'categories' => Category::all()
    ]);
  }

  public function simpanKomentar(Request $request)
  {
    $validatedData = $request->validate([
      'post_id' => '',
      'rating' => '',
      'email' => '',
      'komentar' => ''
    ]);
    Comment::create($validatedData);
    return redirect()->back();
  }
}
