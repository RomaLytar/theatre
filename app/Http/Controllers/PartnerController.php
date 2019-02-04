<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index() {
      SEO::setTitle(__('partners.title'));
      SEO::setDescription(__('partners.description'));

      $mainPartners = Partner::with('translate', 'media')
        ->where('is_active', 1)
        ->where('is_main', 1)
        ->get();
      $middlePartners = Partner::with('translate', 'media')
        ->where('is_active', 1)
        ->where('is_middle', 1)
        ->get();
      $otherPartners = Partner::with('translate', 'media')
        ->where('is_active', 1)
        ->where(['is_main' => null, 'is_middle' => null])
        ->get();

      return view('pages.theatre.pages.partners', compact('mainPartners', 'middlePartners', 'otherPartners'));
    }

    public function show($id) {
      if(!$partner = Partner::with('translate', 'media')->find($id)) {
        abort(404);
      }

      SEO::setTitle($partner->translate->seo_title ?: $partner->translate->title);
      SEO::setDescription($partner->translate->seo_description);

      return view('pages.theatre.pages.partner', compact('partner'));
    }
}
