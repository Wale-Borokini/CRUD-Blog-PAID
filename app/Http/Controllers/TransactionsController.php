<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\User;
use Alert;
use Auth;

class TransactionsController extends Controller
{
 
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

    public function viewTransactionHistoryPage()
    {
        $title = 'All Transactions';
        $regularUsers = User::where('is_admin', 0)->pluck('id');

        $transactions = Transaction::whereIn('user_id', $regularUsers)->with(['creditedUser', 'performedByAdmin'])->orderBy('created_at', 'desc')->cursorPaginate(50);
        //$transactions = Transaction::with(['creditedUser', 'performedByAdmin'])->orderBy('created_at', 'desc')->cursorPaginate(50);
        $debitTotal = Transaction::whereIn('user_id', $regularUsers)->where('transaction_type', 'debit')->sum('transaction_amount');
        $creditTotal = Transaction::whereIn('user_id', $regularUsers)->where('transaction_type', 'credit')->sum('transaction_amount');
        
        return view('admin-pages.transaction-history')->with(compact('title', 'transactions', 'debitTotal', 'creditTotal'));
    }

}