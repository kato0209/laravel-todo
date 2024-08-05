<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
  //
  protected $fillable = [
    'user_id',
    'content',
  ];
}
