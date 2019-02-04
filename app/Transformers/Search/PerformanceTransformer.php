<?php

namespace App\Transformers\Search;

use App\Models\Performance;
use League\Fractal\TransformerAbstract;


class PerformanceTransformer extends TransformerAbstract
{

    public function transform(Performance $performance)
    {
        return [
            'id' => $performance->id,
            'type' => 'performances',
            'title' => $performance->translate->title,
            'descr' => str_limit(strip_tags($performance->translate->descriptions,200)),
            'img' => $performance->getFirstMediaUrl('posters', 'preview'),
            'youtubeimg' => null,
            'url' => route('front.events.show', ['id' => $performance->id,'slug' => $performance->translate->slug]),
        ];
    }

}

