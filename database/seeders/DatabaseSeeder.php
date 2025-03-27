<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    User::create([
      'name' => 'Muhammad Restu',
      'alamat' => 'RT 01/04 Krajan Kidul, Sekar, Donorojo',
      'tanggal_lahir' => '13/02/2001',
      'email' => 'restu@gmail.com',
      'password' => bcrypt('12345678'),
      'jenis_kelamin' => 'L',
      'role' => 'admin',
      'no_hp' => '082230404281',
      'rating' => 5
    ]);
    Category::create([
      'kategori' => 'Pantai',
      'slug' => 'pantai'
    ]);
    Category::create([
      'kategori' => 'Goa',
      'slug' => 'goa'
    ]);
    Category::create([
      'kategori' => 'Sungai',
      'slug' => 'sungai'
    ]);

  }
}
