@extends('layouts.app')

@section('content')

    <main class="min-height-page main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">					
                <h1>Adverts ({{$adverts->count()}})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('admin-dashboard')}}" class="btn btn-outline-dark btn-md">Admin Dashboard</a>                
            </div>
            <div class="text-center mt-1">
                <a href="{{route('adverts.create')}}" class="btn btn-outline-info btn-md">Add Advert</a>                
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
                                <th>Description</th>
                                <th>Brand</th>
                                <th>Advert URL</th>
                                <th>Added By</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adverts as $advert)
                                <tr>
                                    <td>
                                        <img src="{{ asset($advert->image_url) }}" alt="Image" height="200" width="250">
                                    </td>
                                    <td>{{ $advert->title }}</td>	
                                    <td>{{ $advert->description }}</td>	
                                    <td>{{ $advert->brand }}</td>	                                    							
                                    <td>{{ str_limit(strip_tags($advert->advert_url), 50)	 }}</td>
                                    <td>{{ $advert->added_by }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('adverts.edit', $advert->id) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form" action="{{ route('adverts.destroy', $advert->id) }}" method="post">
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