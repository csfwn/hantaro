<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Filterable;

    protected $fillable = [
        'store_id',
        'name',
        'slug',
        'description',
        'is_active',
        'price',
        'discount_price',
        'stock',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['main_image_url'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFirstMediaUrl('products') ?: null
        );
    }
}
