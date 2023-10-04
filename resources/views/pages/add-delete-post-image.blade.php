@extends('layouts.app')

@section('content')
    <main class="min-height-page main">			
        <div class="container login-container">				
            <div class="col-lg-10 mx-auto mb-10">
                <div class="heading mb-1">
                    <h2>Add/Delete Images</h2>
                    <a href="{{route('post.edit', $post->slug)}}" class="btn btn-outline-warning btn-xs">Back To Edit Post</a>
                </div>													                                                    
                    <div class="row">
                        @foreach($post->images as $postImage)
                            <div class="col-md-3">                                                          
                                <img style="height:350px;" src="{{asset($postImage->image_url)}}" alt="Post Image">
                                <div class="mt-1 mb-1 text-center">                                    
                                    {{-- <a href="{{ route('delete-post-image', ['image' => $postImage->id]) }}" class="delete-link btn btn-outline-danger btn-xs" data-image-id="{{ $postImage->id }}">Delete</a> --}}
                                    <form class="delete-form" action="{{ route('delete-post-image', $postImage->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')                                        
                                        <button type="submit" class="delete-button btn btn-outline-danger btn-xs">Delete</button>
                                    </form> 
                                </div>												
                            </div>
                        @endforeach																			
                    </div> 
                    <div id="newImagesContainer" class="row"></div>                    
                    @if(count($post->images) <4)
                        <div class="text-center mt-2">
                            <a href="" class="btn btn-outline-info btn-md hide-on-max-images" id="addImageBtn" data-post-slug="{{ $post->slug }}">Add Image</a>
                            <input type="file" id="imageInput" style="display: none;" multiple>
                        </div>  
                    @endif                

               					
            </div>				
        </div>
    </main><!-- End .main -->

    <script>       
                
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


        document.addEventListener("DOMContentLoaded", function() {
            var addImageBtn = document.getElementById("addImageBtn");
            var imageInput = document.getElementById("imageInput");
            var newImagesContainer = document.getElementById("newImagesContainer");

            if (addImageBtn) {
                addImageBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    imageInput.click();
                });
            }

            if (imageInput) {
                imageInput.addEventListener("change", function() {
                    var formData = new FormData();
                    var postSlug = addImageBtn ? addImageBtn.getAttribute("data-post-slug") : null;

                    if (postSlug) {
                        var existingImageCount = document.querySelectorAll(".existing-image").length;
                        var newImageCount = this.files.length;
                        var maxImageLimit = 4;

                        if (existingImageCount + newImageCount > maxImageLimit) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Maximum image limit exceeded (4 images allowed)',
                            });
                            return; // Prevent the fetch request
                        }

                        for (var i = 0; i < this.files.length; i++) {
                            var file = this.files[i];
                            var allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/jpg_small"];
                            var maxFileSize = 15 * 1024 * 1024; // 15MB in bytes

                            if (allowedTypes.includes(file.type) && file.size <= maxFileSize) {
                                formData.append("images[]", file);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Invalid file type or size. Only JPG, JPEG, Webp, and PNG files up to 5MB are allowed.',
                                });
                                return; // Prevent the fetch request
                            }
                        }

                        formData.append("post_slug", postSlug);
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch("/upload-image-edit", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": csrfToken
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Network response was not ok");
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log("Images uploaded successfully:", data.message);
                            location.reload();                    
                        })
                        .catch(error => {
                            console.error("Error uploading images:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while uploading images.',
                            });
                        });
                    }
                });
            }
        });

    </script> 
       
@endsection