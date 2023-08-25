<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userPosts = auth()->user()->posts;
        return view('pages.profile', compact('userPosts'));
    }

    public function viewBuyCreditsCodePage()
    {

        $title = 'Buy Credits Code';
               
        return view('pages.buy-credits-code')->with(compact('title'));

    }

    public function viewBuyCreditsPage()
    {

        $title = 'Buy Credits';
               
        return view('pages.buy-credits')->with(compact('title'));

    }
    
}
