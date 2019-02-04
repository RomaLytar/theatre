<?php
/**
 * Created by PhpStorm.
 * User: Alteran
 * Date: 15.08.2018
 * Time: 10:51
 */


namespace App\Repositories;
use App\Models\Faq;
use App\Models\FaqTranslation;


class FaqRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Faq';
  }

  public function createFaq($data)
  {
    $faq = [
      'category_id' => $data['category_id'],
    ];
    $faq = $this->create($faq);
    $this->addTranslationFaq($data, $faq->id);
  }

  public function editFaq($data, $id)
  {
    $array = [
      'category_id' => $data['category_id'],
    ];
    $this->update($array, ['id' => $id]);
    $faqCategory = Faq::find($id);
    $this->editTranslationFaq($data, $faqCategory);
  }

  public function addTranslationFaq($data, $faqId)
  {
    foreach (get_languages() as $lang => $val) {
      FaqTranslation::create([
        'faq_id' => $faqId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationFaq($data, $faq)
  {
    foreach (get_languages() as $lang => $val) {
      $faqTranslation = FaqTranslation::where(['faq_id' => $faq->id, 'language' => $lang])->first();
      $faqTranslation->update([
        'faq_id' => $faq->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
