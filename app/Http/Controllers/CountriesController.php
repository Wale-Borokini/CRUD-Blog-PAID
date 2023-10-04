<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Auth;
Use Alert;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Countries';
        $countries = Country::orderBy('name')->withCount(['states', 'cities', 'posts'])->get()->unique('name');
        $totalCountriesCount = Country::count();

        return view('admin-pages.countries-index')->with(compact('title', 'countries', 'totalCountriesCount'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $title = 'Add Country';      
        return view('admin-pages.create-countries')->with(compact('title'));

        // return view('admin-pages.countries-index', compact('title', 'countries'))
    
    }
    
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:countries,name'            
        ],
        [
            'name.required' => 'The country name field is required.', 
            'name.unique' => 'The country name must be unique.'           
        ]);   

        
        $adminName = Auth::user()->username;
        $country = new Country;
        $country->name = $request->name;
        $country->added_by =   $adminName;    
        $country->save();

        $alerted = Alert::success('Country Added', 'You have added a new country'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $country = Country::where('slug', $slug)->with(['states.cities', 'States.posts'])->withCount('states')->firstOrFail();
        $states = $country->states()->orderBy('name')->cursorPaginate(50);

        return view('admin-pages.country-details')->with(compact('country', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $title = 'Edit Country';
        return view('admin-pages.edit-country')->with(compact('title', 'country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name'            
        ],
        [
            'name.required' => 'The country name field is required.', 
            'name.unique' => 'The country name must be unique.'           
        ]);   

        $oldSlug = $country->slug;
        $country->name = $request->name;           
        $country->save();

        $alerted = Alert::success('Country Edited', 'The country has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        $alerted = Alert::success('Country Deleted', 'The country has been deleted'); 
        return redirect()->back()->with('alerted');
    }

    
}
