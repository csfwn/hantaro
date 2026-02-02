<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use App\Observers\StoreObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
#[ObservedBy([StoreObserver::class])]
class Store extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $appends = ['main_image_url'];

    protected $casts = [
        'status' => ActiveStatus::class
    ];

    public function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFirstMediaUrl('store') ?: null
        );
    }
}
