<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;

class ImageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
      return 'App\Models\Image';
    }

    public function saveImage($image, $path)
    {
        $imgName = uniqid('cxid', true) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imgName);
        return $this->create([
            'url' => $path . '/' . $imgName
        ]);
    }

    public function saveImages($images, $path)
    {
        $imagesArr = [];
        if (!$images) {
          return $imagesArr;
        }
        foreach ($images as $image) {
            array_push($imagesArr, $this->saveImage($image, $path));
        }
        return $imagesArr;
    }

    public function deleteNotIn($item, array $ids)
    {
        $images = $item->images()->whereNotIn('images.id', $ids)->get();
        foreach ($images as $image) {
          unlink(public_path($image->url));
        }
        $item->images()->whereNotIn('images.id', $ids)->delete();
    }
}
