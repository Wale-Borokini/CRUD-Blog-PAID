@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        
        
        <div class="container">				
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-widgets-container row pb-2 mt-4">									
                        <div class="col-lg-12 col-sm-6 pb-5 pb-md-0">
                            <h4 class="section-sub-title">Posts</h4>
                            @foreach ($userPosts as $post)
                                <div class="col-lg-8">
                                    <a href="{{ route('post-details', $post->slug) }}">  
                                    <div class="testimonial testimonial-border testimonial-type4">                                                                  
                                        <div class="testimonial-owner">
                                            <figure class="max-width-none">
                                                @if ($post->images->count() > 0) 
                                                    <img style="max-height:60px; width:60px;" src="{{asset( $post->images->first()->image_url )}}" alt="post_image">
                                                @elseif($post->images->count() < 1) 
                                                    <img style="max-height:60px; width:60px;" src="{{asset('storage/images/no-image.jpg')}}" alt="no-image">
                                                @endif
                                            </figure>
                                            <div>
                                                <strong class="testimonial-title">{!! str_limit(strip_tags($post->post_title), 30) !!}</strong>
                                                <span>{{str_limit(strip_tags($post->post_description), 30)}}</span>
                                                <span class="mt-1"><i><small>Posted, {{$post->created_at->diffForHumans()}}</small></i></span>
                                            </div>                                            
                                        </div>                                      
                                    </div>
                                     </a>
                                </div> 
                            @endforeach  
                            {{ $userPosts->links() }}            
                        </div>									
                    </div>
                </div><!-- End .col-lg-8 -->					
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const testimonialDivs = document.querySelectorAll('.testimonial-border');

            testimonialDivs.forEach(div => {
                div.addEventListener('click', function(event) {
                    const target = event.target;

                    // Check if the clicked element is not the edit link or delete button
                    if (!target.classList.contains('btn')) {
                        const link = div.querySelector('a');
                        if (link) {
                            window.location.href = link.getAttribute('href');
                        }
                    }
                });
            });
        });
       
    </script>
@endsection
       
