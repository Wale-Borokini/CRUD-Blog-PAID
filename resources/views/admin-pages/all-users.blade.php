@extends('layouts.app')

@section('content')
<style>
    .feature-box-link {
    display: block;
    /* Add more styling properties to customize the appearance */
}
</style>
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>All Users ({{$users->count()}})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>              
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="{{ route('search-users') }}" method="GET">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search users...">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                            @if(isset($searchTerm))
                                <a href="{{ route('all-users') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                            @endif
                        </form>                        
                    </div>
                                        
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Credit Balance</th>
                                <th>Admin</th>                                
                                <th>Details</th>
                                <th>Date Joined</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><strong>{{$user->username}}</strong></td>
                                    <td>{{$user->email}}</td>	
                                    <td>{{$user->credit_balance}}</td>	
                                    <td>
                                        @if ($user->is_admin)
                                            <button class="btn btn-success btn-ellipse btn-xs" disabled>Yes</button>
                                        @else
                                        <button class="btn btn-default btn-ellipse btn-xs" disabled>No</button>
                                        @endif
                                    </td>									                                    
                                    <td><a class="btn btn-success btn-sm" href="{{ route('user-details', $user->slug) }}">Details</a></td> 
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                    {{ $users->links() }} 
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->

@endsection