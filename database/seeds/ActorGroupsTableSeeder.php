<?php

use Illuminate\Database\Seeder;

class ActorGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
          'Artistic management' => [],
          'Troupe' => [
            'Opera troupe' => ['Soprano', 'Mezzo-soprano', 'Tenors', 'Baritones', 'Bass'
            ],
            'Ballet troupe' => ['Managers', 'Teachers', 'Concertmasters', 'Assistant directors leading the show', 'Ballet dancers'],
            'Choir' => ['Choirmasters', 'Soprano 1', 'Soprano 2', 'Tenor 1', 'Tenor 2', 'Alt 1', 'Alt 2', 'Baritone', 'Bass'],
            'Orchestra' => ['Conductors', 'First violins', 'Second violins', 'Alty', 'Cello', 'Counterbasis', 'Harp',
                            'Flutes', 'Oboes', 'Clarinets', 'Bassoons', 'French horns', 'Pipes', 'Trombones', 'Drums', 'Piano']
            ],
          'Directors' => [],
          'Conductors' => [],
          'Artists' => [],
          'Management' => [],
          'Guest artists' => [],
          'Board of trustees' => []
        ];
        $this->addItems($groups);
    }

    private function addItems($items, $itemId = null):void {
      if(is_array($items) && count($items) !== 0) {
        foreach ($items as $value => $arr) {
          if(is_numeric($value)) {
            $value = $arr;
            $this->formItem($value, $itemId);
          } else {
            $item = $this->formItem($value, $itemId);
            $this->addItems($arr, $item[0]->id);
          }
        }
      }
    }

    private function formItem($groupName, $parentId = null) {
        $group = factory(App\Models\ActorGroup::class, 'actor_group', 1)
                ->create(['parent_id' => $parentId, 'name' => str_slug($groupName, '-')])
                ->each(function($actor_group) use ($groupName) {
            $actor_group->translate('en')->save(factory(App\Models\ActorGroupTranslation::class, 'actor_group_en')
                                         ->create(['actor_group_id' => $actor_group->id, 'title' => $groupName]));
            $actor_group->translate('ru')->save(factory(App\Models\ActorGroupTranslation::class, 'actor_group_ru')
                                         ->create(['actor_group_id' => $actor_group->id, 'title' => $groupName]));
            $actor_group->translate('ua')->save(factory(App\Models\ActorGroupTranslation::class, 'actor_group_ua')
                                         ->create(['actor_group_id' => $actor_group->id, 'title' => $groupName]));
        });
        return $group;
    }
}
