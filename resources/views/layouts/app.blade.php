<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{{$title ?? 'Patron Castle'}}</title>

	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Porto - Bootstrap eCommerce Template">
	<meta name="author" content="SW-THEMES">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icons/favicon.png') }}">

	 <!-- Include SweetAlert2 CSS and JS -->
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
	<!-- CKEditor -->	 
	 <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

	 <!-- recaptcha -->
	 {!! NoCaptcha::renderJs() !!}
	 

	
	<script>
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400' ] }
		};
		( function ( d ) {
			var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
			wf.src = '{{ asset('assets/js/webfont.js') }}';
			wf.async = true;
			s.parentNode.insertBefore( wf, s );
		} )( document );
	</script>

	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

	<!-- Main CSS File -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

	{{-- Custom css styles --}}
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
</head>

<body>
	<div class="page-wrapper">
		<!-- Main Content -->
        <div id="app">
            @include('inc.header')
                @yield('content')
            @include('inc.footer')			
			@include('sweetalert::alert')  
        </div>
		
	</div><!-- End .page-wrapper -->

	<div class="loading-overlay">
		<div class="bounce-loader">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="fa fa-times"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu">
					<li class="">
						<a class="text-left btn btn-warning" href="{{ route('create-post') }}">Post Ad</a>
					</li>
					
					<li>
						<a href="{{ route('index') }}">Home</a>
					</li>
					
					@if (Auth::check())

						<li>
							<a href="{{ route('profile') }}">My Profile</a>
						</li>

						<li>
							<a href="{{ route('buy-credits') }}">Buy Credits</a>
						</li>

						<li>
							<a href="{{ route('password.request') }}">Change Password</a>
						</li>

					@endif

					@can('viewAdminDashboard', Auth::user())
						<li>
							<a href="{{ route('admin-dashboard') }}">Admin Dashboard</a>
						</li>
					@endcan
					
					@guest
                        @if (Route::has('login'))
							<li>
								<a href="{{ route('login') }}">Login</a>
							</li>
						@endif

						@if (Route::has('register'))
							<li>
								<a href="{{ route('register') }}">Sign Up</a>
							</li>
						@endif
					
					@else	
						<li>
							<a class="text-left btn btn-danger"  href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
							</a>
						</li>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					@endguest					
				</ul>
				<ul class="mobile-menu">
					
				</ul>
			</nav><!-- End .mobile-nav -->
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins.min.js') }}"></script>

	<!-- Main JS File -->
	<script src="{{ asset('assets/js/main.min.js') }}"></script>
    
</body>

</html>