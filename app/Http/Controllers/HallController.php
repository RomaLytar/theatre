<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\HallTranslation;

class HallController extends Controller
{
  public function index()
  {
    return view('pages.theatre.pages.visit_plan_hall', compact('hall'));
  }
  public function show($id, $slug){
    $halls = Hall::with('translate')->get();
    $hall = Hall::with('translate')->where('id', $id)->first();

    if($hall->translate->slug !== $slug) {
      return redirect()->route('front.hall.show', ['id' => $id, 'slug' => $hall->translate->slug]);
    }
    return view('pages.theatre.pages.visit_plan_hall',compact('hall','halls'));
  }
}
