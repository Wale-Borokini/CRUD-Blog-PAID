@extends('layouts.app')

@section('content')
    <main class="main">			
        <div class="container login-container">
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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="login-password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
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
@endsection
