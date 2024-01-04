<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hair;
use Auth;
use Alert;

class HairsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Hair Colors';
        $hairs = Hair::orderBy('name')->get()->unique('name');
        return view('admin-pages.hairs-index')->with(compact('title', 'hairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Hair';        
        return view('admin-pages.create-hair')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:hairs,name'            
        ],
        [
            'name.required' => 'The hair field is required.', 
            'name.unique' => 'The hair type must be unique.'           
        ]);   

        $adminName = Auth::user()->username;
        $hair = new Hair;
        $hair->name = $request->name;
        $hair->added_by =   $adminName;    
        $hair->save();

        $alerted = Alert::success('Hair Color Added', 'You have added a new hair color'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hair $hair)
    {
        $title = 'Edit Hair Color';
        return view('admin-pages.edit-hair')->with(compact('title', 'hair'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hair $hair)
    {
        $this->validate($request, [
            'name' => 'required|unique:hairs,name'            
        ],
        [
            'name.required' => 'The hair name field is required.', 
            'name.unique' => 'The hair color must be unique.'           
        ]);   

       
        $hair->name = $request->name;           
        $hair->save();

        $alerted = Alert::success('Hair Color Edited', 'The hair color has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hair $hair)
    {
        $hair->delete();
        $alerted = Alert::success('Hair Color Deleted', 'The Hair color has been deleted'); 
        return redirect()->back()->with('alerted');
    }
}