<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Auth;
use Alert;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'All Posting Plans';
        $plans = Plan::orderBy('price')->get()->unique('plan_type');
        return view('admin-pages.plans-index')->with(compact('title', 'plans'));
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

        $this->validate($request, [
            'plan_type' => 'required|unique:plans,plan_type',
            'plan_title' => 'required',
            'price' => 'required',
            'priority' => 'required',
            'duration' => 'required',
            'description' => 'required',
                          
        ]);   

        $adminName = Auth::user()->username;
        $formattedPrice = number_format($request->input('price'), 2, '.', '');        

        $plan = new Plan;
        $plan->price = $formattedPrice;
        $plan->plan_type = $request->plan_type;
        $plan->priority = $request->priority;
        $plan->duration = $request->duration;
        $plan->plan_title = $request->plan_title;
        $plan->description = $request->description;
        $plan->added_by =   $adminName;    
        $plan->save();

        $alerted = Alert::success('Plan Added', 'You have added a new posting plan'); 

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
    public function edit(Plan $plan)
    {
        $title = 'Edit Plan';
        return view('admin-pages.edit-plan-types')->with(compact('title', 'plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $this->validate($request, [
            'plan_type' => 'required|unique:plans,plan_type',
            'plan_title' => 'required',
            'priority' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'description' => 'required',
                          
        ]);  

        $formattedPrice = number_format($request->input('price'), 2, '.', '');   
        
        $plan->plan_type = $request->plan_type;
        $plan->priority = $request->priority;
        $plan->plan_title = $request->plan_title;
        $plan->price = $formattedPrice;
        $plan->duration = $request->duration;
        $plan->description = $request->description;           
        $plan->save();

        $alerted = Alert::success('Plan Edited', 'You have Edited this posting plan'); 

        return redirect()->back()->with('alerted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        $alerted = Alert::success('Plan Deleted', 'The plan has been deleted'); 
        return redirect()->back()->with('alerted');
    }
}