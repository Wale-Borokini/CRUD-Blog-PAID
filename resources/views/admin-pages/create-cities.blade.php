@extends('layouts.app')

@section('content')
    <main class="min-height-page main">	
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add City</h1>
            </div>
            <div class="text-center mt-2">
                <a href="{{route('cities.index')}}" class="btn btn-outline-success btn-md">All Cities</a>
            </div>  
        </div>		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                    
                    <div class="col-md-6">                            
                        <form method="POST" action="{{route('cities.store')}}">
                            @csrf                                
                            <div class="col-lg-12">								
                                <div class="col-lg-12">
                                    <label for="country_id">
                                        Choose a Country
                                        <span class="required">*</span>
                                    </label>                            
                                    <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror"  value="{{ old('country_id') }}" autocomplete="country_id" autofocus required>
                                        <option value="" selected disabled>Select a Country</option>
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
                                    <label for="state_id">
                                        Choose a State
                                        <span class="required">*</span>
                                    </label>                            
                                    <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror"  value="{{ old('state_id') }}" autocomplete="state_id" autofocus required>
                                        
                                    </select>
                                    @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                   
                                <div class="col-lg-12">
                                    <label for="name">
                                        City
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
                                            Add City
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

    <script>


        const getElementById = id => document.getElementById(id);
        const countrySelect = getElementById('country_id');
        const stateSelect = getElementById('state_id');

        const populateSelectWithOptions = (selectElement, options) => {
            selectElement.innerHTML = '';
            const defaultOption = new Option('Select...', '');
            selectElement.appendChild(defaultOption);
    
            options.forEach(([id, name]) => {
                const option = new Option(name, id);
                selectElement.appendChild(option);
            });
        };
        
        const fetchAndPopulateSelect = (url, selectElement, sortFunction) => {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const sortedData = Object.entries(data).sort((a, b) => sortFunction(a[1], b[1]));
                    populateSelectWithOptions(selectElement, sortedData);
                });
        };

        countrySelect.addEventListener('change', function () {
            const country_id = this.value;
    
            stateSelect.innerHTML = '';            
    
            if (country_id) {
                const sortFunction = (a, b) => a.localeCompare(b);
                fetchAndPopulateSelect(`/get-states/${country_id}`, stateSelect, sortFunction);
            }
        });

    </script>
@endsection