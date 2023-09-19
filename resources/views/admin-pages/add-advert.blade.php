@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Advert</h1>
            </div>         
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>
            <div class="text-center mt-1">
                <a href="{{route('adverts.index')}}" class="btn btn-outline-info btn-md">Adverts</a>                
            </div>                                 
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('adverts.store')}}" enctype="multipart/form-data">
                            @csrf                            
                            <div class="col-lg-12">
                                <label for="title">
                                    Title
                                    <span class="required">*</span>
                                </label>
                                <input name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autocomplete="title" autofocus required/>
                                @error('title')
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
                                <input name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" autocomplete="description" autofocus required/>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="brand">
                                    Brand
                                    <span class="required">*</span>
                                </label>
                                <input name="brand" id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" autocomplete="brand" autofocus required/>
                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="advert_url">
                                    Advert URL
                                    <span class="required">*</span>
                                </label>
                                <input name="advert_url" id="advert_url" type="text" class="form-control @error('advert_url') is-invalid @enderror" value="{{ old('advert_url') }}" autocomplete="advert_url" autofocus required/>
                                @error('advert_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Image</label>
                                    <input name="image_url" type="file"  class="form-control-file">                                
                                    @error('image_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>													
                            </div>	
                            <div class="col-lg-12 mt-2">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-md w-100">
                                        Add Advert
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