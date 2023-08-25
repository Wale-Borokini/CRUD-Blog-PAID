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
                <h1>Personal Attributes</h1>
            </div>
        </div>

        
            <div class="section-elements" style="background: #f4f4f4;">
				<div class="container">					
					<div class="row justify-content-center">
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('ethnicities.index')}}" class="icon-box">
								<i class="fa fa-bars"></i>
								<h5 class="porto-sicon-title">Ethnicities</h5>
								<i class="fa fa-bars"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('genders.index')}}" class="icon-box">
								<i class="fa fa-exclamation-triangle"></i>
								<h5 class="porto-sicon-title">Genders</h5>
								<i class="fa fa-exclamation-triangle"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('hairs.index')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Hairs</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>		
                        <div class="col-sm-6 col-lg-4">
							<a href="{{route('eyes.index')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Eyes</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>																					
					</div>
				</div>
			</div>
        
    </main><!-- End .main -->
@endsection