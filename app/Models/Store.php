<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Store extends Model
{
    use SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'status' => ActiveStatus::class
    ];
}
