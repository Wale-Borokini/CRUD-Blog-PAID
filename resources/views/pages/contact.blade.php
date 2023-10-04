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
                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf                            
                            <div class="col-lg-12">
                                <label for="subject">
                                    Subject
                                    <span class="required">*</span>
                                </label>
                                <input name="subject" id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" autocomplete="subject" autofocus/>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="email">
                                    Your Email
                                    <span class="required">*</span>
                                </label>
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus/>
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
                                <textarea name="message" id="message"></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           	
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
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
        ClassicEditor
            .create(document.querySelector('#message'), {
                toolbar: []
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection