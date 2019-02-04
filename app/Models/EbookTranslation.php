<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbookTranslation extends Model
{
  protected $fillable = ['ebook_id', 'language', 'title','file'];
}
