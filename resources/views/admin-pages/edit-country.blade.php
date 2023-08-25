@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Edit Country</h1>
            </div>            
            <div class="text-center mt-2">
                <a href="{{route('countries.index')}}" class="btn btn-outline-success btn-md">All Country</a>
            </div>                           
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('country.update', $country->slug)}}">
                            @csrf     
                            @method('PUT')                         
                            <div class="col-lg-12">
                                <label for="name">
                                    Country
                                    <span class="required">*</span>
                                </label>
                                <input name="name" id="name" value="{{$country->name}}" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Edit Country
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