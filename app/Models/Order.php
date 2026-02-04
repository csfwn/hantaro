<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = [
        'ref_no',
        'store_id',
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
        'whatsapp_url',
        'url',
        'whatsapp_sent',
        'payment_gateway_reference',
        'payment_status',
    ];

    // Casts
    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'completed_at' => 'datetime',
        'status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
        'payment_method' => PaymentChannel::class
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    protected function customerUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => config('params.customer_url') . '/' . $this->ref_no,
        );
    }

    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if ($user->hasRole('super_admin')) {
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
