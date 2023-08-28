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
                <h1>All Users</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>              
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Credit Balance</th>
                                <th>Admin</th>
                                <th>Super Admin</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><strong>{{$user->username}}</strong></td>
                                    <td>{{$user->email}}</td>	
                                    <td>{{$user->credit_balance}}</td>	
                                    <td>
                                        @if ($user->is_admin)
                                            <button class="btn btn-success btn-ellipse btn-xs" disabled>Yes</button>
                                        @else
                                        <button class="btn btn-default btn-ellipse btn-xs" disabled>No</button>
                                        @endif
                                    </td>									
                                    <td>
                                        @if ($user->is_super_admin)
                                            <button class="btn btn-success btn-ellipse btn-xs" disabled>Yes</button>
                                        @else
                                        <button class="btn btn-default btn-ellipse btn-xs" disabled>No</button>
                                        @endif
                                    </td>
                                    <td><td><a class="btn btn-success btn-sm" href="{{ route('user-details', $user->slug) }}">Details</a></td></td>                                                        
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                    {{ $users->links() }} 
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