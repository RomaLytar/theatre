<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Menu;
use App\Transformers\MenuTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = Menu::with('translate', 'children_items', 'children_items.translate')->where('parent_id', null)->get();

        return fractal()
            ->collection($menuItems)
            ->parseIncludes(['childrenItems'])
            ->transformWith(new MenuTransformer)
            ->toArray();
    }
}
