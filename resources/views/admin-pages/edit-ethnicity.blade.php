@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>{{$ethnicity->name}}</h1>
            </div>            
            <div class="text-center mt-2">
                <a href="{{route('ethnicities.index')}}" class="btn btn-outline-success btn-md">All Ethnicities</a>
            </div>                           
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('ethnicity.update', $ethnicity->slug)}}">
                            @csrf 
                            @method('PUT')                           
                            <div class="col-lg-12">
                                <label for="name">
                                    Ethnicity
                                    <span class="required">*</span>
                                </label>
                                <input name="name" id="name" value="{{$ethnicity->name}}" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Edit Ethnicity
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