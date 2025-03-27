<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index()
  {
    /* $post = Post::where('status', 1);
    $post->whereHas('comments', function ($query) {
      $query->where('rating', '>', Comment::avg('rating'));
    });*/

    /* DB::table('Customer')
   ->selectRaw('Customer.Ip_Id','Customer.Customer_Id', 'AVG(Customer_Usage) as Avg_Usage',  'AVG(Amount) as Avg_Amount')
   ->join('Customer_Usage', 'Customer_Usage.customer_id', '=', 'Customer.customer_id')
   ->where('Ip_Id', 100)                
   ->groupBy("Customer_Id")
   ->get();*/

    $post = DB::table('posts')->selectRaw('avg(rating) as nilai,posts.*')
      ->join('comments', 'comments.post_id', '=', 'posts.id')
      ->groupBy("post_id")
      ->orderBy('nilai', 'desc');

    return view('home', [
      'title' => 'Home',
      'categories' => Category::all(),
      'posts' => $post->limit(5)->get()
    ]);
  }
}
