<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CalendarResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $actors = [];
        foreach ($this->actors as $actor) {
          $actors[] = $actor->actor->translate->firstName . ' ' . $actor->actor->translate->lastName;
        }

        return [
            'title' => $this->performance->translate->title,
            'slug' => $this->performance->translate->slug,
            'dateTime' => (new \DateTime($this->date))->format('Y-m-d'.'\T'.'h:i:s'),
            'type' => $this->performance->type->name,
            'typeName' => $this->performance->type->translate->title,
            'actors' => $actors,
            'author' => strip_tags($this->performance->translate->author),
            'ticketsSold' => false,
            'eventUrl' => 'ticket/perfomance/' . $this->id,
            'imageUrl' => $this->performance->getFirstMediaUrl('posters', 'slider-new'),
            'ctaUrl' => '',
            'scene' => $this->performance->hall->name,
            'sceneName' => $this->performance->hall->translate->title,
            'time' => (new \DateTime($this->date))->format('h:i'),
            'price' => ['min' => $this->performance->price, 'max' => $this->performance->price],
        ];
    }
}
