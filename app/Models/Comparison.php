<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comparison extends Model
{
    protected $fillable = [
        'name',
        'comparison_type',
        'parameters',
        'results',
        'comments',
        'country1_id',
        'country2_id',
        'user_id'
    ];

    protected $casts = [
        'parameters' => 'array',
        'results' => 'array'
    ];

    public function country1(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country1_id');
    }

    public function country2(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country2_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function savedQuery()
    {
        return $this->belongsTo(SavedQuery::class);
    }
}