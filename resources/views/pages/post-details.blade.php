@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <div class="container">                
            <div class="product-single-container product-single-default mt-4 mb-2">                    
                <div class="row">
                   
                    <div class="col-lg-4 col-md-6 product-single-gallery">
                        @if ($post->images->count() > 0) 
                            <div class="product-slider-container">                             
                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    @foreach($post->images as  $postImage)
                                        <div class="product-item">
                                            <img style="max-height:600px;" class="product-single-image" src="{{asset($postImage->image_url)}}" width="468" height="468" alt="product" />
                                        </div>
                                    @endforeach
                                </div>                                                               
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                @foreach($post->images as  $postImage)
                                    <div class="owl-dot">
                                        <img style="height:100px;" src="{{asset($postImage->image_url)}}" width="100" height="100" alt="product-thumbnail" />
                                    </div>    
                                @endforeach                       
                            </div>
                        @elseif($post->images->count() < 1)
                            <h3 class="product-title"><i>No Images</i></h3> 
                        @endif  
                    </div>
                                    
                    <div class="col-lg-5 col-md-6 product-single-details">
                        <h1 class="product-title">{{$post->name}}</h1>                                                                                
                        <div class="price-box">                                
                            <a href="{{ route('city.show-posts', $post->city->slug) }}"><span class="new-price">{{$post->city->name}}, {{$post->state->name}}</span></a>
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
                                            <strong>Gender: </strong>{{$post->gender->name ?? 'N/A'}}
                                        </li>

                                        <li>
                                            <strong>Age: </strong>{{$post->age ?? 'N/A'}}
                                        </li>

                                        <li>
                                            <strong>Height:</strong> {{$post->height ?? 'N/A'}}
                                        </li>
                                        <li>
                                            <strong>Hair:</strong> {{$post->hair->name ?? 'N/A'}}
                                        </li>                                        
                                    </ul>
                                </div>  
                                <div class="col-lg-6">
                                    <ul class="single-info-list">
                                        <li>
                                            <strong>Eyes:</strong> {{$post->eye->name ?? 'N/A'}}
                                        </li>                                    
                                        <li>
                                            <strong>Ethnicity:</strong> {{$post->ethnicity->name ?? 'N/A'}}
                                        </li>
                                        <li>
                                            <strong>Availability:</strong> {{$post->availability ?? 'N/A'}}
                                        </li>                                        
                                    </ul>
                                </div>                                    
                            </div>                                                                              
                        </div>

                        <div class="price-box">
                            <h4 class="text-warning">{!! strip_tags($post->post_title) !!}</h4>
                            <p>
                                {!! $post->post_description ?? 'N/A' !!}
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
                            <button type="button" class="btn btn-dark">{{$post->phone_number ?? 'N/A'}}</button>
                        </div> 
                        <div class="mt-1">
                            <button type="button" class="btn btn-dark">{{$post->email ?? 'N/A'}}</button>
                        </div> 
                        <div class="mt-2">
                            <p> {{$post->address}}</p>
                        </div>                          
                        <div class="price-box mt-2">                                
                            <h3>Availability Details</h3>
                            <p>
                                {!! $post->availability_details ?? 'N/A' !!}
                            </p>
                        </div>
                        <div class="mt-3">                                                                
                            <p>Posted, {{$post->created_at->diffForHumans()}}</p>
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
       
