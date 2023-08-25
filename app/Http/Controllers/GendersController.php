<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use Auth;
use Alert;

class GendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Genders';
        $genders = Gender::orderBy('name')->get()->unique('name');

        return view('admin-pages.genders-index')->with(compact('title', 'genders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Gender';        
        return view('admin-pages.create-gender')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:genders,name'            
        ],
        [
            'name.required' => 'The Gender field is required.', 
            'name.unique' => 'The gender must be unique.'           
        ]);   

        $adminName = Auth::user()->username;
        $gender = new Gender;
        $gender->name = $request->name;
        $gender->added_by =   $adminName;    
        $gender->save();

        $alerted = Alert::success('Gender Added', 'You have added a new gender'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gender $gender)
    {
        $title = 'Edit Gender';
        return view('admin-pages.edit-gender')->with(compact('title', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $gender)
    {
        $this->validate($request, [
            'name' => 'required|unique:genders,name'            
        ],
        [
            'name.required' => 'The gender name field is required.', 
            'name.unique' => 'The gender name must be unique.'           
        ]);   

       
        $gender->name = $request->name;           
        $gender->save();

        $alerted = Alert::success('Gender Edited', 'The gender has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender)
    {
        $gender->delete();        
        $alerted = Alert::success('Gender Deleted', 'The gender has been deleted'); 
        return redirect()->back()->with('alerted');
    }
}
