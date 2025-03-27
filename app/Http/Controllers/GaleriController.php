<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
  public function destroy(Request $request, Galeri $galeri)
  {
    Storage::delete($request->gambar);
    Galeri::destroy($galeri->id);

    return back()->with('success', 'Gambar galeri sudah dihapus');
  }
}
