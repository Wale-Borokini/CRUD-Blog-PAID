@extends('layouts.app')

@section('content')
<main class="main">			
    <div class="container login-container">
        <div class="row">                           						
            <div class="col-lg-6">
                <div class="heading mb-1">
                    <h2 class="title">Register</h2>
                </div>

                <form method="POST" action="{{ route('register') }}">
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="password">
                        Confirm Password
                        <span class="required">*</span>
                    </label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                            

                    {{-- <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            {!! app('captcha')->display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}

                    <div class="mb-2">
                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                            Register
                        </button>
                    </div>
                </form>
            </div>                
            
        </div>
    </div>
</main><!-- End .main -->
@endsection