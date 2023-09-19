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
                <h1>Page Logs ({{ $pageLogs->count() }})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Adnin Dashboard</a>                
            </div>
            <div class="text-center mt-1">                
                <a href="{{route('transaction-menu')}}" class="btn btn-outline-success btn-md">Transaction Menu</a>
            </div>  
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Copied Text?</th>
                                <th>Visit Time</th> 
                                <th>Details</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pageLogs as $pageLog)
                                <tr>
                                    <td>{{$pageLog->username}}</td>
                                    <td>{{$pageLog->email}}</td>	
                                    <td>
                                        @if ($pageLog->copied_text == 'Yes')
                                            <button class="btn btn-success btn-ellipse btn-xs" disabled>Yes</button>
                                        @elseif($pageLog->copied_text == 'No')
                                        <button class="btn btn-default btn-ellipse btn-xs" disabled>No</button>
                                        @endif
                                    </td>	
                                    <td>{{$pageLog->created_at->diffForHumans()}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('user-details', $pageLog->slug) }}">Details</a></td>
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->
@endsection