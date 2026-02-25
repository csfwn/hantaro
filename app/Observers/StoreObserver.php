<?php

namespace App\Observers;

use App\Models\Store;

class StoreObserver
{
    public function creating(Store $store)
    {
        $user = auth()->user();
        $store->code = code_generate();
        if ($user && $user->hasRole('merchant')) {
            $store->user_id = $user->id;
        }
        $store->store_url = config('params.store_url') . '/' . $store->code;
    }
}
