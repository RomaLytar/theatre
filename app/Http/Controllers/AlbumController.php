<?php

namespace App\Http\Controllers;

use App\Models\AlbumCategory;
use App\Models\Menu;
use App\Models\Season;
use SEO;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index() {
      $categoryId = \Input::get('category_id');
      $currentCategory = null;
      $currentSeason = null;
      $seasonId = \Input::get('season_id');

      $albums = Album::with('translate', 'category', 'category.translate', 'media')->latest();
      if($categoryId) {
        $albums = $albums->where(['category_id' => $categoryId]);
        $currentCategory = AlbumCategory::find($categoryId);
      }
      if($seasonId) {
        $albums = $albums->where(['season_id' => $seasonId]);
        $currentSeason = Season::find($seasonId);
      }

      $albums = $albums->paginate();

      $categories = AlbumCategory::with('translate')->get();
      $seasons = Season::with('translate')->get();

      SEO::setTitle(($currentCategory) ? $currentCategory->translate->title : 'Albums');
      SEO::setDescription(($currentCategory) ? $currentCategory->translate->seo_description : 'This is albums page description');
      $menu = Menu::where('parent_id', null)->orderBy('position')->get();

      return view('pages.theatre.pages.albums',
        compact('menu', 'albums',
          'categories', 'currentCategory',
          'seasons', 'currentSeason'));
    }

    public function show($id, $slug) {
      if (!$album = Album::find($id)) {
        abort(404);
      }

      if($album->translate->slug != $slug) {
        return redirect()->route('front.albums.show', ['id' => $id, 'slug' => $album->translate->slug]);
      }

      SEO::setTitle($album->translate->seo_title);
      SEO::setDescription($album->translate->seo_description);

      $photos = $album->getMedia('album-images');
      $photos = $this->paginate($photos, 16, \Input::get('page'));
      $menu = Menu::where('parent_id', null)->orderBy('position')->get();

      return view('pages.theatre.pages.album', compact('menu', 'album', 'photos'));
    }

    public function getAlbumPhotos($id) {
      $album = Album::find($id)->firstOrFail();

      return $album;
    }
}
