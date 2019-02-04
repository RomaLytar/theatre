<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Project;
use App\Models\VideoCategory;
use App\Models\Menu;
use App\Models\Season;
use App\Models\Actor;
use App\Models\VideoTranslation;
use DB;
use SEO;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
  public function index() {

    //-- List performance --//
    $performancesCollection = DB::table('performance_videos')->select('performance_id')->distinct()->get();
    $performanceIds = [];
    foreach ($performancesCollection as $performance) {
      $performanceIds[] = $performance->performance_id;
    }
    $performances = Performance::with('translate')->whereIn('id', $performanceIds)->get();
    //-- End List performance --//
    $actorsCollection = DB::table('actor_videos')->select('actor_id')->distinct()->get();
    $actorIds = [];
    foreach ($actorsCollection as $actor) {
      $actorIds[] = $actor->actor_id;
    }
    $actors = Actor::with('translate')->whereIn('id', $actorIds)->get();


    $categoryId = \Input::get('category_id');
    $currentCategory = null;
    $currentSeason = null;
    $seasonId = \Input::get('season_id');
    $performanceId = \Input::get('performance_id');
    $currentPerformance = null;
    $actorId = \Input::get('actor_id');
    $currentActor = null;


    $videos = Video::with('translate', 'actors', 'performances', 'category', 'category.translate', 'media')->latest()->where('category_id', '!=', null);
      //$videos = Video::all();

      if($categoryId) {
      $videos = $videos->where(['category_id' => $categoryId]);
      $currentCategory = VideoCategory::find($categoryId);
    }
    if($seasonId) {
      $videos = $videos->where(['season_id' => $seasonId]);
      $currentSeason = Season::find($seasonId);
    }
    if($performanceId){
      $videosCollection = DB::table('performance_videos')->select('video_id')->where('performance_id', $performanceId)->get();
      $videoIds = [];
      foreach ($videosCollection as $video) {
        $videoIds[] = $video->video_id;
      }
      $videos = Video::with('translate')->whereIn('id', $videoIds)->where('category_id', '!=', null);
      $currentPerformance = Performance::with('translate')->find($performanceId);
    }
    if($actorId){
      $videosCollectionActor = DB::table('actor_videos')->select('video_id')->where('actor_id', $actorId)->get();
      $videoActorsIds = [];
      foreach ($videosCollectionActor as $video){
        $videoActorsIds[]= $video->video_id;
      }
      $videos = Video::with('translate')->whereIn('id', $videoActorsIds)->where('category_id', '!=', null);
      $currentActor = Actor::with('translate')->find($actorId);
    }

    $videos = $videos->paginate();

    $categories = VideoCategory::with('translate')->get();
    $seasons = Season::with('translate')->get();

    SEO::setTitle(($currentCategory) ? $currentCategory->translate->title : 'Videos');
    SEO::setDescription(($currentCategory) ? $currentCategory->translate->seo_description : 'This is videos page description');
    $menu = Menu::where('parent_id', null)->orderBy('position')->get();

    return view('pages.theatre.pages.videos',
      compact('menu', 'videos',
        'categories', 'currentCategory',
        'seasons', 'currentSeason',
        'performances', 'currentPerformance',
        'actors', 'currentActor'));
  }
}
