<?php

namespace App\Transformers;

use App\Models\Hall;
use League\Fractal\TransformerAbstract;

class HallTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['sections'];

    public function transform(Hall $hall) {
        return [
            'id' => $hall->id,
            'title' => $hall->translate->title,
            'name' => $hall->name,
            'patternPath' => $hall->patternPath,
        ];
    }

    public function includeSections(Hall $hall) {
        return $this->collection($hall->sections, new SectionTransformer);
    }
}