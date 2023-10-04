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
                @if($search)
                    <h1>Search Result ({{$cities->count() }})</h1>
                @else
                    <h1>All Cities ({{ $totalCitiesCount}})</h1>
                @endif
            </div>
            <div class="text-center mt-1">
                <a href="{{route('add-locations')}}" class="btn btn-outline-dark btn-md">Locations</a>                
            </div> 
            <div class="text-center mt-1">                
                <a href="{{route('cities.create')}}" class="btn btn-outline-success btn-md">Add City</a>
            </div>
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="{{ route('cities.index') }}" method="GET">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search users...">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                            @if(isset($search))
                                <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                            @endif
                        </form>                        
                    </div>
                    <table class="table text-center table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>State</th>                               
                                <th>Country</th>
                                <th>Post Count</th>
                                <th>Added By</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td><strong>{{$city->name}}</strong></td>
                                    <td>{{$city->state->name}}</td> 
                                    <td>{{$city->country->name}}</td>                                    	                                    	
                                    <td>{{$city->posts_count}}</td>									
                                    <td>{{$city->added_by}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{ route('cities.show', $city->slug) }}">Details</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('cities.edit', $city->slug) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form d-inline" action="{{ route('cities.destroy', $city->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')                                        
                                            <button type="submit" class="delete-button btn btn-danger btn-sm">Delete</button>
                                        </form> 
                                    </td>                         
                                </tr>
                            @endforeach         
                        </tbody>
                    </table>
                    {{ $cities->links() }} 
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