@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add State</h1>
            </div>
            <div class="text-center mt-2">
                <a href="{{route('states.index')}}" class="btn btn-outline-success btn-md">All States</a>
            </div>  
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('states.store')}}">
                            @csrf                                
                            <div class="col-lg-12">								
                                <div class="col-lg-12">
                                    <label for="country_id">
                                        Choose a Country
                                        <span class="required">*</span>
                                    </label>                            
                                    <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror"  value="{{ old('country_id') }}" autocomplete="country_id" autofocus required>
                                        <option value="">select a country</option>
                                        @foreach ($countries as $country)     
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                    
                                <div class="col-lg-12">
                                    <label for="name">
                                        State
                                        <span class="required">*</span>
                                    </label>
                                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required/>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div>
                                        <button type="submit" class="btn btn-dark btn-md w-100">
                                            Add State
                                        </button>
                                    </div>
                                </div>
                            </div>                                
                        </form>
                    </div>							                    
                </div>
            </div>
        </div>
    </main><!-- End .main -->
@endsection