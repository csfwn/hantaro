<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = [
        'ref_no',
        'currency_code',
        'total_amount',
        'paid_amount',
        'delivery_fee',
        'service_fee',
        'payment_method',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'status',
        'completed_at',
        'whatsapp_url'
    ];

    // Casts
    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    /**
     * Order has many products
     */
    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
