<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\Post;
use App\Models\City;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Hair;
use App\Models\Eye;
use Auth;
Use Alert;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Cities';
        $cities = City::orderBy('name')->withCount(['posts'])->cursorPaginate(50);

        return view('admin-pages.cities-index')->with(compact('title', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add City';        
        $countries = Country::orderBy('name')->get()->unique('name');  
        $states = State::orderBy('name')->get();
               
        return view('admin-pages.create-cities')->with(compact('title', 'countries', 'states'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required|unique:cities,name',
            'name.unique' => 'The City name must be unique.',           
        ],
        [
            'name.required' => 'The City name field is required.',
            'country_id.required' => 'The Country field is required.',
            'state_id.required' => 'The State field is required.'            
        ]); 

        $adminName = Auth::user()->username;
        $city = new City;
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->added_by =   $adminName;    
        $city->save();

        $alerted = Alert::success('City Added', 'You have added a new city'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $city = City::where('slug', $slug)->with(['posts', 'country', 'state'])->firstOrFail();

        return view('admin-pages.city-details')->with(compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $title = 'Edit City';
        return view('admin-pages.edit-city')->with(compact('title', 'city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities,name'            
        ],
        [
            'name.required' => 'The city name field is required.', 
            'name.unique' => 'The city name must be unique.'           
        ]);   

       
        $city->name = $request->name;           
        $city->save();

        $alerted = Alert::success('City Edited', 'The state has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        $alerted = Alert::success('City Deleted', 'The city has been deleted'); 
        return redirect()->back()->with('alerted');
    }
    

    public function showPosts(string $slug)
    {

        $city = City::where('slug', $slug)->firstOrFail();
        $city->load('posts'); //post relationship in the City model

        return view('pages.cities-posts', compact('city'));
    }

    public function viewPostDetails($slug)
    {
        $post = Post::where('slug', $slug)->with('country', 'state', 'city', 'gender', 'eye', 'ethnicity', 'hair')->firstOrFail();
        return view('pages.post-details', compact('post'));

    }

}
