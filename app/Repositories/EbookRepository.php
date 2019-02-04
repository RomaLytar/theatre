<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Ebook;
use App\Models\EbookTranslation;



class EbookRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Ebook';
  }

  public function createEbooks($data)
  {
    $ebook = [
    ];
    $ebook = $this->create($ebook);
    $this->addTranslationEbook($data, $ebook->id);
    return $ebook;
  }

  public function editEbooks($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $Ebooks = Ebook::find($id);
    $this->editTranslationEbook($data, $Ebooks);
  }

  public function addTranslationEbook($data, $ebookId)
  {
    foreach (get_languages() as $lang => $val) {
      EbookTranslation::create([
        'ebook_id' => $ebookId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'file' => $data['file_' . $lang] ?? null,
      ]);
    }
  }

  public function editTranslationEbook($data, $ebook)
  {
    foreach (get_languages() as $lang => $val) {
      $EbookTranslation = EbookTranslation::where(['ebook_id' => $ebook->id, 'language' => $lang])->first();
      $EbookTranslation->update([
        'ebook_id' => $ebook->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'file' => $data['file_' . $lang] == null ? $ebook->translate($lang)->first()->file : $data['file_' . $lang],
      ]);
    }
  }
}
