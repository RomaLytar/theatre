<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class PerformanceResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            ['dates' => $this->dates],
            ['images' => $this->images],
            ['videos' => $this->images]
        );
    }
}
