<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'stock' => $this->stock,
            'is_active' => $this->is_active,
            'main_image_url' => $this->main_image_url,
            'description' => $this->description,
            'store' => new StoreResource($this->whenLoaded('store')),
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
