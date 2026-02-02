<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'contact_no' => $this->contact_no,
            'status' => $this->status,
            'store_logo_url' => $this->main_image_url,
            'store_url' => $this->store_url,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
