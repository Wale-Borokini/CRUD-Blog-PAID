@extends('layouts.app')

@section('content')
    <main class="min-height-page main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Explore</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">					
            <div class="blog-section row">
                @foreach ($unitedStates->states as $state)                               
                    <div class="col-lg-2">                        
                        <article class="post">						
                            <div class="post-body">
                                <h2 class="post-title">
                                    {{ $state->name }}
                                </h2>
                                <div class="post-content">
                                    @foreach ($state->cities as $city)                                        
                                        <a href="{{ route('city.show-posts', $city->slug) }}"><p>{{$city->name}}</p></a> 
                                    @endforeach                                       
                                </div><!-- End .post-content -->								
                            </div><!-- End .post-body -->
                        </article><!-- End .post -->
                    </div>
                @endforeach       
            </div>															
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection
       
