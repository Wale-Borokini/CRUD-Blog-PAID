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
                <h1>City Details</h1>
            </div><div class="text-center mt-1">
                <a href="{{route('add-locations')}}" class="btn btn-outline-dark btn-md">Locations</a>                
            </div>
            <div class="text-center mt-2">
                <a href="{{route('cities.index')}}" class="btn btn-outline-success btn-md">All Cities</a>
            </div> 
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-md-12">
                    <div class="mt-3">
                        <h3>Posts in {{$city->name}}, {{$city->state->name}}, {{$city->country->name}}</h3>
                        <h5>Number of Posts ({{$city->posts->count()}})</h5>
                    </div>
                    @foreach ($city->posts as $post)
                    <div class="product-reviews-content">
                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    @if ($post->images->count() > 0) 
                                        <img src="{{asset( $post->images->first()->image_url )}}" alt="author" width="80" height="80">
                                    @endif
                                    </figure>                               
                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        {{-- <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div> --}}

                                        <span class="comment-by">
                                            <strong>{{$post->post_title}}</strong>
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>{{$post->post_description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>City</th> 
                                <th>State</th> 
                                <th>Country</th>                                                               
                                <th>Post Count</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        {{-- <tbody> 
                            @foreach($city->posts as $cityPosts)                          
                                <tr>
                                    <td><strong>{{$cityPosts->name}}</strong></td>
                                    <td>{{$cityPosts->name}}</td>                                     
                                    <td>{{$cityPosts->country->name}}</td>                                     
                                    <td>{{$cityPosts->posts->count()}}</td>
                                    <td><a class="btn btn-success btn-sm" href="#">Details</a></td>                          	                                                   
                                </tr>
                            @endforeach                                  
                        </tbody> --}}
                    </table> --}}
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->
@endsection