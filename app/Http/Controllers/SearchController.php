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

class SearchController extends Controller
{

    public function searchUsers(Request $request)
    {
        return $this->searchUsersCommon($request, 'admin-pages.all-users');
    }

    public function searchUsersRoles(Request $request)
    {
        return $this->searchUsersCommon($request, 'admin-pages.admin-roles');
    }

    public function creditUsersSearch(Request $request)
    {
        return $this->searchUsersCommon($request, 'admin-pages.credit-user');
    }

    public function debitUsersSearch(Request $request)
    {
        return $this->searchUsersCommon($request, 'admin-pages.debit-user');
    }

    public function searchTransactions(Request $request)
    {
        $title = 'Search Transactions';
        $regularUsers = User::where('is_admin', 0)->pluck('id');

        $search = $request->input('search');

        $transactions = Transaction::whereIn('user_id', $regularUsers)
            ->with(['creditedUser', 'performedByAdmin'])
            ->where(function ($query) use ($search) {
                $query->where('email', 'LIKE', "%$search%")
                    ->orWhere('transaction_type', 'LIKE', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->cursorPaginate(50);

        $debitTotal = Transaction::whereIn('user_id', $regularUsers)
            ->where('transaction_type', 'debit')
            ->sum('transaction_amount');
        $creditTotal = Transaction::whereIn('user_id', $regularUsers)
            ->where('transaction_type', 'credit')
            ->sum('transaction_amount');

        return view('admin-pages.transaction-history')
            ->with(compact('title', 'transactions', 'debitTotal', 'creditTotal', 'search'));
    }

    public function searchPageLogs(Request $request)
    {
        $title = 'Search Page Logs';

        $search = $request->input('search');

        $pageLogs = Pagelog::where(function ($query) use ($search) {
            $query->where('username', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('copied_text', 'LIKE', "%$search%");
        })
        ->orderBy('created_at', 'desc')
        ->cursorPaginate(50);

        return view('admin-pages.buy-credits-page-logs')
            ->with(compact('title', 'pageLogs', 'search'));
    }

    public function searchPosts(Request $request)
    {
        $title = 'Search Posts';

        $search = $request->input('search');

        $posts = Post::where(function ($query) use ($search) {
            $query->where('post_title', 'LIKE', "%$search%")
                ->orWhere('post_description', 'LIKE', "%$search%")
                ->orWhere('height', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");                
        })
        ->orderBy('created_at', 'desc')->cursorPaginate(50);

        return view('admin-pages.all-posts')->with(compact('title', 'posts', 'search'));
    }

    private function searchUsersCommon(Request $request, $viewName)
    {
        $title = 'Search Results';
        $searchTerm = $request->input('search');

        // Query the users table to search for users
        $users = User::where('username', 'LIKE', "%$searchTerm%")
            ->orWhere('email', 'LIKE', "%$searchTerm%")
            ->orWhere('credit_balance', 'LIKE', "%$searchTerm%")
            ->paginate(50);

        return view($viewName)->with(compact('title', 'users', 'searchTerm'));
    }
}