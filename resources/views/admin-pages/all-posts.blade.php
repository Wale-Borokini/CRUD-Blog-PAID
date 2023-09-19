@extends('layouts.app')

@section('content')    
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>All Posts ({{$posts->count()}})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>              
        </div>
        <div class="container">				
            <div class="row">
                <div class="col-lg-9 col-sm-6 pb-5 pb-md-0">                    
                    <div class="mt-2 text-center">
                        <h4 class="section-sub-title">All Posts</h4>
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
                                        <span class="mt-1">
                                            <i><small>Posted, {{$post->created_at->diffForHumans()}}</small></i> 
                                            {{$post->post_priority != 1 ? '(Promoted Post)' : ''}}
                                        </span>                                    
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>                   
                    @endforeach
                    {{ $posts->links() }}                                                                              
                </div>	                
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->    
@endsection
       
