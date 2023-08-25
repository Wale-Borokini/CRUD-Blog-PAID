<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewAdminDashboardPage()
    {

        $title = 'Admin Dashboard';
               
        return view('admin-pages.admin-dashboard')->with(compact('title'));

    }    
    
    public function viewAddLocationsPage()
    {

        $title = 'Add Locations';
               
        return view('admin-pages.add-locations')->with(compact('title'));

    }

    public function viewpersonalAttributesPage()
    {

        $title = 'Personal Attributes';
               
        return view('admin-pages.personal-attributes')->with(compact('title'));

    }

}
