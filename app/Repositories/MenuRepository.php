<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuTranslation;

class MenuRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Menu';
  }
  
  public function createMenuItem($data)
  {
    $menuItem = [
      'url' => $data['url'],
      'position' => $data['position'],
      'parent_id' => $data['parent_id'],
    ];
    $menuItem = $this->create($menuItem);
    $this->addTranslationMenuItem($data, $menuItem->id);
  }
  
  public function editMenuItem($data, $id)
  {
    $array = [
      'url' => $data['url'],
      'position' => $data['position'],
      'parent_id' => $data['parent_id'],
    ];
    $this->update($array, ['id' => $id]);
    $menuItem = Menu::find($id);
    $this->editTranslationMenuItem($data, $menuItem);
  }
  
  public function addTranslationMenuItem($data, $menuItemId)
  {
    foreach (get_languages() as $lang => $val) {
      MenuTranslation::create([
        'menu_id' => $menuItemId,
        'language' => $lang,
        'menu' => $data['menu_' . $lang],
      ]);
    }
  }
  
  public function editTranslationMenuItem($data, $menuItem)
  {
    foreach (get_languages() as $lang => $val) {
      $menuItemTranslation = MenuTranslation::where(['menu_id' => $menuItem->id, 'language' => $lang])->first();
      $menuItemTranslation->update([
        'menu_id' => $menuItem->id,
        'language' => $lang,
        'menu' => $data['menu_' . $lang],
      ]);
    }
  }
}
