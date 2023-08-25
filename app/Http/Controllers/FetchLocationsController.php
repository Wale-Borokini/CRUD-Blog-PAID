<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class FetchLocationsController extends Controller
{
    
    public function getStateByCountry($country_id)
    {
        $states = State::where('country_id', $country_id)->orderBy('name')->pluck('name', 'id')->unique();
        return response()->json($states);
    }

    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

}
