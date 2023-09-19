@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">                
                <h1>My Profile</h1>
                <p><strong>Hi, {{Auth::user()->username}}. Your balance is ${{Auth::user()->credit_balance}}.</strong></p>
            </div>
        </div>
        
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
                                                <div class="mt-1">
                                                    <a href="{{route('post.edit', $post->slug)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                                    <form class="delete-form d-inline" action="{{ route('post.delete', $post->slug) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')                                        
                                                        <button type="submit" class="delete-button btn btn-outline-danger btn-xs">Delete</button>
                                                    </form> 
                                                </div>
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

        
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(deleteForm => {
                const deleteButton = deleteForm.querySelector('.delete-button');
                const confirmMessage = deleteButton.getAttribute('data-confirm');

                deleteForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    Swal.fire({
                        title: 'Confirm Deletion',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Delete'
                    }).then(result => {
                        if (result.isConfirmed) {
                            // Proceed with form submission
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
       
