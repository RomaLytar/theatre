<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\FaqCategory;
use App\Models\FaqCategoryTranslation;



class FaqCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\FaqCategory';
  }

  public function createFaqCategories($data)
  {
    $faqCategory = [
    ];
    $faqCategory = $this->create($faqCategory);
    $this->addTranslationFaqCategory($data, $faqCategory->id);
  }

  public function editFaqCategory($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $FaqCategory = FaqCategory::find($id);
    $this->editTranslationFaqCategory($data, $FaqCategory);
  }

  public function addTranslationFaqCategory($data, $FaqCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      FaqCategoryTranslation::create([
        'faq_category_id' => $FaqCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationFaqCategory($data, $faqCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $FaqCategoryTranslation = FaqCategoryTranslation::where(['faq_category_id' => $faqCategory->id, 'language' => $lang])->first();
      $FaqCategoryTranslation->update([
        'faq_category_id' => $faqCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
