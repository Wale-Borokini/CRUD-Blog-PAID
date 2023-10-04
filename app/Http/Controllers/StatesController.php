<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueStateNameInCountry;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Auth;
Use Alert;


class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All States';
        $states = State::orderBy('name')->withCount(['cities', 'posts'])->cursorPaginate(50);
        $totalStateCount = State::count();

        return view('admin-pages.states-index')->with(compact('title', 'states', 'totalStateCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add State';
        $countries = Country::orderBy('name')->get();
               
        return view('admin-pages.create-states')->with(compact('title', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'country_id' => 'required',
            'name' => [
                'required',
                new UniqueStateNameInCountry($request->input('country_id')),
            ],             
        ],
        [
            'country_id.required' => 'The Country field is required.',
            'name.required' => 'The State name field is required.',                                  
        ]);   

        $adminName = Auth::user()->username;
        $state = new State;
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->added_by =   $adminName;    
        $state->save();

        $alerted = Alert::success('State Added', 'You have added a new state'); 

        return redirect()->back()->with('success', 'alerted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $state = State::where('slug', $slug)->with(['cities.posts', 'country'])->firstOrFail();

        return view('admin-pages.state-details')->with(compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $title = 'Edit State';
        return view('admin-pages.edit-state')->with(compact('title', 'state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'name' => [
                'required',
                new UniqueStateNameInCountry($state->country_id, $state->id),
            ],               
        ],
        [
            'name.required' => 'The state name field is required.',             
        ]);   

       
        $state->name = $request->name;           
        $state->save();

        $alerted = Alert::success('State Edited', 'The state has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();
        $alerted = Alert::success('State Deleted', 'The state has been deleted'); 
        return redirect()->back()->with('alerted');
    }
}
