<?php

namespace App\Models;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $guarded = [];
  protected $with = ['category', 'user'];

  public function scopeFilter($query)
  {
    if (request('search')) {
      return $query->where('title', 'like', '%' . request('search') . '%')
        ->orWhere('body', 'like', '%' . request('search') . '%');
    }
  }
  public function scopeStatus($query)
  {
    return $query->where('status', 1);
  }
  // 1 post memiliki 1 kategori
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
  // 1 post dimiliki 1 user
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  // 1 post memiliki banyak komentar
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
  public function galeris()
  {
    return $this->hasMany(Galeri::class);
  }
  public function getRouteKeyName()
  {
    return 'slug';
  }
}
