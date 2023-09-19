@extends('layouts.app')

@section('content')
    <main class="min-height-page main">			
        <div class="container login-container">				
            <div class="col-lg-10 mx-auto">
                <div class="heading mb-1">
                    <h2>Edit Post</h2>
                </div>													
                <form id="editPostForm" method="POST" action="{{route('post.update', $post->slug)}}" enctype="multipart/form-data">
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
                            <textarea name="post_title" id="post_title" type="text">{!! $post->post_title !!}</textarea>
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
                            <textarea name="post_description" id="post_description">{!! $post->post_description !!}</textarea>
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
                            <input name="name" value="{{$post->name}}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus required/>
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
                            <input name="phone_number" value="{{$post->phone_number}}" id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" autocomplete="phone_number" autofocus/>
                        </div>
                        <div class="col-lg-3">
                            <label for="email">
                                Email                                
                            </label>
                            <input name="email" value="{{$post->email}}" id="email" type="text" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus />
                        </div>
                        <div class="col-lg-3">
                            <label for="age">
                                Age
                                <span class="required">*</span>
                            </label>
                            <input name="age" value="{{$post->age}}" id="age" min="18" type="number" class="form-control @error('age') is-invalid @enderror" autocomplete="age" autofocus required/>
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
                            <select name="gender_id" id="gender_id" class="form-control @error('gender_id') is-invalid @enderror" autocomplete="gender_id" autofocus>
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
                            <select name="ethnicity_id" id="ethnicity_id" class="form-control @error('ethnicity_id') is-invalid @enderror" autocomplete="ethnicity_id" autofocus>                                
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
                            <select name="hair_id" id="hair_id" class="form-control @error('hair_id') is-invalid @enderror" autocomplete="hair_id" autofocus>
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
                            <select name="eye_id" id="eye_id" class="form-control @error('eye_id') is-invalid @enderror" autocomplete="eye_id" autofocus>
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
                            <input name="height" value="{{$post->height}}" id="height" type="text" class="form-control @error('height') is-invalid @enderror" autocomplete="height" autofocus/>													
                        </div>
                        <div class="col-lg-3">
                            <label for="availability">
                                Availability									
                            </label>
                            <input name="availability" value="{{$post->availability}}" id="availability" type="text" class="form-control @error('availability') is-invalid @enderror" autocomplete="availability" autofocus/>
                        </div>
                        <div class="col-lg-6">
                            <label for="address">
                                Address									
                            </label>
                            <input name="address" value="{{$post->address}}" id="address" type="text" class="form-control @error('address') is-invalid @enderror" autocomplete="address" autofocus/>
                        </div>
                        <div class="col-lg-12">
                            <label for="availability_details">
                                Rates and Availability Details								
                            </label>
                            <textarea name="availability_details" id="availability_details">{!! $post->availability_details !!}</textarea>
                        </div>							
                    </div>
                    <div class="mt-2">
                        <h4>Add/delete Your Images</h4>
                    </div>
                    <div class="mb-5">
                        <a href="{{route('add-delete-post-image', $post->slug)}}" class="btn btn-outline-warning btn-xs">Add/Delete Images</a>
                    </div> 

                    <!-- Error message divs -->
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="titleError" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong>Please enter an ad title.</strong></span>
                    </div>
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="descriptionError" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong> Please enter an ad description.</strong></span>
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
                        
        ClassicEditor
            .create(document.querySelector('#post_title'), {
                toolbar: []
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#post_description'), {
                toolbar: []
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#availability_details'), {
                toolbar: []
            })
            .catch(error => {
                console.error(error);
            });


        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("editPostForm");
            const titleTextarea = document.getElementById("post_title");
            const descriptionTextarea = document.getElementById("post_description");
            const titleError = document.getElementById("titleError");
            const descriptionError = document.getElementById("descriptionError");

            form.addEventListener("submit", function (event) {
                // Check if the title textarea is empty
                if (titleTextarea.value.trim() === "") {
                    titleError.style.display = "block";
                    event.preventDefault(); // Prevent form submission
                } else {
                    titleError.style.display = "none";
                }

                // Check if the description textarea is empty
                if (descriptionTextarea.value.trim() === "") {
                    descriptionError.style.display = "block";
                    event.preventDefault(); // Prevent form submission
                } else {
                    descriptionError.style.display = "none";
                }
            });
        });


    </script>
      
@endsection
       
