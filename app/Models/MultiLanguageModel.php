<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

abstract class MultiLanguageModel extends Model
{
    protected $multiLanguageForeignKey = null;
    protected $multiLanguageLocalKey = null;

    abstract public function multiLanguageModel();
    abstract public function multiLanguageFields();

    public function translate($language = null)
    {
        if (!$language) {
            $language = App::getLocale();
        }
        return $this->hasOne(
          $this->multiLanguageModel(),
          $this->multiLanguageForeignKey,
          $this->multiLanguageLocalKey
        )->where('language', $language);
    }
}
