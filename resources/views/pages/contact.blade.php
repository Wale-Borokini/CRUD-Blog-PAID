@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	        		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                                       
                    <div class="col-md-6">  
                        <div class="heading mb-1">
                            <h2>Contact Us</h2>
                        </div>                           
                        <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                            @csrf 
                            <div class="col-lg-12">
                                <label for="fullName">
                                    Your Name
                                    <span class="required">*</span>
                                </label>
                                <input name="fullName" id="fullName" type="text" class="form-control @error('fullName') is-invalid @enderror" value="{{ old('fullName') }}" autocomplete="fullName" autofocus required/>
                                @error('fullName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           
                            <div class="col-lg-12">
                                <label for="subject">
                                    Subject of Your Message
                                    <span class="required">*</span>
                                </label>
                                <input name="subject" id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" autocomplete="subject" autofocus required/>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           
                            <div class="col-lg-12">
                                <label for="email">
                                    Your Email Address
                                    <span class="required">*</span>
                                </label>
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus required/>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="message">
                                    Message
                                    <span class="required">*</span>
                                </label>
                                <textarea name="message" id="message" class="form-control"></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           	
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100" id="submitButton">
                                        Send
                                    </button>
                                </div>
                            </div>                                                                
                        </form>
                    </div>							                    
                </div>
            </div>
        </div>
    </main><!-- End .main -->

    <script>
      
        document.addEventListener('DOMContentLoaded', function () {
            let editor;

            ClassicEditor
                .create(document.querySelector('#message'), {
                    toolbar: []
                })
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });

            const form = document.querySelector('#contactForm');
            const submitButton = document.querySelector('#submitButton');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Check if the message textarea is empty
                if (editor.getData().trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please enter a message!',
                    });
                    return;
                }

                const formData = new FormData(form);

                // Disable the button to prevent multiple submissions
                submitButton.disabled = true;

                fetch('{{ route('contact.submit') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent',
                            text: 'Your message has been sent.',
                        });

                        // Optionally, reset the form
                        editor.setData('');
                        form.reset();
                        submitButton.disabled = false;
                    } else {
                        // Handle errors if needed
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error || 'Something went wrong!',
                        });

                        // Enable the button in case of error
                        submitButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });

                    // Enable the button in case of error
                    submitButton.disabled = false;
                });
            });
        });

    </script>
    <!-- Include SweetAlert library -->

@endsection