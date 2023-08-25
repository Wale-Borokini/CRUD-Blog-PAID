@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Eye Color</h1>
            </div>
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('eyes.store')}}">
                            @csrf                            
                            <div class="col-lg-12">
                                <label for="country">
                                    Eye Color
                                    <span class="required">*</span>
                                </label>
                                <input name="name" id="name" type="text" class="form-input form-wide @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required />
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Add Eye Color
                                    </button>
                                </div>
                            </div>                                                                
                        </form>
                    </div>							                    
                </div>
            </div>
        </div>
    </main><!-- End .main -->
@endsection