<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\FestivalsResource;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FestivalController extends Controller
{
    public function index(Request $request)
    {
        if ((!$id = $request->query('id'))) {
            throw new BadRequestHttpException();
        }
        $album = Festival::find($id)->getMedia('album-images');
        return new FestivalsResource($album);
    }
}
