<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eye;
use Auth;

class EyesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'name.required' => 'The Eyes field is required.', 
            'name.unique' => 'The Eyes color must be unique.'           
        ]);   

        $adminName = Auth::user()->username;
        $eye = new Eye;
        $eye->name = $request->name;
        $eye->added_by =   $adminName;    
        $eye->save();

        return redirect()->back()->with('success', 'Eye Color Added');
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
