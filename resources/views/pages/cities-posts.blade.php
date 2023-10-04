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
                                            <img style="max-height:60px; width:60px;" src="{{asset('storage/images/no-image.jpg')}}" alt="no-image">
                                        @endif                                        
                                    </figure>
                                    <div>
                                        <strong class="testimonial-title">{{str_limit(strip_tags($post->post_title), 30)}}</strong>
                                        <span>{{str_limit(strip_tags($post->post_description), 30)}}</span>       
                                        @if($post->post_priority == 1)                                 
                                            <span class="mt-1"><i><small>Posted, {{$post->created_at->diffForHumans()}}</small></i></span>
                                        @else
                                            <span class="d-inline"><i class="icon-star"></i></span>
                                            <span class="d-inline"><i class="icon-star"></i></span>
                                            <span class="d-inline"><i class="icon-star"></i></span>
                                        @endif
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
                                @foreach($adverts as $advert)
                                    <li>
                                        <div class="post-media">
                                            <a href="{{ $advert->advert_url }}" target="_blank">
                                                <img style="height:50px;" src="{{ asset($advert->image_url) }}" alt="Post">
                                            </a>
                                        </div><!-- End .post-media -->
                                        <div class="post-info">
                                            <a href="{{ $advert->advert_url }}" target="_blank">{{ $advert->title }}</a>
                                            <div class="post-meta">
                                                {{ $advert->description }}
                                            </div><!-- End .post-meta -->
                                        </div><!-- End .post-info -->
                                    </li>   
                                @endforeach
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
       
