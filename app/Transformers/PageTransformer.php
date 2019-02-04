<?php

namespace App\Transformers;

use App\Models\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(Page $page) {
        return [
            'id' => $page->id,
            'title' => $page->translate->title,
            'descriptions' => $page->translate->descriptions,
        ];
    }
}