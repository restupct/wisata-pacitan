<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
  public function show(Category $category)
  {
    return view('category.show', [
      'title' => $category->kategori,
      'category' => $category->kategori,
      'posts' => $category->post->where('status', 1),
      'categories' => Category::all()
    ]);
  }
}
