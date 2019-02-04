<?php

namespace App\Transformers;

use App\Models\Menu;
use League\Fractal\TransformerAbstract;

class MenuTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['childrenItems'];

    public function transform(Menu $menuItem) {
        return [
            'id' => $menuItem->id,
            'title' => $menuItem->translate->menu,
            'url' => $menuItem->url,
        ];
    }

    public function includeChildrenItems(Menu $menu)
    {
        return $this->collection($menu->children_items, new MenuTransformer);
    }
}