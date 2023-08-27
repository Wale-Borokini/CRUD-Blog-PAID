<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ethnicity;
use Auth;
Use Alert;

class EthnicitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Ethnicities';
        $ethnicities = Ethnicity::orderBy('name')->get()->unique('name');

        return view('admin-pages.ethnicities-index')->with(compact('title', 'ethnicities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Ethnicity';        
        return view('admin-pages.create-ethnicity')->with(compact('title', ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:ethnicities,name'            
        ],
        [
            'name.required' => 'The Ethnicity field is required.', 
            'name.unique' => 'The Ethnicity must be unique.'           
        ]);   

        $adminName = Auth::user()->username;
        $ethnicity = new Ethnicity;
        $ethnicity->name = $request->name;
        $ethnicity->added_by =   $adminName;    
        $ethnicity->save();

        $alerted = Alert::success('Ethnicity Added', 'You have added a new ethnicity'); 

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
    public function edit(Ethnicity $ethnicity)
    {
        $title = 'Edit Ethnicity';
        return view('admin-pages.edit-ethnicity')->with(compact('title', 'ethnicity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ethnicity $ethnicity)
    {
        $this->validate($request, [
            'name' => 'required|unique:ethnicities,name'            
        ],
        [
            'name.required' => 'The ethnicity name field is required.', 
            'name.unique' => 'The ethnicity name must be unique.'           
        ]);   

       
        $ethnicity->name = $request->name;           
        $ethnicity->save();

        $alerted = Alert::success('Ethnicity Edited', 'The ethnicity has been edited'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ethnicity $ethnicity)
    {
        $ethnicity->delete();        
        $alerted = Alert::success('Ethnicity Deleted', 'The ethnicity has been deleted'); 
        return redirect()->back()->with('alerted');
    }

}