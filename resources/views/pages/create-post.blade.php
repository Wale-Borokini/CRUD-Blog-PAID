@extends('layouts.app')

@section('content')


    <main class="min-height-page main">			
        <div class="container login-container">				
            <div class="col-lg-10 mx-auto">
                <div class="heading mb-1">
                    <h2>Create Post</h2>
                </div>													
                <form id="createPostForm" method="POST" action="{{route('create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div>
                        <h4>Region</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">								
                            <label for="country_id">
                                Country
                                <span class="required">*</span>
                            </label>                            
                            <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror"  value="{{ old('country_id') }}" autocomplete="country_id" autofocus required>
                                <option value="" selected disabled>Select a Country</option>
                                @foreach ($countries as $country)     
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror													
                        </div>
                        <div class="col-lg-6">								
                            <label for="state_id">
                                Choose a State for Your Ad
                                <span class="required">*</span>
                            </label>                            
                            <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror"  value="{{ old('state_id') }}" autocomplete="state_id" autofocus required>
                                
                            </select>
                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror												
                        </div>
                        <div class="col-lg-6">
                            <label for="city_id">
                                Choose a City for Your Ad
                                <span class="required">*</span>
                            </label>                            
                            <select name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror" value="{{ old('city_id') }}" autocomplete="city_id" autofocus required>
                                
                            </select>
                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>													
                    </div>
                    <div class="mt-2">
                        <h4>Description and Contact Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="post_title">
                                Advert Title
                                <span class="required">*</span>
                            </label>
                            <textarea name="post_title" id="post_title" type="text"></textarea>
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
                            <textarea name="post_description" id="post_description"></textarea>
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
                            <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required/>
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
                            <input name="phone_number" id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" autocomplete="phone_number" autofocus/>
                        </div>
                        <div class="col-lg-3">
                            <label for="email">
                                Email                                
                            </label>
                            <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus />
                        </div>
                        <div class="col-lg-3">
                            <label for="age">
                                Age
                                <span class="required">*</span>
                            </label>
                            <input name="age" id="age" min="18" type="number" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" autocomplete="age" autofocus required/>
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
                                <option value="" selected disabled>Select a Gender</option>
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
                                <option value="" selected disabled>Select an ethnicity</option>
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
                                <option value="" selected disabled>Select hair color</option>
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
                                <option value="" selected disabled>Select eye color</option>
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
                            <input name="height" id="height" type="text" class="form-control @error('height') is-invalid @enderror" value="{{ old('height') }}" autocomplete="height" autofocus/>													
                        </div>
                        <div class="col-lg-3">
                            <label for="availability">
                                Availability									
                            </label>
                            <input name="availability" id="availability" type="text" class="form-control @error('availability') is-invalid @enderror" value="{{ old('availability') }}" autocomplete="availability" autofocus/>
                        </div>
                        <div class="col-lg-6">
                            <label for="address">
                                Address									
                            </label>
                            <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" autocomplete="address" autofocus/>
                        </div>
                        <div class="col-lg-12">
                            <label for="availability_details">
                                Rates and Availability Details								
                            </label>
                            <textarea name="availability_details" id="availability_details"></textarea>
                        </div>							
                    </div>
                    <div class="mt-2">
                        <h4>Upload Your Images</h4>
                        <p><i>Maximum number of images (4)</i></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Image(s)</label>
                                <input name="image_url[]" type="file" id="files" class="form-control-file" multiple value="{{ old('image_url[]') }}">                                
                                @error('image_url')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>													
                        </div>																			
                    </div>
                    <div class="mt-2">
                        <h4>Choose Your Posting Plan</h4>
                    </div>
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="order-summary flex-fill">
                                    <div class="bg-dark p-2">
                                        <h3 class="text-white">{{$plan->plan_title}}</h3>
                                    </div>
                                    <div class="mt-2">
                                        <p>{{$plan->description}} for $<span id="dynamic-price">{{$plan->price}}</span></p>
                                    </div>									
                                    <div class="form-group mt-2 mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input name="posting_plan_id" type="checkbox" value="{{$plan->id}}" class="form-check-input plan-checkbox">
                                            <label class="form-check-label ml-2" for="exampleCheck1">Select This Plan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                                                     													
                    </div>
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="titleError" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong>Please enter an ad title.</strong></span>
                    </div>
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="descriptionError" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong> Please enter an ad description.</strong></span>
                    </div>
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="posting-plan-error" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong> Please select at least one posting plan.</strong></span>
                    </div>
                    <div class="error-message alert alert-rounded alert-sm alert-danger" id="terms-error" style="display: none;">
                        <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                        <span><strong> You must agree to the terms and conditions.</strong></span>                            
                    </div>
                    <div id="selected-plan-price" class="alert alert-default ml-3" style="display: none;">
                        
                    </div>              

                    <div class="form-group mt-3">
                        <div class="custom-control custom-checkbox">
                            <input name="agree_terms" type="checkbox" class="form-check-input" id="agree-terms">
                            <label class="form-check-label" for="agree-terms">I agree to the terms and conditions</label>
                        </div>                        
                    </div>

                    <div class="form-footer mb-2">
                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                            Post
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

        document.addEventListener("DOMContentLoaded", function() {
            const inputElement = document.getElementById("files");
            
            inputElement.addEventListener("change", function() {
                const files = inputElement.files;
                let valid = true;
                
                if (files.length > 4) {
                    valid = false;
                }
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    
                    if (!file.type.match(/image\/jpeg|image\/jpg|image\/png/) || file.size > 15000000) {
                        valid = false;
                        break;
                    }
                }
                
                if (!valid) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Please make sure you upload a maximum of 4 JPEG, JPG, or PNG images and each image size is less than 15MB.",
                    });
                    // Clear the input
                    inputElement.value = "";
                }
            });
        });


        const getElementById = id => document.getElementById(id);
    
        const countrySelect = getElementById('country_id');
        const stateSelect = getElementById('state_id');
        const citySelect = getElementById('city_id');
        
        const showError = (errorElement, showMessage) => {
            errorElement.style.display = showMessage ? 'block' : 'none';
        };
    
        const populateSelectWithOptions = (selectElement, options) => {
            selectElement.innerHTML = '';
            const defaultOption = new Option('Select...', '');
            selectElement.appendChild(defaultOption);
    
            options.forEach(([id, name]) => {
                const option = new Option(name, id);
                selectElement.appendChild(option);
            });
        };
    
        const fetchAndPopulateSelect = (url, selectElement, sortFunction) => {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const sortedData = Object.entries(data).sort((a, b) => sortFunction(a[1], b[1]));
                    populateSelectWithOptions(selectElement, sortedData);
                });
        };
    
        countrySelect.addEventListener('change', function () {
            const country_id = this.value;
    
            stateSelect.innerHTML = '';
            citySelect.innerHTML = '';
    
            if (country_id) {
                const sortFunction = (a, b) => a.localeCompare(b);
                fetchAndPopulateSelect(`/get-states/${country_id}`, stateSelect, sortFunction);
            }
        });
    
        stateSelect.addEventListener('change', function () {
            const state_id = this.value;
    
            citySelect.innerHTML = '';
    
            if (state_id) {
                const sortFunction = (a, b) => a.localeCompare(b);
                fetchAndPopulateSelect(`/get-cities/${state_id}`, citySelect, sortFunction);
            }
        });
    
        const checkboxes = document.querySelectorAll('.plan-checkbox');
        const selectedPlanPrice = getElementById('selected-plan-price');
        const postingPlanError = getElementById('posting-plan-error');
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
    
                if (checkbox.checked) {
                    const price = checkbox.closest('.order-summary').querySelector('#dynamic-price').textContent;
                    selectedPlanPrice.textContent = `Post Fee: $${price}`;
                    selectedPlanPrice.style.display = 'block';
                    showError(postingPlanError, false);
                } else {
                    selectedPlanPrice.style.display = 'none';
                }
            });
        });
    
        const agreeTermsCheckbox = getElementById('agree-terms');
        const termsError = getElementById('terms-error');
        const titleError = document.getElementById("titleError");
        const descriptionError = document.getElementById("descriptionError");
    
        getElementById('createPostForm').addEventListener('submit', event => {
            const checkboxes = document.querySelectorAll('input[name="posting_plan_id"]');
            const atLeastOneChecked = [...checkboxes].some(checkbox => checkbox.checked);

            const postTitle = document.getElementById("post_title").value.trim();
            const postDescription = document.getElementById("post_description").value.trim();

            if (postTitle === "") {
                titleError.style.display = "block";
                descriptionError.style.display = "none";
                event.preventDefault();
            } else if (postDescription === "") {
                titleError.style.display = "none";
                descriptionError.style.display = "block";
                event.preventDefault();
            } else {
                titleError.style.display = "none";
                descriptionError.style.display = "none";
            }
    
            if (!atLeastOneChecked) {
                event.preventDefault();
                showError(postingPlanError, true);
            }
    
            if (!agreeTermsCheckbox.checked) {
                event.preventDefault();
                showError(termsError, true);
            } else {
                showError(termsError, false);
            }
        });
    
        agreeTermsCheckbox.addEventListener('change', () => {
            if (agreeTermsCheckbox.checked) {
                showError(termsError, false);
            }
        });

    </script>
    
       
@endsection
       
