@extends('layouts.app')

@section('content')
    <main class="main">			
        <div class="container login-container min-height-page">
            <div class="row">                          
                <div class="col-md-6">
                    <div class="heading mb-1">
                        <h2 class="title">Login</h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label for="email">
                            Username or email address
                            <span class="required">*</span>
                        </label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="login-password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" oninput="checkPasswordVisibility()">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label class="ml-2" for="show-password">
                            <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()"> View Password
                        </label>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label ml-2" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <button type="submit" class="btn btn-dark btn-md w-100">
                                LOGIN
                            </button>
                        </div>
                        <div class="mb-1">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>							                            
            </div>
        </div>
    </main><!-- End .main -->
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var checkbox = document.getElementById('show-password');

            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        function checkPasswordVisibility() {
            var checkbox = document.getElementById('show-password');
            var passwordField = document.getElementById('password');

            if (checkbox.checked) {
                passwordField.type = 'text';
            }
        }
    </script>
@endsection
