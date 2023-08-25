<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class PagesController extends Controller
{

    public function viewIndexPage()
    {

        $title = 'Patron Castle!';
        // $countries = Country::orderBy('name')->get()->unique('name');
        // $countries = Country::with('states.cities')->get()->unique('name');
        $unitedStates = Country::where('name', 'United States')->with('states.cities')->first();
               
        return view('pages.index')->with(compact('title', 'unitedStates'));

    }

    public function viewStatesPage()
    {

        $title = 'Patron Castle!';
        // $countries = Country::orderBy('name')->get()->unique('name');
        $countries = Country::with('states.cities')->get()->unique('name');
               
        return view('pages.index')->with(compact('title', 'countries'));

    }


}
