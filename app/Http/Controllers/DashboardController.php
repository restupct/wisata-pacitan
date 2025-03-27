<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard.index', [
      'categories' => Category::all(),
      'seluruh_post' => Post::count('*'),
      'jumlah_post_ditolak' => Post::where('status', 2)->count('*'),
      'jumlah_post_sudah_verifikasi' => Post::where('status', 1)->count('*'),
      'jumlah_post_belum_verifikasi' => Post::where('status', 0)->count('*'),
      'jumlah_post_berdasar_user' => Post::where(function ($query) {
        $query->select('id')
          ->from('users')
          ->whereColumn('users.id', 'posts.user_id');
      }, auth()->user()->id)->count(),
      'jumlah_post_berdasar_user_1' => Post::where('status', 1)->where(function ($query) {
        $query->select('id')
          ->from('users')
          ->whereColumn('users.id', 'posts.user_id');
      }, auth()->user()->id)->count(),
      'jumlah_post_berdasar_user_2' => Post::where('status', 2)->where(function ($query) {
        $query->select('id')
          ->from('users')
          ->whereColumn('users.id', 'posts.user_id');
      }, auth()->user()->id)->count(),
      'jumlah_post_berdasar_user_0' => Post::where('status', 0)->where(function ($query) {
        $query->select('id')
          ->from('users')
          ->whereColumn('users.id', 'posts.user_id');
      }, auth()->user()->id)->count(),
    ]);
  }
}
