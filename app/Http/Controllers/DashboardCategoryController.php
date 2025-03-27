<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardCategoryController extends Controller
{
  public function index()
  {
    return view('dashboard.admin.category.index', [
      'categories' => Category::all()
    ]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'kategori' => 'required|unique:categories'
    ]);
    $validatedData['slug'] = Str::slug($request->kategori);
    Category::create($validatedData);
    return redirect('/dashboard/admin/categories')->with('success', 'Kategori baru sudah ditambahkan!');
  }

  public function update(Request $request, Category $category)
  {
    $validatedData = $request->validate([
      'kategori' => 'required'
    ]);
    $validatedData['slug'] = Str::slug($request->kategori);
    Category::where('id', $category->id)
      ->update($validatedData);
    return redirect('/dashboard/admin/categories')->with('success', 'Kategori sudah diperbarui!');
  }

  public function destroy(Category $category)
  {
    if ($category->post->count() == 0) {
      Category::destroy($category->id);

      return redirect('/dashboard/admin/categories')->with('success', 'Kategori sudah dihapus!');
    }
    return back()->with('success', 'Kategori ini memiliki post, Anda tidak bisa menghapusnya.');
  }
}
