@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Transaction History ({{ $transactions->count() }})</h1>
                <h5 class="bg-success text-white p-2">Credit Total: ${{ number_format($creditTotal, 2) }}</h5>
                <h5 class="bg-danger text-white p-2">Debit Total: ${{ number_format($debitTotal, 2) }}</h5>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>
            <div class="text-center mt-1">
                <a href="{{route('transaction-menu')}}" class="btn btn-outline-info btn-md">Transaction Menu</a>                
            </div>             
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">                			
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="{{ route('search-transactions') }}" method="GET">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search transactions...">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                            @if(isset($search))
                                <a href="{{ route('transaction-history') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                            @endif
                        </form>  
                    </div>  
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Type</th>                           
                                <th>Performed By</th> 
                                <th>Time</th>    
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td><strong>{{$transaction->creditedUser->username }}</strong></td>
                                    <td>{{$transaction->email}}</td>	
                                    <td>{{$transaction->transaction_amount}}</td>
                                    <td>
                                        @if($transaction->transaction_type == 'credit')
                                            <button class="btn btn-success btn-ellipse btn-xs" disabled>Credit</button>
                                        @elseif($transaction->transaction_type == 'debit')
                                            <button class="btn btn-danger btn-ellipse btn-xs" disabled>Debit</button>
                                        @endif
                                    </td>
                                    <td>{{$transaction->performedByAdmin->username}}</td>	   
                                    <td>{{$transaction->created_at->diffForHumans()}}</td>
                                                                  								                                                                                           
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                    {{ $transactions->links() }} 
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->

@endsection