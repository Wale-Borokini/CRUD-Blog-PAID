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
                <h1>Wallet Address</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('transaction-menu')}}" class="btn btn-outline-dark btn-md">Transaction Menu</a>                
            </div>
            <div class="text-center mt-1">                
                <a href="{{route('wallets.create')}}" class="btn btn-outline-success btn-md">Add Wallet Address</a>
            </div>  
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>BTC Address</th>
                                <th>Amount</th>
                                <th>BTC Service</th>
                                <th>Added By</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($walletaddresses as $walletaddress)
                                <tr>
                                    <td>
                                        <img src="{{ asset($walletaddress->image_url) }}" alt="Image" height="50" width="90">
                                    </td>
                                    <td>{{ $walletaddress->title }}</td>	
                                    <td>{{ $walletaddress->btc_address }}</td>	
                                    <td>{{ $walletaddress->amount }}</td>									
                                    <td>{{ $walletaddress->btc_service }}</td>
                                    <td>{{ $walletaddress->added_by }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('wallets.edit', $walletaddress->id) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form" action="{{ route('wallets.destroy', $walletaddress->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')                                        
                                            <button type="submit" class="delete-button btn btn-danger btn-sm">Delete</button>
                                        </form>     
                                    </td>                         
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
        
    </main><!-- End .main -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(deleteForm => {
                const deleteButton = deleteForm.querySelector('.delete-button');
                const confirmMessage = deleteButton.getAttribute('data-confirm');

                deleteForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    Swal.fire({
                        title: 'Confirm Deletion',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Delete'
                    }).then(result => {
                        if (result.isConfirmed) {
                            // Proceed with form submission
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection