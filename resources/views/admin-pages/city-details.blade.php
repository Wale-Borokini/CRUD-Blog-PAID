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
                    </div>
                    @foreach ($posts as $post)
                        <div class="col-12">
                            <div class="testimonial testimonial-border testimonial-type4">     
                                <a href="{{ route('post-details', $post->slug) }}">                       
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
                                        @if($post->post_priority == 1)                                 
                                            <span class="mt-1"><i><small>Posted, {{$post->created_at->diffForHumans()}}</small></i></span>
                                        @else
                                            <span><i class="icon-star"></i></span>
                                        @endif
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
        
    </main><!-- End .main -->
@endsection