<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProhibitedActivity extends Model
{
    use HasFactory;

    protected $fillable = ['sector_id', 'name', 'description', 'justification'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_activities')
            ->withPivot('indicators');
    }
}