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
                <h1>All States</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('add-locations')}}" class="btn btn-outline-dark btn-md">Locations</a>                
            </div> 
            <div class="text-center mt-1">                
                <a href="{{route('states.create')}}" class="btn btn-outline-success btn-md">Add State</a>
            </div>
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>                                
                                <th>State</th>
                                <th>Country</th>                               
                                <th>City Count</th>
                                <th>Post Count</th>
                                <th>Added By</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>                                 
                                                                            

                            @foreach($states as $state)
                                <tr>                                    
                                    <td><strong>{{$state->name}}</strong></td> 
                                    <td>{{$state->country->name}}</td>                                    	
                                    <td>{{$state->cities_count}}</td>	
                                    <td>{{$state->posts_count}}</td>									
                                    <td>{{$state->added_by}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('states.show', $state->slug) }}">Details</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('states.edit', $state->slug) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form" action="{{ route('states.destroy', $state->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')                                        
                                            <button type="submit" class="delete-button btn btn-danger btn-sm">Delete</button>
                                        </form> 
                                    </td>                         
                                </tr>
                            @endforeach                                                        
                        </tbody>
                    </table>                    
                        {{ $states->links() }}                                     
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