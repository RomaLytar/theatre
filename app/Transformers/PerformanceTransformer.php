<?php

namespace App\Transformers;

use App\Models\Performance;
use League\Fractal\TransformerAbstract;

class PerformanceTransformer extends TransformerAbstract
{
    public function transform(Performance $performance)
    {
        return [
            'id' => $performance->id,
            'title' => $performance->translate->title,
            'poster' => env('APP_URL') . $performance->getFirstMediaUrl('posters', 'preview'),
        ];
    }
}
