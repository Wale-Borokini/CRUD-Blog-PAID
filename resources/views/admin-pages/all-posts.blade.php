@extends('layouts.app')

@section('content')    
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                @if(!isset($search))
                    <h1>All Posts ({{$totalPostsCount}})</h1>
                @else
                    <h1>All Posts ({{$posts->count()}})</h1>
                @endif
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
                    <div class="col-lg-3">
                        <form action="{{ route('all-posts') }}" method="GET">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search posts...">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                            @if(isset($searchQuery))
                                <a href="{{ route('all-posts') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                            @endif
                        </form>  
                    </div> 
                    @foreach ($posts as $post)
                        <div class="col-12">                             
                            <div class="testimonial testimonial-border testimonial-type4">     
                                <a href="{{ route('post-details', $post->slug) }}" target="_blank">                       
                                    <div class="testimonial-owner">
                                        <figure class="max-width-none">
                                            @if ($post->images->count() > 0)
                                            <img style="max-height:60px; width:60px;" src="{{ asset($post->images->first()->image_url) }}" alt="post_image" loading="lazy">
                                        @else
                                            <img style="max-height:60px; width:60px;" src="{{ asset('storage/images/no-image.jpg') }}" alt="no-image" loading="lazy">
                                        @endif
                                        </figure>
                                        <div>
                                            <strong class="testimonial-title">{{str_limit(strip_tags($post->post_title), 30)}}</strong>
                                            <span>{{str_limit(strip_tags($post->post_description), 30)}}</span>                                        
                                            <span class="mt-1">
                                                <i><small>Posted, {{$post->created_at->diffForHumans()}}</small></i> 
                                                {{$post->post_priority != 1 ? '(Promoted Post)' : ''}} {{$post->user_id != 1 ? '(User)' : ''}}
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