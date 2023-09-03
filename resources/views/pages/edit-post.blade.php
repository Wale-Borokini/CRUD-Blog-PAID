@extends('layouts.app')

@section('content')
    <main class="min-height-page main">			
        <div class="container login-container">				
            <div class="col-lg-10 mx-auto">
                <div class="heading mb-1">
                    <h2>Edit Post</h2>
                </div>													
                <form id="planForm" method="POST" action="{{route('post.update', $post->slug)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')       
                    <div class="mt-2">
                        <h4>Description and Contact Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="post_title">
                                Advert Title
                                <span class="required">*</span>
                            </label>
                            <input name="post_title" value="{{$post->post_title}}" id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" value="{{ old('post_title') }}" autocomplete="post_title" autofocus required/>
                            @error('post_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="post_description">
                                Description
                                <span class="required">*</span>
                            </label>
                            <textarea name="post_description" id="post_description" class="form-control @error('post_description') is-invalid @enderror" value="{{ old('post_description') }}" autocomplete="post_description" autofocus  rows="3" required>{{$post->post_description}}</textarea>
                            @error('post_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="name">
                                Name
                                <span class="required">*</span>
                            </label>
                            <input name="name" value="{{$post->name}}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="phone_number">
                                Phone Number                                
                            </label>
                            <input name="phone_number" value="{{$post->phone_number}}" id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" autocomplete="phone_number" autofocus/>
                        </div>
                        <div class="col-lg-3">
                            <label for="email">
                                Email                                
                            </label>
                            <input name="email" value="{{$post->email}}" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus />
                        </div>
                        <div class="col-lg-3">
                            <label for="age">
                                Age
                                <span class="required">*</span>
                            </label>
                            <input name="age" value="{{$post->age}}" id="age" min="18" type="number" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" autocomplete="age" autofocus required/>
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="gender_id">
                                Gender									
                            </label>
                            <select name="gender_id" id="gender_id" class="form-control @error('gender_id') is-invalid @enderror" value="{{ old('gender_id') }}" autocomplete="gender_id" autofocus>
                                @if ($post->gender_id)
                                    <option value="{{$post->gender_id}}" selected="selected">{{$post->gender->name}}</option>
                                @else
                                    <option value="" selected="selected">Select a gender</option>
                                @endif
                                @foreach ($genders as $gender)     
                                    <option value="{{$gender->id}}">{{$gender->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="ethnicity_id">
                                Ethnicity									
                            </label>
                            <select name="ethnicity_id" id="ethnicity_id" class="form-control @error('ethnicity_id') is-invalid @enderror" value="{{ old('ethnicity_id') }}" autocomplete="ethnicity_id" autofocus>                                
                                @if ($post->ethnicity_id)
                                    <option value="{{$post->ethnicity_id}}" selected="selected">{{$post->ethnicity->name}}</option>
                                @else
                                    <option value="" selected="selected">Select Ethnicity</option>
                                @endif
                                @foreach ($ethnicities as $ethnicity)     
                                    <option value="{{$ethnicity->id}}">{{$ethnicity->name}}</option>
                                @endforeach
                            </select>		
                        </div>
                        <div class="col-lg-3">
                            <label for="hair_id">
                                Hair									
                            </label>
                            <select name="hair_id" id="hair_id" class="form-control @error('hair_id') is-invalid @enderror" value="{{ old('hair_id') }}" autocomplete="hair_id" autofocus>
                                @if ($post->hair_id)
                                    <option value="{{$post->hair_id}}" selected="selected">{{$post->hair->name}}</option>
                                @else
                                    <option value="" selected="selected">Select hair color</option>
                                @endif
                                @foreach ($hairs as $hair)     
                                    <option value="{{$hair->id}}">{{$hair->name}}</option>
                                @endforeach
                            </select>			
                        </div>
                        <div class="col-lg-3">
                            <label for="eye_id">
                                Eyes									
                            </label>
                            <select name="eye_id" id="eye_id" class="form-control @error('eye_id') is-invalid @enderror" value="{{ old('eye_id') }}" autocomplete="eye_id" autofocus>
                                @if ($post->eye_id)
                                    <option value="{{$post->eye_id}}" selected="selected">{{$post->eye->name}}</option>
                                @else
                                    <option value="" selected="selected">Select a gender</option>
                                @endif
                                @foreach ($eyes as $eye)     
                                    <option value="{{$eye->id}}">{{$eye->name}}</option>
                                @endforeach
                            </select>		
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="height">
                                Height									
                            </label>
                            <input name="height" value="{{$post->height}}" id="height" type="text" class="form-control @error('height') is-invalid @enderror" value="{{ old('height') }}" autocomplete="height" autofocus/>													
                        </div>
                        <div class="col-lg-3">
                            <label for="availability">
                                Availability									
                            </label>
                            <input name="availability" value="{{$post->availability}}" id="availability" type="text" class="form-control @error('availability') is-invalid @enderror" value="{{ old('availability') }}" autocomplete="availability" autofocus/>
                        </div>
                        <div class="col-lg-6">
                            <label for="address">
                                Address									
                            </label>
                            <input name="address" value="{{$post->address}}" id="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" autocomplete="address" autofocus/>
                        </div>
                        <div class="col-lg-12">
                            <label for="availability_details">
                                Rates and Availability Details								
                            </label>
                            <textarea name="availability_details" id="availability_details" class="form-control @error('availability_details') is-invalid @enderror" value="{{ old('availability_details') }}" autocomplete="availability_details" autofocus  rows="3">{{$post->availability_details}}</textarea>
                        </div>							
                    </div>
                    <div class="mt-2">
                        <h4>Add/delete Your Images</h4>
                    </div>
                    <div class="mb-5">
                        <a href="{{route('add-delete-post-image', $post->slug)}}" class="btn btn-outline-warning btn-xs">Add/Delete Images</a>
                    </div>                  

                    <div class="form-footer mb-2">
                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                            Edit Post
                        </button>
                    </div>
                </form>						
            </div>				
        </div>
    </main><!-- End .main -->

    <script>       
        
        document.addEventListener("DOMContentLoaded", function() {
            const deleteLinks = document.querySelectorAll('.delete-link');

            deleteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior

                    const imageId = link.getAttribute('data-image-id');
                    const url = `/delete-post-image/${imageId}`;

                    // Show SweetAlert confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this image!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(url, {
                                method: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Remove the image element from the DOM
                                // const imageDiv = link.closest('.col-md-3');
                                // if (imageDiv) {
                                //     imageDiv.remove();
                                // }
                                location.reload();
                            })
                            .catch(error => console.error('Error:', error));
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
                    console.error("Maximum image limit exceeded");
                    return; // Prevent the fetch request
                }

                for (var i = 0; i < this.files.length; i++) {
                    formData.append("images[]", this.files[i]);
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
                    // if (newImagesContainer) {
                    //     data.imageUrls.forEach(imageUrl => {
                    //         var div = document.createElement("div");
                    //         div.classList.add("image-item");
                    //         var img = document.createElement("img");
                    //         img.style.height = "350px";
                    //         img.src = imageUrl;
                    //         div.appendChild(img);
                    //         newImagesContainer.appendChild(div);
                    //     });

                    //     // Update the existing image count
                    //     existingImageCount = document.querySelectorAll(".existing-image").length;

                    //     // Show or hide the addImageBtn based on the updated image count
                    //     if (addImageBtn) {
                    //         if (existingImageCount < maxImageLimit) {
                    //             addImageBtn.style.display = "block";
                    //         } else {
                    //             addImageBtn.style.display = "none";
                    //         }
                    //     }
                    // }
                })
                .catch(error => {
                    console.error("Error uploading images:", error);
                });
            }
        });
    }
});






    </script>



    
       
@endsection
       
