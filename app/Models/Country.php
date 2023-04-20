<?php

namespace App\Models;

use App\Models\Continent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    /* Without timestamps */
    public $timestamps = false;

    /* The attributes that are mass assingnable */
    protected $fillable = [
        'country_id', 'code', 'name', 'full_name', 'iso3', 'number', 'continent_code', 'display_order'
    ];

    /* Table countries */
    protected $table = 'countries';

    /* Get by column 'country_id' */
    public function getRouteKeyName()
    {
        return 'country_id';
    }

    use HasFactory;

    /*  Get the continent to which the country belongs. */
    public function continent()
    {
        return $this->belongsTo(Continent::class, 'continent_code', 'code');
    }
}
