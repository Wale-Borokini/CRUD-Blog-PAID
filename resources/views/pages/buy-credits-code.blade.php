@extends('layouts.app')

@section('content')
<style>
    .disabled-input {
        background-color: #f5f5f5; /* Apply a disabled background color */
        pointer-events: none; /* Disable pointer events to prevent interactions */
    }
</style>
    <main class="min-height-page main main-test">
        <div class="container checkout-container mt-4">                               
            <div class="row">                    
                <div class="col-lg-5 d-flex flex-column">
                    <div class="order-summary flex-fill">                            

                        <div class="">                                
                            <div class="">
                                <p class="text-danger">
                                    <strong>
                                        Important! The minimum payment is {{number_format($wallet->amount, 4)}}BTC. Anything below 0.0025BTC won't be credited to your account. Please check Bitcoin address every time when buying credits as address is changed sometimes.
                                    </strong>
                                </p>                               
                                <p>
                                    <strong>
                                        Your credits will be credited once the transaction is confirmed by our Bitcoin system. It usually takes several minutes, but can take up to an hour. The current market BTC to USD conversion rate will be used. We don't charge any fees.
                                    </strong>
                                </p>                                
                            </div>
                        </div>                            
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-6 -->
                <div class="col-lg-7 d-flex flex-column">
                    <div class="order-summary flex-fill">                            
                        <div class="">                                
                            <div class="">
                                <p>
                                    <strong>
                                        Please send only Bitcoin to the address below, other cryptocurrency is not accepted
                                    </strong>
                                </p>
                                <div class="mt-0 mb-2 col-12">
                                    <input type="text" value="{{$wallet->btc_address}}" class="col-9 dicabled-input" id="copyText" readonly>
                                    <button class="btn btn-sm btn-success" onclick="copyToClipboard()">Copy</button>
                                </div>

                                <p>
                                    <strong>
                                        Scan the below QR code with your wallet app or print this code to use at the ATM/Exchange
                                    </strong>
                                </p>
                                                                                                           
                            </div>
                        </div>                        
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-6 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->

    <script>
         function copyToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("copyText");

            /* Select the text inside the text field */
            copyText.select();

            /* Copy the text inside the text field to the clipboard */
            document.execCommand("copy");

            /* Highlight the selected text */
            copyText.setSelectionRange(0, copyText.value.length);
           
            // Show SweetAlert notification
            Swal.fire({
                icon: 'success',
                title: 'Wallet Address Copied',
                text: 'The wallet address has been copied to your clipboard.',
                timer: 4000,
                showConfirmButton: true // Hide the "OK" button
            });

            
            trackPageVisitAndButtonClicked('Yes');
            
        }

         // Function to track the page visit and button click
        function trackPageVisitAndButtonClicked(copiedTextValue) {
            // Generate the URL for the named route using route() helper
            const url = "{{ route('log-page-visit') }}";

            // Send an HTTP request to the generated URL
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Replace with your CSRF token
                },
                body: JSON.stringify({ copied_text: copiedTextValue }),
            });
        }

        // Track the page visit when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Assume the user did not click the button by default
            trackPageVisitAndButtonClicked('No');
        });

        
    </script>
@endsection