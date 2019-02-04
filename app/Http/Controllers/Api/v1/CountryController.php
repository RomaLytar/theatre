<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Country;
use App\Transformers\CountryTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::with('translate')->get();

        return fractal()
            ->collection($countries)
            ->transformWith(new CountryTransformer)
            ->toArray();
    }
}
