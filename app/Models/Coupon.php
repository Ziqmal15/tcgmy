<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'description',
        'discount_amount',
        'discount_type',
        'min_spend',
        'auto_assign_threshold',
        'valid_from',
        'valid_until',
        'is_active',
        'approved_by'
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_used', 'used_at')
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isUsedInOrder(): bool
    {
        return $this->orders()->exists();
    }

    public function isValid(): bool
    {
        return $this->is_active &&
            $this->valid_from <= now() &&
            ($this->valid_until === null || $this->valid_until >= now()) &&
            !$this->isUsedInOrder();
    }

    public function calculateDiscount($subtotal)
    {
        if ($this->discount_type === 'percentage') {
            return ($subtotal * $this->discount_amount) / 100;
        }
        return $this->discount_amount;
    }
} 