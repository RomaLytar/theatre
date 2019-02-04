<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\FestivalTranslation;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\App;

class FestivalRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Festival';
    }

    public function createFestival($data)
    {
        $festival = $this->create([
            'fb_link' => $data['fb_link'],
            'tw_link' => $data['tw_link'],
        ]);
        $this->addVideos($data['videos'], $festival);
        $this->updateOrCreateTranslation($data, $festival->id);
        $this->addPerformances($data['performances'], $festival);

        return $festival;
    }

    public function updateFestival($data, $festival)
    {
        $this->update([
            'fb_link' => $data['fb_link'],
            'tw_link' => $data['tw_link'],
        ], ['id' => $festival->id]);
        $this->addVideos($data['videos'], $festival);
        $this->updateOrCreateTranslation($data, $festival->id);
        $this->updatePerformances($data['performances'], $festival);
    }

    public function updateOrCreateTranslation($data, $id)
    {
        foreach (get_languages() as $lang => $val) {
            FestivalTranslation::updateOrCreate([
              'festival_id' => $id,
              'language' => $lang
            ], [
              'title' => $data['title_' . $lang],
              'descriptions' => $data['descriptions_' . $lang],
              'invited_stars' => $data['invited_stars_' . $lang],
              'seo_title' => $data['seo_title_' . $lang],
              'seo_description' => $data['seo_description_' . $lang],
            ]);
        }
    }

    public function updatePerformances($performances, $festival)
    {
        foreach ($festival->calendars as $date) {
            $festival->calendars()->detach($date->id);
        }
        $this->addPerformances($performances, $festival);
    }

    public function addPerformances($performances, $festival)
    {
        foreach ($performances as $performance) {
            $festival->calendars()->attach($performance);
        }
    }

    public function addImages($images, $item)
    {
        foreach ($images as $image) {
            $item->images()->attach($image->id);
        }
    }

    public function addVideos($videos, $item)
    {
        foreach ($videos as $video) {
            $item->videos()->attach($video->id);
        }
    }
}
