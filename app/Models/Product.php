<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
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
        'sku',
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

    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if ($user->hasRole(['super_admin', 'shopee_testing'])) {
            return $query;
        }

        if ($user->hasRole('merchant')) {
            return $query->whereHas('store', function (Builder $q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        return $query->whereRaw('1 = 0');
    }
}
