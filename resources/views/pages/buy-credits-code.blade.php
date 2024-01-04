@extends('layouts.app')

@section('content')
<style>
    .disabled-input {
        background-color: #f5f5f5; /* Apply a disabled background color */
        pointer-events: none; /* Disable pointer events to prevent interactions */
    }
    
    ol {
        list-style-type: numbers;
        margin-left: 20px;
    }

    li {
        margin-bottom: 5px;
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
                                        Important Notice: The minimum payment requirement is {{number_format($wallet->amount, 4)}} BTC. Any amount below this threshold will not be credited to your account. It is crucial to verify your Bitcoin address each time you purchase credits, as the address may undergo changes.                                        
                                    </strong>
                                </p>         
                                
                                <p>
                                    <strong>After payment has been made, send an email to <span class="text-danger">payment@patroncastle.com</span> with the below details:</strong>
                                </p>
                                <ol>                                
                                    <li><strong>Your Username</strong></li>                                    
                                    <li><strong>Credit Amount Purchased</strong></li>
                                    <li><strong>Screenshot of Payment on your BTC App</strong></li>                                       
                                </ol>                    
                                
                                
                                <p>
                                    <strong>
                                        Your credits will be added to your account after the Bitcoin transaction is confirmed by our system. Typically, this process takes a few minutes, although it may extend up to an hour. The prevailing market conversion rate from BTC to USD will be applied, and please note that we do not impose any fees.
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
                                        Kindly remit Bitcoin (BTC) exclusively to the provided address; we do not accept any other forms of cryptocurrency.
                                    </strong>
                                </p>
                                <div class="mt-0 mb-2 col-12">
                                    <input type="text" value="{{$wallet->btc_address}}" class="col-9 dicabled-input" id="copyText" readonly>
                                    <button class="btn btn-sm btn-success" onclick="copyToClipboard()">Copy</button>
                                    <p class="mt-1">{{ $wallet->btc_address }}</p>
                                </div>

                                <p>
                                    <strong>
                                        Or You can scan the QR code below using your wallet application.
                                    </strong>
                                </p><img style="height:200px;" src="{{asset($wallet->image_url)}}" width="200" alt="bar-code" />

                                <div>

                                </div>
                                                                                                           
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