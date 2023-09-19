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
                <h1>Admin Dashboard</h1>
            </div>
        </div>

        
            <div class="section-elements" style="background: #f4f4f4;">
				<div class="container">					
					<div class="row justify-content-center">
						<div class="col-sm-6 col-lg-4">
							<a href="{{ route('all-users') }}" class="icon-box">
								<i class="fa fa-bars"></i>
								<h5 class="porto-sicon-title">All Users</h5>
								<i class="fa fa-bars"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{ route('all-posts') }}" class="icon-box">
								<i class="fa fa-exclamation-triangle"></i>
								<h5 class="porto-sicon-title">All Posts</h5>
								<i class="fa fa-exclamation-triangle"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('add-locations')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Locations</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('personal-attributes')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Personal Attributes</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('transaction-menu')}}" class="icon-box">
								<i class="fas fa-shopping-basket"></i>
								<h5 class="porto-sicon-title">Transactions</h5>
								<i class="fas fa-shopping-basket"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{ route('adverts.index') }}" class="icon-box">
								<i class="fa fa-asterisk"></i>
								<h5 class="porto-sicon-title">Adverts</h5>
								<i class="fa fa-asterisk"></i>
							</a>
						</div>
						@can('viewAdminRoles', Auth::user())
							<div class="col-sm-6 col-lg-4">
								<a href="{{ route('admin-roles') }}" class="icon-box">
									<i class="fa fa-asterisk"></i>
									<h5 class="porto-sicon-title">Admin Roles</h5>
									<i class="fa fa-asterisk"></i>
								</a>
							</div>
						@endcan																			
					</div>
				</div>
			</div>
        

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection