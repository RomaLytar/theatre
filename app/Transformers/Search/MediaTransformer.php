<?php

namespace App\Transformers\Search;

use League\Fractal\TransformerAbstract;


class MediaTransformer extends TransformerAbstract
{

    public function transform($media)
    {
        if((get_class($media) == 'App\Models\Album')){
            $type = 'album';
            $url = route('front.albums.show', ['id' => $media->id,'slug' => $media->translate->slug]);
            $youtubeimg = '';
        }
        else{
            $type = 'video';
            $url = $media->url;
            $youtubeimg = $media->getImageUrlFromYoutube();
        }

        return [
            'id' => $media->id,
            'type' => $type,
            'title' => $media->translate->title,
            'cat' => $media->category->translate->title,
            'img' => $media->getFirstMediaUrl('posters', 'preview'),
            'youtubeimg' => $youtubeimg,
            'url' => $url
        ];
    }

}