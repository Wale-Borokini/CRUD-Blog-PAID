@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <div class="container">                
            <div class="product-single-container product-single-default mt-4 mb-2">                    
                <div class="row">
                    <div class="col-lg-4 col-md-6 product-single-gallery">
                        <div class="product-slider-container">                             
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach($post->images as  $postImage)
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{asset($postImage->image_url)}}" width="468" height="468" alt="product" />
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .product-single-carousel -->
                            
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            @foreach($post->images as  $postImage)
                                <div class="owl-dot">
                                    <img src="{{asset($postImage->image_url)}}" width="110" height="110" alt="product-thumbnail" />
                                </div>    
                            @endforeach                       
                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-5 col-md-6 product-single-details">
                        <h1 class="product-title">{{$post->name}}</h1>                                                                                
                        <div class="price-box">                                
                            <span class="new-price">{{$post->city->name}}, {{$post->state->name}}</span>
                        </div>
                        <hr class="short-divider">
                        <div class="mt-2">
                            <div class="mt-0">
                                <h3 class="">Profile Summary</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="single-info-list">                                            
                                        <li>
                                            <strong>Gender: </strong>{{$post->gender->name}}
                                        </li>

                                        <li>
                                            <strong>Age: </strong>{{$post->age}}
                                        </li>

                                        <li>
                                            <strong>Height:</strong> {{$post->height}}
                                        </li>
                                        <li>
                                            <strong>Hair:</strong> {{$post->hair->name}}
                                        </li>                                        
                                    </ul>
                                </div>  
                                <div class="col-lg-6">
                                    <ul class="single-info-list">
                                        <li>
                                            <strong>Eyes:</strong> {{$post->eye->name}}
                                        </li>                                    
                                        <li>
                                            <strong>Ethnicity:</strong> {{$post->ethnicity->name}}
                                        </li>
                                        <li>
                                            <strong>Availability:</strong> {{$post->availability}}
                                        </li>                                        
                                    </ul>
                                </div>                                    
                            </div>                                                                              
                        </div>

                        <div class="product-desc">
                            <p>
                                {{$post->post_description}}
                            </p>
                        </div>
                        <!-- End .product-desc -->                                                 
                        <hr class="divider mb-0 mt-0">                                    
                    </div>

                    <div class="col-lg-3">
                        <div class="price-box">                                
                            <h3>Contact</h3>
                        </div>
                        <div class="mt-1">
                            <button type="button" class="btn btn-dark">{{$post->phone_number}}</button>
                        </div> 
                        <div class="mt-1">
                            <button type="button" class="btn btn-dark">{{$post->email}}</button>
                        </div> 
                        <div class="mt-2">
                            <p> {{$post->address}}</p>
                        </div>                          
                        <div class="price-box mt-2">                                
                            <h3>Availability Details</h3>
                            <p>{{$post->availability_details}}</p>
                        </div>
                        <div class="mt-3">                                                                
                            <p>Posted on 24-09-2022</p>
                        </div>                 
                    </div> 
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->                                              
        </div>
        <!-- End .container -->
    </main>
@endsection
       
