<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = [];

  // 1 kategori memiliki banyak post
  public function post()
  {
    return $this->hasMany(Post::class);
  }
  public function getRouteKeyName()
  {
    return 'slug';
  }
}
