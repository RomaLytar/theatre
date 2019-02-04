<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends MultiLanguageModel
{
  protected $multiLanguageForeignKey = 'video_category_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return VideoCategoryTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

}
