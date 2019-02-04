<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\App;

class PerformanceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Performance';
    }

    public function getGeneralActors($performance)
    {
        return Actor::with('translate')->whereIn('id', function ($query) use ($performance) {
            $query->select('performance_actors.actor_id')
                ->from('performance_actors')
                ->leftJoin(
                    'performance_calendars',
                    'performance_actors.performance_calendar_id',
                    '=',
                    'performance_calendars.id'
                )->where('performance_calendars.performance_id', '=', $performance->id)
                ->groupBy('performance_actors.actor_id')
                ->having(DB::raw('COUNT(performance_actors.actor_id)'), '>=', $performance->dates()->count());
        })->get();
    }

    public function createPerformances($data)
    {
        $performance = [
            'price' => $data['price'],
            'duration' => $data['duration'],
            'hall_id' => $data['hall_id'],
            'type_id' => $data['type_id'],
            'season_id' => $data['season_id'],
            'isPremiere' => $data['isPremiere'] ?? false,
            'isSpecial' => $data['isSpecial'] ?? false,
        ];
        $performance = $this->create($performance);

        $this->updateOrCreateTranslationPerformance($data, $performance->id, $performance);

        foreach ($data['performances'] as $performanceData) {
            $performanceData = json_decode($performanceData);
            $performanceDay = PerformanceCalendar::create([
                'performance_id' => $performance->id,
                'date' => (new \DateTime($performanceData->date))->format('Y-m-d H:i:s'),
            ]);
            $actors = array_unique(array_merge($data['general_actors'] ?? [], $performanceData->special_actors));
            $this->addActorsToPerformance($actors, $performanceDay->id);
        }

        return $performance;
    }

    public function updatePerformance($data, $performance)
    {
        $performanceData = [
            'price' => $data['price'],
            'duration' => $data['duration'],
            'type_id' => $data['type_id'],
            'hall_id' => $data['hall_id'],
            'season_id' => $data['season_id'],
            'isPremiere' => $data['isPremiere'] ?? false,
            'isSpecial' => $data['isSpecial'] ?? false,
        ];

        $this->update($performanceData, ['id' => $performance->id]);

        $this->updateOrCreateTranslationPerformance($data, $performance->id, $performance);

        $dateIds = [];
        $existDatesIds = PerformanceCalendar::where('performance_id', $performance->id)->pluck('id')->toArray();

        foreach ($data['performances'] as $performanceData) {
            $performanceData = json_decode($performanceData);
            if(!isset($performanceData->date_id)) {
                continue;
            }
            $dateIds[] = $performanceData->date_id;
        }

        foreach ($existDatesIds as $dateId) {
            if(!in_array($dateId, $dateIds)) {
                PerformanceCalendar::find($dateId)->delete();
            }
        }

        $data['general_actors'] = $data['general_actors'] ?? [];

        foreach ($data['performances'] as $performanceData) {
            $performanceData = json_decode($performanceData);
            if(isset($performanceData->date_id) && $performanceDay = PerformanceCalendar::find($performanceData->date_id)) {
                $performanceDay->update([
                    'date' => (new \DateTime($performanceData->date))->format('Y-m-d H:i:s'),
                ]);
                PerformanceActor::where('performance_calendar_id', $performanceDay->id)->delete();
            } else {
                $performanceDay = PerformanceCalendar::create([
                    'performance_id' => $performance->id,
                    'date' => (new \DateTime($performanceData->date))->format('Y-m-d H:i:s'),
                ]);
            }
            $actors = array_unique(array_merge($data['general_actors'] ?? [], $performanceData->special_actors));
            $this->addActorsToPerformance($actors, $performanceDay->id);
        }
    }

    public function updateOrCreateTranslationPerformance($data, $performanceId, $performance)
    {
        foreach (get_languages() as $lang => $val) {
            PerformanceTranslation::updateOrCreate([
                'performance_id' => $performanceId,
                'language' => $lang
            ], [
                'title' => $data['title_' . $lang],
                'lang' => $data['lang_' . $lang],
                'descriptions' => $data['descriptions_' . $lang],
                'directors' => $data['directors_' . $lang],
                'directors2' => $data['directors2_' . $lang],
                'author' => $data['author_' . $lang],
                'seo_title' => $data['seo_title_' . $lang],
                'seo_description' => $data['seo_description_' . $lang],
                'synapsis' => $data['synapsis_' . $lang],
                'program' => $data['program_' . $lang] ?? null,
                'city' => $data['city_' . $lang],
                'place' => $data['place_' . $lang],
                'tagline' => $data['tagline_' . $lang],
            ]);
        }
    }

    public function addActorsToPerformance($actorIds, $performanceId)
    {
        $actors = Actor::whereIn('id', $actorIds)->get();
        $insertData = [];
        foreach ($actors as $actor) {
            $insertData[] = ['actor_id' => $actor->id, 'performance_calendar_id' => $performanceId];
        }
        PerformanceActor::insert($insertData);
    }

    public function getUpcomingPerformances($offset = 0, $limit = 10)
    {
        return $this->model->with('dates')->whereHas('dates', function ($query) {
            $query->whereDate('date', '>=', Carbon::now());
        })->limit($limit)->offset($offset)->get();
    }

    public function search($request)
    {
        return $this->model->join(
            'performance_calendars',
            'performances.id', '=', 'performance_calendars.performance_id'
        )->join(
            'performance_translations',
            'performances.id', '=', 'performance_translations.performance_id'
        )->select([
            'performance_calendars.id as idDate',
            'performances.id',
//          'performances.poster',
            'performance_translations.title',
            'performance_calendars.date'
        ])->where('performance_translations.title', 'LIKE', '%' . $request->get('q') . '%')
            ->where('performance_translations.language', $language = App::getLocale())
            ->get();
    }
}
