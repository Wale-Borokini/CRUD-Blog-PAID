@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Posting Plan</h1>
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
                                <input placeholder="Premium" name="plan_type" id="plan_type" type="text" class="form-input form-wide @error('plan_type') is-invalid @enderror" value="{{ old('plan_type') }}" autocomplete="plan_type" autofocus required />
                            </div>
                            <div class="col-lg-12">
                                <label for="plan_title">
                                    Plan Title
                                    <span class="required">*</span>
                                </label>
                                <input placeholder="Post My add right now" name="plan_title" id="plan_title" type="text" class="form-input form-wide @error('plan_title') is-invalid @enderror" value="{{ old('plan_title') }}" autocomplete="plan_title" autofocus required />
                            </div>                            
                            <div class="col-lg-12">
                                <label for="price">
                                    Price
                                    <span class="required">*</span>
                                </label>
                                <input placeholder="20" name="price" id="price" type="number" class="form-input form-wide @error('plan_type') is-invalid @enderror" value="{{ old('price') }}" autocomplete="price" autofocus required />
                            </div>
                            <div class="col-lg-12">
                                <label for="description">
                                    Description
                                    <span class="required"></span>
                                </label>                                
                                <textarea placeholder="Move my Add to the top of the list for a week" name="description" id="description" type="text" class="form-input form-wide @error('description') is-invalid @enderror" value="{{ old('description') }}" autocomplete="description" autofocus rows="2" cols="50"></textarea>
                            </div>                            
                            
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Add Plan
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