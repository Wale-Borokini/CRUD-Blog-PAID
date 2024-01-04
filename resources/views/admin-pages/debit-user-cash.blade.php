@extends('layouts.app')

@section('content')

<main class="min-height-page main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">					
            <h1>Debit User</h1>
        </div>
        <div class="text-center mt-1">
            <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
        </div> 
        <div class="text-center mt-1">
            <a href="{{route('transaction-menu')}}" class="btn btn-outline-info btn-md">Transaction Menu</a>                
        </div>              
    </div>
    <div class="container">                
        <div class="product-single-container product-single-default mt-4 mb-2">                    
            <div class="row">                        
                <div class="col-lg-12 col-md-6 product-single-details">
                    <div class="mt-2">
                        <h4>Username: <span class="bg-light">{{$user->username}}</span></h4>
                        <h4>Email: <span class="bg-light">{{$user->email}}</span></h4>
                    </div>
                    <div class="price-box">                                
                        <h2>Balance: ${{$user->credit_balance}}</h2>
                    </div>                            
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <button class="btn btn-secondary btn-ellipse btn-xs" disabled>Debit</button>
                            </div>

                            <form id="debit-form" method="POST" action="{{ route('admin.debit.user', $user->slug) }}">
                                @csrf
                                <label for="amount">
                                    Enter an Amount
                                    <span class="required">*</span>
                                </label>
                                <input name="amount" type="number" step="0.01"  class="form-control @error('amount') is-invalid @enderror" required/>
                                @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        Debit
                                    </button>
                                </div>									
                            </form>
                        </div>                              
                    </div>
                    <hr class="short-divider">
                    <div class="mt-2">
                        <div class="mt-0">
                            <h3>Profile Summary</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="single-info-list">                                            
                                    <li>
                                        <strong>Number of Posts: </strong>{{$user->posts_count}}
                                    </li> 
                                    <li>
                                        <strong>Joined, </strong>{{$user->created_at->diffForHumans()}}
                                    </li>                                            
                                </ul>
                                @if($user->posts_count > 0)
                                    <div class="col-12 mt-2 mb-2">
                                        <a class="btn btn-dark btn-lg" href="{{ route('users-posts', $user->slug) }}">View Posts</a>
                                    </div>
                                @endif
                            </div>                                                                       
                        </div>                                                                              
                    </div>                                                                                                   
                    <hr class="divider mb-0 mt-0">                                                       
                </div>                                                
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->                                              
    </div>
    <!-- End .container -->
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const creditForm = document.getElementById('debit-form');
                   
        creditForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Confirm Debit',
                text: 'Are you sure you want to debit this user?',
                icon: 'danger',
                showCancelButton: true,
                confirmButtonText: 'Yes, debit!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    this.submit();
                }
            });
        });
    });
</script>
    
@endsection