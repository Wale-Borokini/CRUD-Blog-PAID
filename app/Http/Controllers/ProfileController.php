<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pagelog;
use App\Models\Walletadress;

class ProfileController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userPosts = auth()->user()->posts()->orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('pages.profile', compact('userPosts'));
    }

    public function viewBuyCreditsCodePage()
    {

        $title = 'Buy Credits Code';
        $wallet = Walletadress::where('title', 'Post')->first();
               
        return view('pages.buy-credits-code')->with(compact('title', 'wallet'));

    }

    public function viewBuyCreditsPage()
    {

        $title = 'Buy Credits';
               
        return view('pages.buy-credits')->with(compact('title'));

    }

   
}
