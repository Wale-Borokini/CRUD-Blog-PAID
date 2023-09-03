@extends('layouts.app')

@section('content')    
    <main class="min-height-page main">
        <div class="container">				
            <div class="row">
                <div class="col-lg-9 col-sm-6 pb-5 pb-md-0">
                    <nav class="toolbox sticky-header mt-3">                                                  
                        <div class="toolbox-item toolbox-sort">                                
                            <div class="select-custom">
                                <select id="cityDropdown" name="city" class="form-control">
                                    <option value="{{$city->slug}}" selected="selected">{{$city->name}}</option>
                                    @foreach ($city->siblingCities->sortBy('name') as $siblingCity)
                                        <option value="{{$siblingCity->slug}}">{{$siblingCity->name}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                            <div class="ml-3">
                                <a href="{{route('index')}}" class="btn btn-outline-dark btn-sm">All States</a>
                            </div>                          
                        </div>                                                                                                   
                    </nav>
                    <div class="mt-2 text-center">
                        <h4 class="section-sub-title">Escorts in {{$city->name}}, {{$city->state->name}}</h4>
                    </div>
                    @foreach ($posts as $post)
                        <div class="col-12">
                            <div class="testimonial testimonial-border testimonial-type4">     
                                <a href="{{ route('post-details', $post->slug) }}">                       
                                <div class="testimonial-owner">
                                    <figure class="max-width-none">
                                        @if ($post->images->count() > 0) 
                                            <img style="max-height:60px; width:60px;" src="{{asset( $post->images->first()->image_url )}}" alt="post_image">
                                        @elseif($post->images->count() < 1) 
                                            <img style="max-height:60px; width:60px;" src="{{asset('images/no-image.jpg')}}" alt="no-image">
                                        @endif
                                    </figure>
                                    <div>
                                        <strong class="testimonial-title">{{str_limit(strip_tags($post->post_title), 30)}}</strong>
                                        <span>{{str_limit(strip_tags($post->post_description), 30)}}</span>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>                   
                    @endforeach
                    {{ $posts->links() }}                                                                              
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cityDropdown = document.getElementById('cityDropdown');
    
            cityDropdown.addEventListener('change', function() {
                var selectedCitySlug = this.value;
                window.location.href = '/city/' + selectedCitySlug; // Change the URL as needed
            });
        });
    </script>
@endsection
       
