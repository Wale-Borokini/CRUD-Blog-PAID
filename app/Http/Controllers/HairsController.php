<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hair;
use Auth;

class HairsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
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

        return redirect()->back()->with('success', 'Hair Created');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
