<?php

namespace App\Transformers;

use App\Models\Video;
use League\Fractal\TransformerAbstract;


class VideoTransformer extends TransformerAbstract
{
    public function transform(Video $video)
    {
        return [
            'title' => $video->translate->title,
            'type' => 'media',
            'cat' => $video->category->translate->title,
            'img' => $video->getFirstMediaUrl('posters', 'preview') ?? $video->getImageUrlFromYoutube(),
            'url' => $video->url,
        ];
    }
}