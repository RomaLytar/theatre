<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    //
  public function index() {
    //
    $faqCategories = FaqCategory::all();
    return view('pages.theatre.pages.faq', compact('faqCategories'));
  }
}
