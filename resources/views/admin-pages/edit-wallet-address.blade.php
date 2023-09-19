@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Edit Wallet Address</h1>
            </div>         
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>
            <div class="text-center mt-1">
                <a href="{{route('wallets.index')}}" class="btn btn-outline-info btn-md">Wallet</a>                
            </div>                                 
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('wallets.update', $wallet->id)}}" enctype="multipart/form-data">
                            @csrf   
                            @method('PUT')                           
                            <div class="col-lg-12">
                                <label for="country">
                                    Title
                                    <span class="required">*</span>
                                </label>
                                <input name="title" value="{{ $wallet->title }}" id="title" type="text" class="form-control @error('title') is-invalid @enderror" autocomplete="title" autofocus required/>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="country">
                                    BTC Wallet Address
                                    <span class="required">*</span>
                                </label>
                                <input name="btc_address" value="{{ $wallet->btc_address }}" id="btc_address" type="text" class="form-control @error('btc_address') is-invalid @enderror" autocomplete="btc_address" autofocus required/>
                                @error('btc_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="country">
                                    Amount in BTC
                                    <span class="required">*</span>
                                </label>
                                <input name="amount" value="{{ $wallet->amount }}" id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" autocomplete="amount" autofocus required/>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="country">
                                    BTC Service
                                    <span class="required">*</span>
                                </label>
                                <input name="btc_service" value="{{ $wallet->btc_service }}" id="btc_service" type="text" class="form-control @error('btc_service') is-invalid @enderror" autocomplete="btc_service" autofocus required/>
                                @error('btc_service')
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
                                        Edit Wallet Address
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