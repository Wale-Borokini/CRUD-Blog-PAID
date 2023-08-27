<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eye;
use Auth;
use Alert;

class EyesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Eye Color';
        $eyes = Eye::orderBy('name')->get()->unique('name');

        return view('admin-pages.eyes-index')->with(compact('title', 'eyes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Eye Color';        
        return view('admin-pages.create-eye')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:eyes,name'            
        ],
        [
            'name.required' => 'The Eye color field is required.', 
            'name.unique' => 'The Eye color must be unique.'           
        ]);   

        $adminName = Auth::user()->username;
        $eye = new Eye;
        $eye->name = $request->name;
        $eye->added_by =   $adminName;    
        $eye->save();

        $alerted = Alert::success('Eye Color Added', 'You have added a new eye color'); 

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
    public function edit(Eye $eye)
    {
        $title = 'Edit Eye';
        return view('admin-pages.edit-eye')->with(compact('title', 'eye'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eye $eye)
    {
        $this->validate($request, [
            'name' => 'required|unique:eyes,name'            
        ],
        [
            'name.required' => 'The eye color field is required.', 
            'name.unique' => 'The eye color must be unique.'           
        ]);   

       
        $eye->name = $request->name;           
        $eye->save();

        $alerted = Alert::success('Eye Color Edited', 'The eye color has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eye $eye)
    {
        $eye->delete();        
        $alerted = Alert::success('Eye color Deleted', 'The eye color has been deleted'); 
        return redirect()->back()->with('alerted');
    }
}
