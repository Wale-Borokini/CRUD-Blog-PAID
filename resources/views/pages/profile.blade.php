@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">                
                <h1>My Profile</h1>
                <p>Hi, {{Auth::user()->username}}</p>
            </div>
        </div>
        
        <div class="container">				
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-widgets-container row pb-2 mt-4">									
                        <div class="col-lg-12 col-sm-6 pb-5 pb-md-0">
                            <h4 class="section-sub-title">Posts</h4>
                            @foreach ($userPosts as $post)
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        @if ($post->images->count() > 0)                                
                                            <img src="{{asset( $post->images->first()->image_url )}}" width="74" height="74" alt="product">                                    
                                        @endif
                                    </figure>

                                    <div class="product-details">
                                        <h5 class=""> <a href="{{ route('post-details', $post->slug) }}">{{$post->post_title}}</a>
                                        </h5>										

                                        <div class="price-box">
                                            <p>{{$post->post_description}}</p>
                                        </div>
                                        <!-- End .price-box -->
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            @endforeach  
                                                        
                        </div>									
                    </div>
                </div><!-- End .col-lg-8 -->					
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
       
