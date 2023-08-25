<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Auth;

class PlansController extends Controller
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
        $title = 'Add Posting Plan';        
        return view('admin-pages.create-plan-types')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adminName = Auth::user()->username;
        $formattedPrice = number_format($request->input('price'), 2, '.', '');
        $plan_type = $request->plan_type;
        $plan_title = $request->plan_title;
        $description = $request->description;

        $plan = new Plan;
        $plan->price = $formattedPrice;
        $plan->plan_type = $plan_type;
        $plan->plan_title = $plan_title;
        $plan->description = $description;
        $plan->added_by =   $adminName;    
        $plan->save();

        return redirect()->back()->with('success', 'Posting Plan Created');

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
