<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Menu;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceType;
use App\Models\Season;
use App\Repositories\HomePageRepository;
use SEO;
use App\Models\Performance;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $homePageRepository;

    public function __construct(HomePageRepository $homePageRepository) {
        $this->homePageRepository = $homePageRepository;
    }

    public function index() {
      $categoryId = \Input::get('category_id');
      $currentCategory = null;
      $currentSeason = null;
      $seasonId = \Input::get('season_id');

      $events = Performance::with('translate', 'type', 'type.translate', 'media')->latest();
      if($categoryId) {
        $events = $events->where(['type_id' => $categoryId]);
        $currentCategory = PerformanceType::find($categoryId);
      }
      if($seasonId) {
        $events = $events->where(['season_id' => $seasonId]);
        $currentSeason = Season::find($seasonId);
      }
      $events = $events->paginate();

      $categories = PerformanceType::with('translate')->get();
      $seasons = Season::with('translate')->get();

      SEO::setTitle(($currentCategory) ? $currentCategory->translate->title : 'Repertoire');
      SEO::setDescription(($currentCategory) ? $currentCategory->translate->seo_description : 'This is repertoire page description');

      return view('pages.theatre.pages.repertoire',
        compact('events',
          'categories', 'currentCategory',
          'seasons', 'currentSeason'));
    }
    public function show($id, $slug) {
      if (!$performance = Performance::with(
        'translate',
        'type', 'type.translate', 'dates',
        'images', 'videos', 'articles',
        'articles.media', 'articles.translate'
      )->find($id)) {
        abort(404);
      }

      $dateIds = $performance->dates()->pluck('id');

      $dateActors = PerformanceActor::whereIn('performance_calendar_id', $dateIds)->get();
      $groupActorDates = $dateActors->groupBy('actor_id');

      if($performance->translate->slug !== $slug) {
        return redirect()->route('front.events.show', ['id' => $id, 'slug' => $performance->translate->slug]);
      }

      $homePageComponents = $this->homePageRepository->getAllComponents();

      $album = $performance->albums()->latest()->first();

      SEO::setTitle($performance->translate->seo_title);
      SEO::setDescription($performance->translate->seo_description);

      return view('pages.theatre.pages.event', compact('performance', 'groupActorDates', 'actors', 'homePageComponents', 'album'));
    }

    public function synopsis($id, $slug) {
      if (!$performance = Performance::with('translate')->find($id)) {
        abort(404);
      }

      if($performance->translate->slug !== $slug) {
        return redirect()->route('front.events.synopsis', ['id' => $id, 'slug' => $performance->translate->slug]);
      }

      SEO::setTitle($performance->translate->seo_title);
      SEO::setDescription($performance->translate->seo_description);

      return view('pages.theatre.pages.synopsis', compact('performance'));
    }
}
