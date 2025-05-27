<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Startup extends Model
{
    protected $fillable = [
        'name',
        'description',
        'industry',
        'funding_goal',
        'current_funding',
        'status',
        'deadline',
        'founder_name',
        'founder_email',
    ];

    protected $casts = [
        'funding_goal' => 'decimal:2',
        'current_funding' => 'decimal:2',
        'deadline' => 'date',
    ];

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function getFundingPercentageAttribute(): float
    {
        if ($this->funding_goal == 0) {
            return 0;
        }
        return ($this->current_funding / $this->funding_goal) * 100;
    }
}
