<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Album;
use App\Models\Video;
use DB;
use App\Models\Performance;
use App\Transformers\AlbumTransformer;
use App\Transformers\VideoTransformer;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    /**
     * @return mixed
     */
    //вывод всех альбомов  и фильтрация
    public function indexAlbum()
    {
        $categoryId = \Input::get('category_id');
        $currentCategory = null;
        $currentSeason = null;
        $seasonId = \Input::get('season_id');

        $albums = Album::with('translate', 'category', 'category.translate', 'media')->latest();
        if($categoryId) {
            $albums = $albums->where(['category_id' => $categoryId]);
        }
        if($seasonId) {
            $albums = $albums->where(['season_id' => $seasonId]);
        }
        $albums = $albums->get();

        return fractal()
            ->collection($albums)
            ->transformWith(new AlbumTransformer)
            ->toArray();
    }

    /**
     * @return mixed
     * вывод всех видео
     */
    public function indexVideo()
    {

        //-- List performance --//
        $performancesCollection = DB::table('performance_videos')->select('performance_id')->distinct()->get();
        $performanceIds = [];
        foreach ($performancesCollection as $performance) {
            $performanceIds[] = $performance->performance_id;
        }
        //-- End List performance --//
        $actorsCollection = DB::table('actor_videos')->select('actor_id')->distinct()->get();
        $actorIds = [];
        foreach ($actorsCollection as $actor) {
            $actorIds[] = $actor->actor_id;
        }
        $categoryId = \Input::get('category_id');
        $currentCategory = null;
        $currentSeason = null;
        $seasonId = \Input::get('season_id');
        $performanceId = \Input::get('performance_id');
        $currentPerformance = null;
        $actorId = \Input::get('actor_id');
        $currentActor = null;


        $videos = Video::with('translate', 'actors', 'performances', 'category', 'category.translate', 'media')->latest()->where('category_id', '!=', null);
        if($categoryId) {
            $videos = $videos->where(['category_id' => $categoryId]);
        }
        if($seasonId) {
            $videos = $videos->where(['season_id' => $seasonId]);
        }
        if($performanceId) {
            $videosCollection = DB::table('performance_videos')->select('video_id')->where('performance_id', $performanceId)->get();
            $videoIds = [];
            foreach ($videosCollection as $video) {
                $videoIds[] = $video->video_id;
            }
            $videos = $videos->whereIn('id', $videoIds);
        }
        if($actorId){
            $videosCollectionActor = DB::table('actor_videos')->select('video_id')->where('actor_id', $actorId)->get();
            $videoActorsIds = [];
            foreach ($videosCollectionActor as $video){
                $videoActorsIds[]= $video->video_id;
            }
            $videos = $videos->whereIn('id', $videoActorsIds);
        }

        $videos = $videos->get();

        return fractal()
            ->collection($videos)
            ->transformWith(new VideoTransformer)
            ->toArray();
    }
}
