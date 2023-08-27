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
                <h1>State Details</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('add-locations')}}" class="btn btn-outline-dark btn-md">Locations</a>                
            </div>
            <div class="text-center mt-2">
                <a href="{{route('states.index')}}" class="btn btn-outline-success btn-md">All States</a>
            </div> 
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-md-12">
                    <div class="mt-3">
                        <h3>Cities in {{$state->name}}</h3>
                    </div>
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>City</th> 
                                <th>State</th> 
                                <th>Country</th>                                                               
                                <th>Post Count</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($state->cities as $stateCity)                          
                                <tr>
                                    <td><strong>{{$stateCity->name}}</strong></td>
                                    <td>{{$state->name}}</td>                                     
                                    <td>{{$state->country->name}}</td>                                     
                                    <td>{{$stateCity->posts->count()}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('cities.show', $stateCity->slug) }}">Details</a></td>                          	                                                   
                                </tr>
                            @endforeach                                  
                        </tbody>
                    </table>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->
@endsection