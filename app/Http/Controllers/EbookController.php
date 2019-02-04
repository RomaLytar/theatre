<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebook;

class EbookController extends Controller
{
  public function index() {
    $ebooks = Ebook::paginate();
    return view('pages.theatre.pages.ebooks', compact('ebooks'));
  }
}
