<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryActivity extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'prohibited_activity_id', 'indicators'];

    protected $table = 'country_activities';

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function prohibitedActivity()
    {
        return $this->belongsTo(ProhibitedActivity::class);
    }
}