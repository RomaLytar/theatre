<?php

namespace App\Transformers;

use App\Models\Album;
use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\Models\Media;


class AlbumTransformer extends TransformerAbstract
{

    public function transform(Album $album)
    {
        return [
            'id' => $album->id,
            'type' => 'media',
            'title' => $album->translate->title,
            'cat' => $album->category->translate->title,
            'img' => $album->getFirstMediaUrl('posters', 'preview'),
            'url' => route('front.albums.show', ['id' => $album->id,'slug' => $album->translate->slug]),
        ];
    }

}