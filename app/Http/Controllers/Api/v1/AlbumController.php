<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\AlbumsResource;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AlbumController extends Controller
{
  public function index(Request $request)
  {
    if ((!$id = $request->query('id'))) {
      throw new BadRequestHttpException();
    }
    $album = Album::find($id)->getMedia('album-images');
    return new AlbumsResource($album);
  }
}
