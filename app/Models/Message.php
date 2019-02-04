<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = ['read', 'name', 'title','phone','email', 'description','answer'];
}
