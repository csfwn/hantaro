<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function search($value)
    {
        return $this->where(function ($q) use ($value) {
            $q->where('name', 'LIKE', "%{$value}%")
                ->orWhere('sku', 'LIKE', "%{$value}%");
        });
    }
}
