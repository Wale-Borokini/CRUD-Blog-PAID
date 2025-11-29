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
        $user = auth()->user();
    
        // Check if the user has posts
        if ($user->posts->count() > 0) {
            $userPosts = $user->posts()->with('images')->orderBy('created_at', 'desc')->cursorPaginate(50);
        } else {
            // User has no posts, so no need to execute the query
            $userPosts = collect();
        }
        
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
