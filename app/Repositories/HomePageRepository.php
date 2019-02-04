<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\HomePage;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;

class HomePageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
      return 'App\Models\HomePage';
    }

    public function saveComponents($type, array $data)
    {
        $this->model->where('type', $type)->whereNotIn('performance_calendar_id', $data)->delete();
        foreach ($data as $performanceDateId) {
            $this->model->updateOrCreate([
              'type' => $type,
              'performance_calendar_id' => $performanceDateId
            ]);
        }
    }

    public function getAllComponents()
    {
        $components = $this->all();
        $items = [];
        foreach ($components as $component) {
            switch ($component->type) {
                case HomePage::SPECIAL_PROJECTS_TYPE:
                    $items[HomePage::SPECIAL_PROJECTS_TYPE][] = $component->performanceDate;
                    break;
                case HomePage::RECOMMENDED_TYPE:
                    $items[HomePage::RECOMMENDED_TYPE][] = $component->performanceDate;
                    break;
                case HomePage::PROMO_SLIDER_TYPE:
                    $items[HomePage::PROMO_SLIDER_TYPE][] = $component->performanceDate;
                    break;
              case HomePage::PROMO_SLIDER_MINI_TYPE:
                $items[HomePage::PROMO_SLIDER_MINI_TYPE][] = $component->performanceDate;
                break;
              default:
                    throw new \Exception('Invalid home page component type');
            }
        }
        return $items;
    }
}
