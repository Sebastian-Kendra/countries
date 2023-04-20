<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Continent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){

        /* Rest index */
        return view('index');
    }
}
