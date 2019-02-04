<?php
/**
 * Created by PhpStorm.
 * User: Alteran
 * Date: 15.08.2018
 * Time: 10:51
 */


namespace App\Repositories;
use App\Models\Documentation;
use App\Models\DocumentationTranslation;


class DocumentationRepository extends Repository
{
  /**
   * Specify Model class name
   *$documentation
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Documentation';
  }

  public function createDocumentation($data)
  {
    $documentation = [
      'category_id' => $data['category_id'],
      'file' => $data['file']
    ];
    $documentation = $this->create($documentation);
    $this->addTranslationDocumentation($data, $documentation->id);
  }

  public function editDocumentation($data, $id)
  {
    $array = [
      'category_id' => $data['category_id'],
    ];
    $this->update($array, ['id' => $id]);
    $documentationCategory = Documentation::find($id);
    $this->editTranslationDocumentation($data, $documentationCategory);
  }

  public function addTranslationDocumentation($data, $documentationId)
  {
    foreach (get_languages() as $lang => $val) {
      DocumentationTranslation::create([
        'doc_id' => $documentationId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationDocumentation($data, $documentation)
  {
    foreach (get_languages() as $lang => $val) {
      $documentationTranslation = DocumentationTranslation::where(['doc_id' => $documentation->id, 'language' => $lang])->first();
      $documentationTranslation->update([
        'doc_id' => $documentation->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
