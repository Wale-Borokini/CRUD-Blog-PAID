<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\Pagelog;
use App\Models\Transaction;
use Alert;
use Auth;

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

    public function viewPersonalAttributesPage()
    {
        $title = 'Personal Attributes';          
        return view('admin-pages.personal-attributes')->with(compact('title'));
    }
    
    public function viewTransactionMenuPage()
    {
        $title = 'Transaction Menu';          
        return view('admin-pages.transaction-menu')->with(compact('title'));
    }

    public function viewAllUsersPage()
    {
        $title = 'All Users';   
        $users = User::orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('admin-pages.all-users')->with(compact('title', 'users'));
    }

    public function searchUsers(Request $request)
    {
        $title = 'Search Results';
        $searchTerm = $request->input('search');

        // Query the users table to search for users
        $users = User::where('username', 'LIKE', "%$searchTerm%")
        ->orWhere('email', 'LIKE', "%$searchTerm%")
        ->orWhere('credit_balance', 'LIKE', "%$searchTerm%")
        ->paginate(50);

        return view('admin-pages.all-users')->with(compact('title', 'users', 'searchTerm'));
    }

    public function viewAdminRoles()
    {
        $title = 'Admin Roles';   
        $users = User::orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('admin-pages.admin-roles')->with(compact('title', 'users'));
    }

    public function updateAdminRole(Request $request, User $user)
    {
        $user->update([
            'is_admin' => $request->input('is_admin'),
        ]);

        $alerted = Alert::success('Admin Role Given', 'You have given this user a new role'); 
        return redirect()->back()->with('alerted');
    }

    public function viewUsersPosts(string $slug)
    {
        $title = 'Users Posts';   
        $user = User::where('slug', $slug)->with('posts')->firstOrFail();        
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('admin-pages.users-posts')->with(compact('title', 'userPosts'));
    }

    public function viewAllPosts()
    {
        $title = 'All Posts';
        $posts = Post::orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('admin-pages.all-posts')->with(compact('title', 'posts'));
    }

    public function viewUserDetailsPage(string $slug)
    {
        $title = 'User Details';   
        $user = User::where('slug', $slug)->withCount(['posts'])->firstOrFail();
        return view('admin-pages.user-details')->with(compact('title', 'user'));
    }

    public function logPageVisit(Request $request)
    {
        // Get the user details
        $user = auth()->user();
        // Create a new page log entry
        $pageLog = new Pagelog([
            'user_id' => $user->id,
            'slug' => $user->slug,
            'username' => $user->username,
            'email' => $user->email,
            'copied_text' => $request->input('copied_text'),
            'visited_at' => now(),
        ]);
        // Save the page log entry
        $pageLog->save();

        return response()->json(['message' => 'Page visit logged successfully']);
    }

    public function viewBuyCreditsPageLogs()
    {
        $title = 'Buy Credits Page Logs';
        $pageLogs = Pagelog::orderBy('created_at', 'desc')->cursorPaginate(50);
               
        return view('admin-pages.buy-credits-page-logs')->with(compact('title', 'pageLogs'));

    }
    

}