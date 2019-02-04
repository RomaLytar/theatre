<?php

namespace App\Repositories;
use App\Models\ActorRole;
use App\Models\ActorRoleTranslation;


class ActorRoleRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\ActorRole';
  }

  public function createActorRole($data)
  {
    $actorRole = [

    ];
    $actorRole = $this->create($actorRole);
    $this->addTranslationActorRole($data, $actorRole->id);
  }

  public function editActorRole($data, $id)
  {
    $array = [];
    $this->update($array, ['id' => $id]);
    $actorRole = ActorRole::find($id);
    $this->editTranslationActorRole($data, $actorRole);
  }

  public function addTranslationActorRole($data, $actorRoleId)
  {
    foreach (get_languages() as $lang => $val) {
      ActorRoleTranslation::create([
        'actor_role_id' => $actorRoleId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationActorRole($data, $actorRole)
  {
    foreach (get_languages() as $lang => $val) {
      $actorRoleTranslation = ActorRoleTranslation::where(['actor_role_id' => $actorRole->id, 'language' => $lang])->first();
      $actorRoleTranslation->update([
        'actor_role_id' => $actorRole->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
