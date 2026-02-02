<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use App\Observers\StoreObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

#[ObservedBy([StoreObserver::class])]
class Store extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $appends = [
        'main_image_url',
        'resolved_theme',
        'resolved_links',
    ];

    protected $casts = [
        'status' => ActiveStatus::class,
        'theme' => 'array',
        'links' => 'array',
    ];

    /* =========================
       MEDIA
    ========================= */
    public function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('store') ?: null
        );
    }

    /* =========================
       TEMPLATE
    ========================= */
    public function template(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?: 'classic'
        );
    }

    /* =========================
       THEME (SAFE DEFAULTS)
    ========================= */
    public function resolvedTheme(): Attribute
    {
        return Attribute::make(
            get: fn () => array_merge([
                'primary' => '#000000',
                'header_background_type' => 'color',
                'background_color' => '#ffffff',
                'background_image' => null,
                'background_opacity' => 0.6,
            ], $this->theme ?? [])
        );
    }

    /* =========================
       LINKS (SAFE DEFAULT)
    ========================= */
    public function resolvedLinks(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->links ?? []
        );
    }
}
