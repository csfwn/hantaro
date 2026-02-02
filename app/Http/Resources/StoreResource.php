<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /* =========================
               BASIC INFO
            ========================= */
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'contact_no' => $this->contact_no,
            'status' => $this->status,

            /* =========================
               URLS & MEDIA
            ========================= */
            'store_logo_url' => $this->main_image_url,
            'store_url' => $this->store_url,

            /* =========================
               STORE CONFIG (IMPORTANT)
            ========================= */
            'template' => $this->template,              // always string
            'theme'    => $this->resolved_theme,         // always complete object
            'links'    => $this->resolved_links,         // always array

            /* =========================
               META
            ========================= */
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
