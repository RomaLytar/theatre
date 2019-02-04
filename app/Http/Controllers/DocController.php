<?php

namespace App\Http\Controllers;

use App\Models\DocumentationCategoryTranslation;
use App\Models\DocumentationTranslation;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\DocumentationCategory;


class DocController extends Controller
{
  public function index($id,$slug)
  {
    $categories = DocumentationCategory::with('translate')->get();
    $docs = Documentation::with('translate', 'category', 'category.translate')->where('category_id',$id)->get();

    $cat = DocumentationCategory::with('translate')->where('id', $id)->first();
      if($cat->translate->slug !== $slug) {
        return redirect()->route('front.docs.index', ['id' => $id, 'slug' => $cat->translate->slug]);
      }

    return view('pages.theatre.pages.inform_orders',compact('categories','docs'));
  }
}
