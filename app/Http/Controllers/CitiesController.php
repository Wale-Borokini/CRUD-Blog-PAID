<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Rules\UniqueCityNameInState;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Country;
use App\Models\Post;
use App\Models\City;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Hair;
use App\Models\Eye;
use App\Models\Advert;
use Auth;
use Alert;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'All Cities';
        
        $search = $request->input('search');
        // Query the cities based on the search query (if provided)
        $citiesQuery = City::orderBy('name');

        if ($search) {
            $citiesQuery->where('name', 'like', '%' . $search . '%');
        }

        $cities = $citiesQuery->withCount(['posts'])->with(['state', 'country'])->orderBy('name') ->cursorPaginate(50);        
        
        $totalCitiesCount = City::count();

        return view('admin-pages.cities-index')->with(compact('title', 'cities', 'totalCitiesCount', 'search'));
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
            'name' => [
                'required',
                new UniqueCityNameInState($request->input('state_id')),
            ],          
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
    public function show(City $city)
    {   
        $title = 'Escorts in '.$city->name; 
        $city->loadCount(['posts']);            
        // $posts = $city->posts()->with('images')
        // ->orderBy('post_priority', 'desc')->orderBy('created_at', 'desc')->cursorPaginate(100); 
        $posts = $city->posts()->with('images')
        ->latest('post_priority')->latest('created_at')->cursorPaginate(50);

        return view('admin-pages.city-details')->with(compact('title', 'city', 'posts'));
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
            'name' => [
                'required',
                new UniqueCityNameInState($city->state_id,  $city->id),
            ],            
        ],
        [
            'name.required' => 'The city name field is required.',                       
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
    
    public function showPosts(City $city)
    {                
        $title = 'Escorts in '.$city->name;        
        $posts = $city->posts()->with('images')
        ->latest('post_priority')->latest('created_at')->cursorPaginate(50);
        $adverts = Advert::inRandomOrder()->take(3)->get();

        return view('pages.cities-posts', compact('title', 'city', 'posts', 'adverts'));
    }        

    public function viewPostDetails($slug)
    {
        $post = Post::where('slug', $slug)->with('country', 'state', 'city', 'gender', 'eye', 'ethnicity', 'hair')->firstOrFail();
        $title = str_limit(strip_tags($post->post_title), 50);
        return view('pages.post-details')->with(compact('post', 'title'));

    }

}