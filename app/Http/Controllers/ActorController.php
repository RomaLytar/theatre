<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Actor;
use App\Models\ActorGroup;
use App\Models\ActorTranslation;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ActorController extends Controller
{
    public function index() {
      SEO::setTitle('Actors');
      SEO::setDescription('This is my page description');
      $menu = Menu::where('parent_id', null)->orderBy('position')->get();
      $groups = ActorGroup::with('translate',
        'children_groups', 'children_groups.translate',
        'children_groups.actors', 'children_groups.actors.translate',
        'children_groups.actors.group', 'children_groups.actors.translate', 'children_groups.actors.group.translate',
        'children_groups.actors.calendars', 'children_groups.actors.calendars.performance',
        'children_groups.actors.calendars.performance.translate')
        ->where('parent_id', null)->get();
      return view('pages.theatre.pages.team', compact('menu', 'groups'));
    }

    public function management() {
      $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
      $currentGroup = ActorGroup::with('translate',
        'children_groups', 'children_groups.translate',
        'children_groups.actors', 'children_groups.actors.translate')->where('name', 'management')->first();
      SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
      SEO::setDescription($currentGroup->translate->seo_description);
      return view('pages.theatre.pages.team_management', compact('groups', 'currentGroup'));
    }

    public function directors() {
      $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
      $currentGroup = ActorGroup::with('translate',
        'children_groups', 'children_groups.translate',
        'children_groups.actors', 'children_groups.actors.translate')->where('name', 'directors')->first();
      SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
      SEO::setDescription($currentGroup->translate->seo_description);
      return view('pages.theatre.pages.team_directors', compact('groups', 'currentGroup'));
    }

  public function artistic_management() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'artistic-management')->first();

    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_artistic', compact('groups', 'currentGroup'));
  }

  public function conductors() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'conductors')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_kapellmeister', compact('groups', 'currentGroup'));
  }

  public function artists() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'artists')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_painters', compact('groups', 'currentGroup'));
  }

  public function troupe_opera() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'opera-troupe')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_troupe_opera', compact('groups', 'currentGroup'));
  }

  public function troupe_ballet() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'ballet-troupe')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_troupe_ballet', compact('groups', 'currentGroup'));
  }

  public function troupe_choir() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'choir')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_troupe_chorus', compact('groups', 'currentGroup'));
  }

  public function troupe_orchestra() {
    $groups = ActorGroup::with('translate')->where(['parent_id' => null, 'is_active' => true])->get();
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'orchestra')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.team_troupe_orchestra', compact('groups', 'currentGroup'));
  }

  public function guest_artists() {
    $currentGroup = ActorGroup::with('translate',
      'children_groups', 'children_groups.translate',
      'children_groups.actors', 'children_groups.actors.translate')->where('name', 'guest-artists')->first();
    SEO::setTitle($currentGroup->translate->seo_title ?? $currentGroup->translate->title);
    SEO::setDescription($currentGroup->translate->seo_description);
    return view('pages.theatre.pages.guest_artists', compact('currentGroup'));
  }

    public function show($id, $slug) {
      if (!$actor = Actor::with('translate',
        'group', 'group.translate',
        'calendars', 'calendars.date',
        'calendars.performance', 'calendars.performance.translate',
        'articles', 'articles.translate', 'articles.media'
      )->find($id)) {
        abort(404);
      }

      if($actor->translate->slug !== $slug) {
        return redirect()->route('front.actors.show', ['id' => $id, 'slug' => $actor->translate->slug]);
      }

      $articleRoute = 'front.articles.release';
      $performanceRoute = 'front.events.show';
      SEO::setTitle($actor->translate->seo_title);
      SEO::setDescription($actor->translate->seo_description);
      $menu = Menu::where('parent_id', null)->orderBy('position')->get();
      return view('pages.theatre.pages.artist', compact('menu', 'actor', 'articleRoute', 'performanceRoute'));
    }

    public function search()
    {
        return ActorTranslation::where(
          DB::raw('CONCAT(firstName, \' \', lastName)'),
          'LIKE',
          '%'.request('q').'%'
        )->select([
          DB::raw('CONCAT(firstName, \' \', lastName) AS fullName'),
          'actor_id as id'])->paginate(10);
    }


}
