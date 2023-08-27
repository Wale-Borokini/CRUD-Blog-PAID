<header class="header">
    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="demo4.html" class="logo">
                    <img src="{{ asset('assets/images/logo.png') }}" width="111" height="44" alt="Porto Logo">
                </a>
            </div><!-- End .header-left -->

            @if (Auth::check())
                <div class="header-right  w-auto pl-0 mr-5">
                    <button class="btn btn-md btn-info font-weight-bold" type="button"><strong>${{Auth::user()->credit_balance}}</strong></button>
                    {{-- <p class="float-right"></p> --}}
                </div><!-- End .header-right -->
            @endif
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu d-flex justify-content-between align-items-center">
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
                            <a href="#">Change Password</a>
                        </li>

                    @endif

                    <li>
                        <a href="{{ route('create-post') }}">Post Ad</a>
                    </li>                    
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <li>
                            <a href="{{ route('admin-dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endif                        
                    {{-- Right side of Nav --}}
                    @guest
                        @if (Route::has('login'))
                            <li class="ml-auto">
                                <a href="{{ route('login') }}">Log in</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="">
                                <a href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @endif
                        
                    @else
                        <li class="ml-auto">
                            <a  href="{{ route('logout') }}"
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
            </nav>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->