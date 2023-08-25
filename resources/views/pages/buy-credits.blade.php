@extends('layouts.app')

@section('content')
    <main class="min-height-page main main-test">
        <div class="container checkout-container mt-4">                               
            <div class="row">                    
                <div class="col-lg-12">
                    <div class="order-summary">                            

                        <div class="payment-methods">                                
                            <div class="">
                                <p>
                                    <strong>
                                        We have your personal Bitcoin wallet. Any amount that you send to your Bitcoin Wallet will be credited to your account automatically
                                    </strong>
                                </p>                                
                                <p class="bg-warning text-white p-2 col-lg-4">
                                    <strong>
                                        Your remaining credit balance is: ${{Auth::user()->credit_balance}}
                                    </strong>
                                </p>
                                <p>Check all your payment transactions here</p>                                                                            
                            </div>
                        </div>

                        <a href="{{ route('buy-credits-code') }}" class="btn btn-dark btn-place-order" form="checkout-form">
                            Buy Credits
                        </a>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->
@endsection