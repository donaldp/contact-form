<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GenderController extends Controller
{
    /**
     * Get a list of all available genders.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all() : Collection
    {
        return Gender::select('name', 'alias')->get();
    }
}
