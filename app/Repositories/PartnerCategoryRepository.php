<?php

namespace App\Repositories;
use App\Models\PartnerCategory;
use App\Models\PartnerCategoryTranslation;

class PartnerCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return PartnerCategory::class;
  }

  public function createPartnerCategories($data)
  {
    $partnerCategory = [

    ];
    $partnerCategory = $this->create($partnerCategory);
    $this->addTranslationPartnerCategory($data, $partnerCategory->id);
  }

  public function editPartnerCategory($data, $id)
  {
    $array = [

    ];
    $this->update($array, ['id' => $id]);
    $partnerCategory = PartnerCategory::find($id);
    $this->editTranslationPartnerCategory($data, $partnerCategory);
  }

  public function addTranslationPartnerCategory($data, $partnerCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      PartnerCategoryTranslation::create([
        'partner_category_id' => $partnerCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationPartnerCategory($data, $partnerCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $partnerCategoryTranslation = PartnerCategoryTranslation::where(['partner_category_id' => $partnerCategory->id, 'language' => $lang])->first();
      $partnerCategoryTranslation->update([
        'partner_category_id' => $partnerCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
