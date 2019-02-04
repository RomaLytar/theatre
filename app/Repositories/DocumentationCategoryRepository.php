<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\DocumentationCategory;
use App\Models\DocumentationCategoryTranslation;



class DocumentationCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\DocumentationCategory';
  }

  public function createDocumentationCategories($data)
  {
    $documentationCategory = [
    ];
    $documentationCategory = $this->create($documentationCategory);
    $this->addTranslationDocumentationCategory($data, $documentationCategory->id);
  }

  public function editDocumentationCategory($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $DocumentationCategory = DocumentationCategory::find($id);
    $this->editTranslationDocumentationCategory($data, $DocumentationCategory);
  }

  public function addTranslationDocumentationCategory($data, $DocumentationCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      DocumentationCategoryTranslation::create([
        'doc_category_id' => $DocumentationCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationDocumentationCategory($data, $documentationCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $DocumentationCategoryTranslation = DocumentationCategoryTranslation::where(['doc_category_id' => $documentationCategory->id, 'language' => $lang])->first();
      $DocumentationCategoryTranslation->update([
        'doc_category_id' => $documentationCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
