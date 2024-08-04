<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  //
  protected $fillable = [
    'name',
    'email',
    'password',
  ];
}
