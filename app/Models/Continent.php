<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Continent extends Model
{
    /* Table continents */
    protected $table = 'continents';

    /* Get by column 'code' */
    public function getRouteKeyName()
    {
        return 'code';
    }

    use HasFactory;

    /*  Get the all country from the continents. */
    public function countries(){
        return $this->hasMany(Country::class, 'continent_code', 'code');
    }
}
