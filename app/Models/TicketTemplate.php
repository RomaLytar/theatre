<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class TicketTemplate extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title', 'json_code', 'html_code', 'width', 'height', 'is_active_cash_box', 'is_active_online'];

    public function registerMediaCollections() {
        $this->addMediaCollection('posters');
    }
}
