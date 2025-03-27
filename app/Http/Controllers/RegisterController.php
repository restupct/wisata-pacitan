<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('register.index', ['title' => 'Daftar', 'categories' => Category::all()]);
  }
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'name' => 'required|min:5|max:255',
      'alamat' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
      'no_hp' => 'required|numeric',
      'foto' => 'file|image|max:4096',
      'email' => 'required|unique:users|email',
      'password' => 'required|min:8|max:255'
    ]);
    $validateData['password'] = Hash::make($validateData['password']);
    User::create($validateData);

    return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login.');
  }
}
