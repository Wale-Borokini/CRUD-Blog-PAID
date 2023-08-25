@extends('layouts.app')

@section('content')
<style>
    .feature-box-link {
    display: block;
    /* Add more styling properties to customize the appearance */
}
</style>
    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Add Locations</h1>
            </div>
        </div>

        
            <div class="section-elements" style="background: #f4f4f4;">
				<div class="container">					
					<div class="row justify-content-center">
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('countries.index')}}" class="icon-box">
								<i class="fa fa-bars"></i>
								<h5 class="porto-sicon-title">Countries</h5>
								<i class="fa fa-bars"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('states.index')}}" class="icon-box">
								<i class="fa fa-exclamation-triangle"></i>
								<h5 class="porto-sicon-title">States</h5>
								<i class="fa fa-exclamation-triangle"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('cities.index')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Cities</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>																					
					</div>
				</div>
			</div>
        
    </main><!-- End .main -->
@endsection