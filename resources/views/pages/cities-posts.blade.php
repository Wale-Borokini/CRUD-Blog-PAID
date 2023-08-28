@extends('layouts.app')

@section('content')    
    <main class="min-height-page main">
        <div class="container">				
            <div class="row">
                <div class="col-lg-9 col-sm-6 pb-5 pb-md-0">

                    <div class="mt-2 text-center">
                        <h4 class="section-sub-title">Posts</h4>
                    </div>
                    @foreach ($city->posts as $post)
                    <div class="col-12">
                        <div class="testimonial testimonial-border testimonial-type4">     
                            <a href="{{ route('post-details', $post->slug) }}">                       
                            <div class="testimonial-owner">
                                <figure class="max-width-none">
                                    @if ($post->images->count() > 0) 
                                        <img src="{{asset( $post->images->first()->image_url )}}" alt="post_image" width="40" height="40">
                                    @endif
                                </figure>
                                <div>
                                    <strong class="testimonial-title">{{$post->post_title}}</strong>
                                    <span>{{str_limit(strip_tags($post->post_description), 30)}}</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>


                    {{-- <div class="product-reviews-content">
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
{{-- 
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
                    </div> --}} 
                    @endforeach
                    
                        {{-- <div class="product-default left-details product-widget">
                            <figure>
                                @if ($post->images->count() > 0)                                
                                    <img src="{{asset( $post->images->first()->image_url )}}" width="74" height="74" alt="product">                                    
                                @endif
                            </figure>

                            <div class="product-details">
                                <h5 class=""> <a href="{{ route('postDetails', $post->slug) }}">{{$post->post_title}}</a>
                                </h5>										

                                <div class="price-box">
                                    <p>{{$post->post_description}}</p>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div> --}}
                                     
                </div>	

                <aside class="sidebar mobile-sidebar col-lg-3">
                    <div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>							
                        <div class="widget mt-4">								
                            <ul class="simple-post-list">
                                <li>
                                    <div class="post-media">
                                        <a href="single.html">
                                            <img src="assets/images/blog/widget/post-1.jpg" alt="Post">
                                        </a>
                                    </div><!-- End .post-media -->
                                    <div class="post-info">
                                        <a href="single.html">Post Format - Video</a>
                                        <div class="post-meta">
                                            April 08, 2018
                                        </div><!-- End .post-meta -->
                                    </div><!-- End .post-info -->
                                </li>

                                <li>
                                    <div class="post-media">
                                        <a href="single.html">
                                            <img src="assets/images/blog/widget/post-2.jpg" alt="Post">
                                        </a>
                                    </div><!-- End .post-media -->
                                    <div class="post-info">
                                        <a href="single.html">Post Format - Image</a>
                                        <div class="post-meta">
                                            March 23, 2016
                                        </div><!-- End .post-meta -->
                                    </div><!-- End .post-info -->
                                </li>
                            </ul>
                        </div><!-- End .widget -->							
                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
       
