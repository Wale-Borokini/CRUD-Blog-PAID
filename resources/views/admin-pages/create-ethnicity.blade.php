@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Ethnicity</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('personal-attributes')}}" class="btn btn-outline-dark btn-md">Personal Atributes</a>                
            </div> 
            <div class="text-center mt-1">                
                <a href="{{route('ethnicities.index')}}" class="btn btn-outline-success btn-md">All Ethnicities</a>
            </div>
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('ethnicities.store')}}">
                            @csrf                            
                            <div class="col-lg-12">
                                <label for="country">
                                    Ethnicity
                                    <span class="required">*</span>
                                </label>
                                <input name="name" id="name" type="text" class="form-input form-wide @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required />
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Add Ethnicity
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