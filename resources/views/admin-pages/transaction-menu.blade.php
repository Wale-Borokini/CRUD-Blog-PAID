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
                <h1>Transaction Menu</h1>
            </div>
			<div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>
            </div> 
        </div>

        
            <div class="section-elements" style="background: #f4f4f4;">
				<div class="container">					
					<div class="row justify-content-center">
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('plans.index')}}" class="icon-box">
								<i class="fa fa-bars"></i>
								<h5 class="porto-sicon-title">Post Plans</h5>
								<i class="fa fa-bars"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('credit-user')}}" class="icon-box">
								<i class="fa fa-exclamation-triangle"></i>
								<h5 class="porto-sicon-title">Credit User</h5>
								<i class="fa fa-exclamation-triangle"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('debit-user')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Debit User</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>	
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('transaction-history')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Transaction History</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('buy-credits-page-log')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Page Logs</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>	
						<div class="col-sm-6 col-lg-4">
							<a href="{{route('wallets.index')}}" class="icon-box">
								<i class="fa fa-cart-arrow-down"></i>
								<h5 class="porto-sicon-title">Wallet Address</h5>
								<i class="fa fa-cart-arrow-down"></i>
							</a>
						</div>																					
					</div>
				</div>
			</div>
        
    </main><!-- End .main -->
@endsection