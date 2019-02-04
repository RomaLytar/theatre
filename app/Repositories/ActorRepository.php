<?php

namespace App\Repositories;

use App\Models\ActorImage;
use App\Models\Actor;
use App\Models\ActorTranslation;
use App\Models\ActorVideo;

class ActorRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Actor';
    }

    public function createActors($data)
    {
        $actor = [
            'dob' => (new \DateTime($data['dob']))->format('Y-m-d H:m:s'),
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'instagram' => $data['instagram'],
            'youtube' => $data['youtube'],
            'group_id' => $data['group_id'],
            'is_main' => $data['is_main'] ?? null,
        ];
        $actor = $this->create($actor);
        $this->addImagesToActor($data['images'], $actor);
        $this->addTranslationActor($data, $actor);
        return $actor;
    }

    public function editActor($data, $actor)
    {
        $array = [
            'dob' => (new \DateTime($data['dob']))->format('Y-m-d H:m:s'),
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'instagram' => $data['instagram'],
            'youtube' => $data['youtube'],
            'group_id' => $data['group_id'],
            'is_main' => $data['is_main'] ?? null,
        ];
        $this->update($array, ['id' => $actor->id]);
        $this->editTranslationActor($data, $actor);
        $this->addImagesToActor($data['images'], $actor);
    }

    public function addTranslationActor($data, $actor)
    {
        foreach (get_languages() as $lang => $val) {
            ActorTranslation::create([
                'actor_id' => $actor->id,
                'language' => $lang,
                'firstName' => $data['firstName_' . $lang],
                'patronymic' => $data['patronymic_' . $lang],
                'degree' => $data['degree_' . $lang],
                'lastName' => $data['lastName_' . $lang],
                'descriptions' => $data['descriptions_' . $lang],
                'debut' => $data['debut_' . $lang],
                'merit' => $data['merit_' . $lang],
                'hometown' => $data['hometown_' . $lang],
                'repertoire' => $data['repertoire_' . $lang],
                'seo_title' => $data['seo_title_' . $lang],
                'seo_description' => $data['seo_description_' . $lang],
                'position' => $data['position_' . $lang],
            ]);
        }
    }

    public function editTranslationActor($data, $actor)
    {
        foreach (get_languages() as $lang => $val) {
            $actorTranslation = ActorTranslation::where(['actor_id' => $actor->id, 'language' => $lang])->first();
            $actorTranslation->update([
                'actor_id' => $actor->id,
                'language' => $lang,
                'firstName' => $data['firstName_' . $lang],
                'patronymic' => $data['patronymic_' . $lang],
                'degree' => $data['degree_' . $lang],
                'lastName' => $data['lastName_' . $lang],
                'descriptions' => $data['descriptions_' . $lang],
                'debut' => $data['debut_' . $lang],
                'merit' => $data['merit_' . $lang],
                'hometown' => $data['hometown_' . $lang],
                'repertoire' => $data['repertoire_' . $lang],
                'seo_title' => $data['seo_title_' . $lang],
                'seo_description' => $data['seo_description_' . $lang],
                'position' => $data['position_' . $lang],
            ]);

        }
    }

    public function addImagesToActor($images, $actor)
    {
        foreach ($images as $image) {
            $actor->images()->attach($image->id);
        }
    }

}
