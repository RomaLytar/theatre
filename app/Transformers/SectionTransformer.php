<?php

namespace App\Transformers;

use App\Models\Section;
use League\Fractal\TransformerAbstract;

class SectionTransformer extends TransformerAbstract
{
//    protected $availableIncludes = ['rows'];
    protected $defaultIncludes = ['rows'];

    public function transform(Section $section) {
        return [
            'id' => $section->id,
            'number' => $section->number,
            'title' => $section->translate->title,
        ];
    }

    public function includeRows(Section $section) {
        return $this->collection($section->rows, new RowTransformer);
    }
}