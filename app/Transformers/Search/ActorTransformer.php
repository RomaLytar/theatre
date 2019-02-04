<?php

namespace App\Transformers\Search;

use App\Models\Actor;
use League\Fractal\TransformerAbstract;



class ActorTransformer extends TransformerAbstract
{
    public function transform(Actor $actor)
    {
        return [
            'id' => $actor->id,
            'type' => 'actors',
            'title' => $actor->fullname(),
            'descr' => str_limit(strip_tags($actor->translate->descriptions, 300)),
            'img' => $actor->getFirstMediaUrl('posters', 'preview'),
            'youtubeimg' => null,
            'url' => route('front.actors.show', ['id' => $actor->id,'slug' => $actor->translate->slug]),
        ];
    }
}