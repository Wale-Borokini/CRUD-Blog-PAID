@extends('layouts.app')

@section('content')
    <main class="main">			
        <div class="container login-container min-height-page">
            <div class="row">                           						
                <div class="col-lg-6">
                    <div class="heading mb-1">
                        <h2 class="title">Register</h2>
                    </div>

                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
                        @csrf

                        <label for="username">
                            Username
                            <span class="required">*</span>
                        </label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="email">
                            Email
                            <span class="required">*</span>
                        </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required oninput="checkPasswordVisibility()">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="password">
                            Confirm Password
                            <span class="required">*</span>
                        </label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" oninput="checkPasswordVisibility()">
                        
                        <label for="show-password" class="ml-2">
                            <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()"> View Password
                        </label>

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-1 mt-2">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="i-agree" id="i-agree" onclick="hideErrorMessage()">

                                    <label class="form-check-label ml-2" for="i-agree">
                                        By creating an account, I consent to abide by the <a href="{{ route('terms') }}">terms of use</a>.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="error-message alert alert-rounded alert-sm alert-danger" id="terms-error" style="display: none;">
                            <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                            <span><strong> You must agree to the terms of use.</strong></span>                            
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-dark btn-md w-100 mr-0" id="registerButton">
                                Register
                            </button>
                        </div>
                    </form>
                </div>                
                
            </div>
        </div>
    </main><!-- End .main -->

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('password-confirm');
            var checkbox = document.getElementById('show-password');

            if (checkbox.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        }

        function checkPasswordVisibility() {
            var checkbox = document.getElementById('show-password');
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('password-confirm');

            if (checkbox.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            }
        }

        function validateForm() {
            // Check if the "i-agree" checkbox is checked
            if (!document.getElementById('i-agree').checked) {
                // If not checked, show the error message
                document.getElementById('terms-error').style.display = 'block';
                
                // Prevent form submission
                return false;
            }

            // If checked, disable the submit button to prevent multiple submissions
            document.getElementById('registerButton').disabled = true;
            
            // Continue with form submission
            return true;
        }

        function hideErrorMessage() {
            // Hide the error message when the checkbox is clicked
            document.getElementById('terms-error').style.display = 'none';
        }
    </script>

@endsection