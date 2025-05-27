<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'total_budget',
        'preferred_industries',
        'investor_type',
    ];

    protected $casts = [
        'total_budget' => 'decimal:2',
        'preferred_industries' => 'array',
    ];

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function getTotalInvestedAttribute(): float
    {
        return $this->investments()->where('status', 'approved')->sum('amount');
    }
}
