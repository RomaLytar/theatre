<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueTranslation extends Model
{
  protected $fillable = ['attribute_value_id', 'language', 'title', 'descriptions'];
}
