<?php

namespace App\Observers;

use App\Models\Store;

class StoreObserver
{
    public function creating(Store $store)
    {
        $store->code = code_generate();
        $store->store_url = config('params.store_url').'/'.$store->code;
    }
}
