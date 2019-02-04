<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends MultiLanguageModel
{
    protected $fillable = ['number'];

    protected $multiLanguageForeignKey = 'section_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return SectionTranslation::class;
    }

    public function multiLanguageFields()
    {
        return ['title'];
    }

    public function hall() {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function rows() {
        return $this->hasMany(Row::class, 'section_id');
    }
}
