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
                <h1>Country Details</h1>
            </div>
            <div class="text-center mt-2">
                <a href="{{route('countries.index')}}" class="btn btn-outline-success btn-md">All Countries</a>
            </div> 
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-md-12">
                    <div class="mt-3">
                        <h3>States in {{$country->name}}</h3>
                    </div>
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>State</th>                                
                                <th>City Count</th>
                                <th>Post Count</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($country->states as $countryState)                          
                                <tr>
                                    <td>{{$countryState->name}}</td> 
                                    <td>{{ $countryState->cities->count() }}</td> 
                                    <td>{{$countryState->posts->count()}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('states.show', $countryState->slug) }}">Details</a></td>                          	                                                   
                                </tr>
                            @endforeach                                  
                        </tbody>
                    </table>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->
@endsection