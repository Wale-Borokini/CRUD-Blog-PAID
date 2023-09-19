@extends('layouts.app')

@section('content')

<main class="min-height-page main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">					
            <h1>User Details</h1>
        </div>
        <div class="text-center mt-1">
            <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
        </div> 
        <div class="text-center mt-1">
            <a href="{{route('all-users')}}" class="btn btn-outline-info btn-md">All Users</a>                
        </div>              
    </div>
    <div class="container">                
        <div class="product-single-container product-single-default mt-4 mb-2">                    
            <div class="row">                        
                <div class="col-lg-12 col-md-6 product-single-details">
                    <div class="mt-2">
                        <h4>Username: <span class="bg-light">{{$user->username}}</span></h4>
                        <h4>Email: <span class="bg-light">{{$user->email}}</span></h4>
                    </div>
                    <div class="price-box">                                
                        <h2>Balance: ${{$user->credit_balance}}</h2>
                    </div>                                               
                    <hr class="short-divider">
                    <div class="mt-2">
                        <div class="mt-0">
                            <h3>Profile Summary</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="single-info-list">                                            
                                    <li>
                                        <strong>Number of Posts: </strong>{{$user->posts->count()}}
                                    </li> 
                                    <li>
                                        <strong>Joined, </strong>{{$user->created_at->diffForHumans()}}
                                    </li>                                            
                                </ul>
                                <div class="col-12 mt-2 mb-2">
                                    <a class="btn btn-info btn-lg" href="{{ route('users-posts', $user->slug) }}">View Posts</a>
                                </div>
                                <div class="col-12 mt-5 mb-2">
                                    <a class="btn btn-success btn-lg" href="{{ route('credit.cash', $user->slug) }}">Credit User</a>
                                </div>
                                <div class="col-12 mt-2 mb-2">
                                    <a class="btn btn-danger btn-lg" href="{{ route('debit.cash', $user->slug) }}">Debit User</a>
                                </div>
                            </div>                                                                       
                        </div>                                                                              
                    </div>                                                                                                   
                    <hr class="divider mb-0 mt-0">                                                       
                </div>                                                
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->                                              
    </div>
    <!-- End .container -->
</main>    
@endsection