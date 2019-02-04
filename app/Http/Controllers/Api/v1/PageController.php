<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Page;
use App\Transformers\PageTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function show($pageName) {
        $page = Page::with('translate')->where('name', $pageName)->first();

        return fractal()
            ->item($page)
            ->transformWith(new PageTransformer)
            ->toArray();
    }
}
