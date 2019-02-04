<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Program;
use App\Models\ProgramTranslation;



class ProgramRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Program';
  }

  public function createProgram($data)
  {
    $program = [
    ];
    $program = $this->create($program);
    $this->addTranslationProgram($data, $program->id);
    return $program;
  }

  public function editProgram($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $program = Program::find($id);
    $this->editTranslationProgram($data, $program);
  }

  public function addTranslationProgram($data, $programId)
  {
    foreach (get_languages() as $lang => $val) {
      ProgramTranslation::create([
        'program_id' => $programId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'terms_description' => $data['terms_description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationProgram($data, $program)
  {
    foreach (get_languages() as $lang => $val) {
      $ProgramTranslation = ProgramTranslation::where(['program_id' => $program->id, 'language' => $lang])->first();
      $ProgramTranslation->update([
        'program_id' => $program->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'terms_description' => $data['terms_description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
