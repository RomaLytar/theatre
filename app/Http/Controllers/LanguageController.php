<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class LanguageController extends Controller
{
    public function change()
    {
        $locale = Input::get('locale');
        session(['locale' => $locale]);
        return Redirect::back();
    }
}
