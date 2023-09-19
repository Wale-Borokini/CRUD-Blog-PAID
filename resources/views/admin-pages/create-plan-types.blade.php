@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Posting Plan</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('transaction-menu')}}" class="btn btn-outline-dark btn-md">Transaction Menu</a>                
            </div> 
            <div class="text-center mt-1">                
                <a href="{{route('plans.index')}}" class="btn btn-outline-success btn-md">All Posting Plans</a>
            </div>
        </div>		        
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('plans.store')}}">
                            @csrf                                
                                                        							
                            <div class="col-lg-12">
                                <label for="plan_type">
                                    Plan Type
                                    <span class="required">*</span>
                                </label>                            
                                <input placeholder="Premium" name="plan_type" id="plan_type" type="text" class="form-control @error('plan_type') is-invalid @enderror" value="{{ old('plan_type') }}" autocomplete="plan_type" autofocus required/>
                                @error('plan_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="plan_title">
                                    Plan Title
                                    <span class="required">*</span>
                                </label>                            
                                <input placeholder="Post My add right now" name="plan_title" id="plan_title" type="text" class="form-control @error('plan_title') is-invalid @enderror" value="{{ old('plan_title') }}" autocomplete="plan_title" autofocus required/>
                                @error('plan_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                   
                            <div class="col-lg-12">
                                <label for="price">
                                    Price
                                    <span class="required">*</span>
                                </label>
                                <input placeholder="20" name="price" id="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" autocomplete="price" autofocus required/>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="duration">
                                    Duration(Number of days)
                                    <span class="required">*</span>
                                </label>
                                <input placeholder="7" name="duration" id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" autocomplete="duration" autofocus required/>
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            <div class="col-lg-12">
                                <label for="priority">
                                    Priority
                                    <span class="required">*</span>
                                </label>
                                <input placeholder="50" name="priority" id="priority" type="number" class="form-control @error('priority') is-invalid @enderror" value="{{ old('priority') }}" autocomplete="priority" autofocus required/>
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="description">
                                    Description
                                    <span class="required">*</span>
                                </label>
                                <textarea placeholder="Move my Add to the top of the list for a week" name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus rows="2" cols="50" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12 mt-3">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Add Posting Plan
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