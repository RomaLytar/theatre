<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends MultiLanguageModel
{
    protected $fillable = ['slug'];
    protected $multiLanguageForeignKey = 'setting_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return SettingTranslation::class;
    }

    public function multiLanguageFields()
    {
        return ['title'];
    }
}
