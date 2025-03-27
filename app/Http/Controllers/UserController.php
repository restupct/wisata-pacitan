<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function index()
  {
    return view('dashboard.profile');
  }

  public function update(Request $request, User $user)
  {
    if ($request->file('foto')) {
      if ($request->fotoLama) {
        Storage::delete($request->fotoLama);
      }
      $validatedData = $request->validate(['foto' => 'image|file|max:4096']);
      $validatedData['foto'] = $request->file('foto')->store('profile-images');
      User::where('id', auth()->user()->id)
        ->update($validatedData);

      return back()->with('success', 'Foto profil anda sudah diperbarui.');
    } elseif ($request->hapusFoto == "true") {
      Storage::delete($request->fotoLama);
      $user = User::find(auth()->user()->id);
      $user->foto = null;
      $user->save();
      return back()->with('success', 'Foto profil anda sudah dihapus.');
    } elseif ($request->ubah_data_diri == "true") {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'alamat' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'no_hp' => 'required|numeric',
      ]);
      User::where('id', $user->id)
        ->update($validatedData);
      return back()->with('success', 'Update data diri berhasil.');
    } elseif ($request->ubah_akun == "true") {
      $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5'
      ]);
      $validatedData['password'] = bcrypt($validatedData['password']);
      User::where('id', auth()->user()->id)
        ->update($validatedData);
      return back()->with('success', 'Update data akun berhasil.');
    }
  }
}
