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
                <h1>Admin Roles</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>              
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="{{ route('search-users-roles') }}" method="GET">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search users...">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                            @if(isset($searchTerm))
                                <a href="{{ route('admin-roles') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                            @endif
                        </form>                        
                    </div>
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Credit Balance</th>
                                <th>Admin</th>
                                <th>Super Admin</th> 
                                <th>Details</th>
                                <th>Date Joined</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><strong>{{$user->username}}</strong></td>
                                    <td>{{$user->email}}</td>	
                                    <td>{{$user->credit_balance}}</td>	
                                    <td>
                                       
                                        <form class="d-inline" method="POST" action="{{ route('update-admin-role', $user->slug) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="confirm-admin btn btn-ellipse btn-xs {{ $user->is_admin ? 'btn-success' : 'btn-default' }}"
                                                data-user-name="{{$user->username}}" data-is-admin="{{$user->is_admin == 1}}">{{$user->is_admin ? 'Yes' : 'No'}}</button>
                                            <input type="hidden" name="is_admin" value="{{$user->is_admin ? '0' : '1'}}">
                                        </form>
                                    </td>									
                                    <td>
                                        @if ($user->is_super_admin)
                                            <button href="#" class="btn btn-success btn-ellipse btn-xs" disabled>Yes</button>
                                        @else
                                            <button href="#" class="btn btn-default btn-ellipse btn-xs" disabled>No</button>
                                        @endif
                                    </td>
                                    <td><a class="btn btn-info btn-xs" href="{{ route('user-details', $user->slug) }}">Details</a></td> 
                                    <td>{{$user->created_at->diffForHumans()}}</td>
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
        document.addEventListener('DOMContentLoaded', function () {
        const confirmAdminButtons = document.querySelectorAll('.confirm-admin');

        confirmAdminButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userName = this.getAttribute('data-user-name');
                const isAdmin = this.getAttribute('data-is-admin');
                const action = isAdmin ? 'removal' : 'grant';

                Swal.fire({
                    title: `Confirm ${action}`,
                    text: `Are you sure you want to ${action === 'removal' ? 'remove' : 'grant'} admin role for ${userName}?`,
                    icon: `${action === 'removal' ? 'error' : 'warning'}`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form
                        const form = this.closest('form');
                        form.submit();
                    }
                });
            });
        });
    });        
    </script>
@endsection