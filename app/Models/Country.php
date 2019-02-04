<?php

namespace App\Models;

class Country extends MultiLanguageModel
{
    protected $fillable = ['code'];

    public $timestamps = false;

    protected $multiLanguageForeignKey = 'country_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return CountryTranslation::class;
    }

    public function multiLanguageFields()
    {
        return ['title'];
    }
}
