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
			<div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>
            </div>   
        </div>
        
		<div class="section-elements" style="background: #f4f4f4;">
			<div class="container">					
				<div class="row justify-content-center">
					<div class="col-sm-6 col-lg-4">
						<a href="{{route('ethnicities.index')}}" class="icon-box">
							<i class="fa fa-flag-checkered"></i>
							<h5 class="porto-sicon-title">Ethnicities</h5>
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="col-sm-6 col-lg-4">
						<a href="{{route('genders.index')}}" class="icon-box">
							<i class="fa fa-restroom"></i>
							<h5 class="porto-sicon-title">Genders</h5>
							<i class="fa fa-restroom"></i>
						</a>
					</div>
					<div class="col-sm-6 col-lg-4">
						<a href="{{route('hairs.index')}}" class="icon-box">
							<i class="fa fa-user-alt"></i>
							<h5 class="porto-sicon-title">Hair Color</h5>
							<i class="fa fa-user-alt"></i>
						</a>
					</div>		
					<div class="col-sm-6 col-lg-4">
						<a href="{{route('eyes.index')}}" class="icon-box">
							<i class="fa fa-eye"></i>
							<h5 class="porto-sicon-title">Eye Color</h5>
							<i class="fa fa-eye"></i>
						</a>
					</div>																					
				</div>
			</div>
		</div>
	
    </main><!-- End .main -->
@endsection