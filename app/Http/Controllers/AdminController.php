<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
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

    public function viewUserDetailsPage(string $slug)
    {

        $title = 'User Details';
        
        $user = User::where('slug', $slug)->withCount(['posts'])->firstOrFail();
               
        return view('admin-pages.user-details')->with(compact('title', 'user'));

    }

    public function viewCreditUserPage()
    {

        $title = 'Credit Users';
        
        $users = User::orderBy('created_at', 'desc')->cursorPaginate(50);
               
        return view('admin-pages.credit-user')->with(compact('title', 'users'));

    }

    public function viewDebitUserPage()
    {

        $title = 'Debit Users';
        
        $users = User::orderBy('created_at', 'desc')->cursorPaginate(50);
               
        return view('admin-pages.debit-user')->with(compact('title', 'users'));

    }
    
    public function creditUserCashPage(string $slug)
    {

        $title = 'Credit User';
        
        $user = User::where('slug', $slug)->withCount(['posts'])->firstOrFail();
               
        return view('admin-pages.credit-user-cash')->with(compact('title', 'user'));

    }

    public function debitUserCashPage(string $slug)
    {

        $title = 'Debit User';
        
        $user = User::where('slug', $slug)->withCount(['posts'])->firstOrFail();
               
        return view('admin-pages.debit-user-cash')->with(compact('title', 'user'));

    }

    public function creditUserTransaction(Request $request, User $user)
    {
        $this->validate($request, [
            'amount' => 'required'            
        ]); 

        $amount = $request->amount;
        $userId = $user->id;
        $userEmail = $user->email;
        $adminId = Auth::user()->id;
        
        $user->credit_balance += $amount;
        $user->save();

        $transaction = new Transaction([
            'user_id' => $userId,
            'email' => $userEmail,
            'transaction_amount' => $amount,
            'transaction_type' => 'credit',
            'performed_by' => $adminId,
        ]);
        $transaction->save();

        $alerted = Alert::success('Transaction Successful', 'You have credited this user'); 

        return redirect()->back()->with('alerted');

    }

    public function debitUserTransaction(Request $request, User $user)
    {
        $this->validate($request, [
            'amount' => 'required'            
        ]); 

        $amount = $request->amount;
        $userId = $user->id;
        $userEmail = $user->email;
        $adminId = Auth::user()->id;
        
        $user->credit_balance -= $amount;
        $user->save();

        $transaction = new Transaction([
            'user_id' => $userId,
            'email' => $userEmail,
            'transaction_amount' => $amount,
            'transaction_type' => 'debit',
            'performed_by' => $adminId,
        ]);
        $transaction->save();

        $alerted = Alert::success('Debit Successful', 'You have Debited this user'); 

        return redirect()->back()->with('alerted');
       

    }

}
