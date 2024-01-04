<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class PagesController extends Controller
{

    public function viewIndexPage()
    {
        $title = 'Patron Castle!';
        $unitedStates = Country::where('name', 'United States')->with('states.cities')->first();               
        return view('pages.index')->with(compact('title', 'unitedStates'));
    }

    public function viewPrivacyPage()
    {
        $title = 'Patron Castle';                       
        return view('pages.privacy')->with(compact('title'));
    }
    
    public function viewTermsPage()
    {
        $title = 'Patron Castle';                       
        return view('pages.terms')->with(compact('title'));
    }
    
    public function viewReportCasePage()
    {
        $title = 'Patron Castle';                       
        return view('pages.report-case')->with(compact('title'));
    }

}