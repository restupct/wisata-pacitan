<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $guarded = [];

  // 1 komen dimiliki 1 post
  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}
