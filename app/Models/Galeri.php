<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
  protected $guarded = [];
  protected $table = 'galeris';
  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}
