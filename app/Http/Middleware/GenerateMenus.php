<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  public function handle($request, Closure $next)
  {
    $menuItems = Menu::with('translate', 'children_items', 'children_items.translate')->where('parent_id', null)->get();

    \Menu::make('mainMenu', function ($menu) use ($menuItems) {
      foreach ($menuItems as $item) {
        $menu->add($item->translate->menu, ['url' => $item->url, 'id' => $item->id]);
        if(\count($item->children_items) !== 0) {
          foreach ($item->children_items as $childrenItem) {
            $menu->find($item->id)->add($childrenItem->translate->menu, ['url' => $childrenItem->url, 'id' => $childrenItem->id]);
          }
        }
      }
    });

    return $next($request);
  }
}
