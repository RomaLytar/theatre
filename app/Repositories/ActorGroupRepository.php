<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/28/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\ActorGroup;
use App\Models\ActorGroupTranslation;


class ActorGroupRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\ActorGroup';
  }

  public function createActorGroups($data)
  {
    $actor_group = [
      'parent_id' => $data['parent_id'],
      'is_active' => $data['is_active'] ?? null,
    ];
    $actor_group = $this->create($actor_group);
    $this->addTranslationActorGroup($data, $actor_group->id);
  }

  public function editActorGroup($data, $id)
  {
    $array = [
      'parent_id' => $data['parent_id'],
      'is_active' => $data['is_active'] ?? null,
    ];
    $this->update($array, ['id' => $id]);
    $actor_group = ActorGroup::find($id);
    $this->editTranslationActorGroup($data, $actor_group);
  }

  public function addTranslationActorGroup($data, $actorGroupId)
  {
    foreach (get_languages() as $lang => $val) {
      ActorGroupTranslation::create([
        'actor_group_id' => $actorGroupId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationActorGroup($data, $actorGroup)
  {
    foreach (get_languages() as $lang => $val) {
      $actorGroupTranslation = ActorGroupTranslation::where(['actor_group_id' => $actorGroup->id, 'language' => $lang])->first();
      $actorGroupTranslation->update([
        'actor_group_id' => $actorGroup->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
