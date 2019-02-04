<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Article;
use App\Models\Festival;
use App\Models\Menu;
use App\Models\Video;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function show($id, $slug) {
      if (!$festival = Festival::with(
        'translate')->find($id)) {
        abort(404);
      }

      if($festival->translate->slug !== $slug) {
        return redirect()->route('front.festivals.show', ['id' => $id, 'slug' => $festival->translate->slug]);
      }

      SEO::setTitle($festival->translate->seo_title);
      SEO::setDescription($festival->translate->seo_description);

      $articles = Article::with('translate', 'media')->latest()->limit(3)->get();
      $guestStars = $this->formArray($festival->translate->invited_stars);

      return view('pages.theatre.pages.festival', compact('festival', 'guestStars', 'articles','actor'));
    }

    public function formArray($string){
      $array = [];
      $stringList = explode(';', $string);
        foreach( $stringList as $string){
          $position_actor = explode('-', $string);
          $array[] = $position_actor;
        }
      return $array;
    }
}
