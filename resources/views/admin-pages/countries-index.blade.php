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
                <h1>All Countries ({{ $totalCountriesCount }})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('add-locations')}}" class="btn btn-outline-dark btn-md">Locations</a>                
            </div>
            <div class="text-center mt-1">                
                <a href="{{route('countries.create')}}" class="btn btn-outline-success btn-md">Add Country</a>
            </div>  
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>State Count</th>
                                <th>City Count</th>
                                <th>Post Count</th>
                                <th>Added By</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$country->name}}</td>
                                    <td>{{$country->states_count}}</td>	
                                    <td>{{$country->cities_count}}</td>	
                                    <td>{{$country->posts_count}}</td>									
                                    <td>{{$country->added_by}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('countries.show', $country->slug) }}">Details</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('countries.edit', $country->slug) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form d-inline" action="{{ route('countries.destroy', $country->slug) }}" method="post">
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