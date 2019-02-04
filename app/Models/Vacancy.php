<?php

namespace App\Models;

class Vacancy extends multiLanguageModel
{
  protected $fillable = ['is_active'];
  protected $multiLanguageForeignKey = 'vacancy_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return VacancyTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title', 'description', 'add_description'];
  }
  public function shortDescription($сharacterNumber) {
    return str_limit($this->translate->description, $сharacterNumber);
  }
}
