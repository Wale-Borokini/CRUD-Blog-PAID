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
                <h1>All Hair Colors ({{ $hairs->count() }})</h1>
            </div>
            <div class="text-center mt-1">
                <a href="{{route('personal-attributes')}}" class="btn btn-outline-dark btn-md">Personal Atributes</a>                
            </div> 
            <div class="text-center mt-1">                
                <a href="{{route('hairs.create')}}" class="btn btn-outline-success btn-md">Add Hair Color</a>
            </div>
        </div>

        
        <div class="container account-container custom-account-container">
            <div class="row">					
                <div class="col-lg-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Hair Color</th>                                
                                <th>Added By</th>                                
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hairs as $hair)
                                <tr>
                                    <td><strong>{{$hair->name}}</strong></td>                                    								
                                    <td>{{$hair->added_by}}</td>                                    
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('hairs.edit', $hair->slug) }}">Edit</a></td>
                                    <td>
                                        <form class="delete-form" action="{{ route('hairs.destroy', $hair->slug) }}" method="post">
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