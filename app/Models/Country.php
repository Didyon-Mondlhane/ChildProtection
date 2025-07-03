<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'continent', 'region', 'gdp', 'hdi', 'official_language',
        'independence_year', 'ilo_conventions', 'hazardous_activities_approval_year',
        'sst_legislation_robustness', 'youth_percentage', 'children_percentage',
        'gdp_contributing_sectors', 'employment_sectors', 'education_level'
    ];

    public function classifications()
    {
        return $this->hasMany(CountryClassification::class);
    }

    public function activities()
    {
        return $this->belongsToMany(ProhibitedActivity::class, 'country_activities')
            ->withPivot('indicators');
    }

}