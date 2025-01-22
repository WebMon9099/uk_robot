@extends('admin.layout.master')
@section('main_section')

    <div class="container-p-y">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-3">Category</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fa fa-plus-circle me-2"></i> Add Category
                    </button>
                </div>
            </div>
  
            <div class="table-responsive card-body">
                <table class="table table-hover table-border-bottom-0" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Category</th>  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogcategories as $blogcategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blogcategory->category }}</td>
                                 
                                <td>
                                    <button 
                                        class="btn rounded-pill btn-primary btn-sm edit-user-btn edit-btn" 
                                        data-id="{{ $blogcategory->id }}" 
                                        data-name="{{ $blogcategory->category }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCategoryModal">
                                        <i class="fa fa-edit m-0"></i>
                                    </button> 
                                     <button class="btn rounded-pill btn-danger btn-sm" data-id="{{ $blogcategory->id }}">
                                        <i class="fa fa-trash m-0"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No blog categories available</td>
                            </tr>
                        @endforelse
                            
                        </tbody>
                    </table>
                   
                </div>
            
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal fade" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category" id="category" required>
                            <small class="form-text text-muted">Category must be unique</small>
                            <div class="invalid-feedback" id="category-error"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Edit Category Modal -->
<div id="editCategoryModal" class="modal fade" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCategoryId" name="category_id">

                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="text" id="editCategoryName" name="name" class="form-control" required>
                        <small class="form-text text-muted">Category must be unique</small>
                        <div class="invalid-feedback" id="edit-category-error"></div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Handle form submission via AJAX
    $('#addCategoryForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the category name from the input
        var categoryName = $('#category').val();

        // Get the submit button
        var submitButton = $('button[type="submit"]');
        
        // Disable the submit button to prevent multiple submissions
        submitButton.prop('disabled', true);

        // Check if the category name is empty
        if (categoryName.trim() === "") {
            toastr.error("Please enter a category name", "Error"); // Use Toastr for error
            submitButton.prop('disabled', false); // Re-enable the submit button
            return;
        }

        // Clear any previous error message
        $('#category-error').text('').removeClass('text-danger');

        // Perform AJAX request
        $.ajax({
            url: "{{ route('category.store') }}", // Use the Laravel route helper to get the URL
            method: 'POST',
            data: {
                category: categoryName,
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
            },
            success: function(response) {
                // Check if the response success value is true
                if (response.success) {
                    // Display a success toast
                    toastr.success('Category added successfully!', 'Success');
                    
                    // Close the modal
                    $('#addCategoryModal').modal('hide');
                    location.reload();
                   
                } else {
                    // If response.success is false, show the error message in the invalid-feedback div
                    $('#category-error').text(response.message).addClass('text-danger');  // Display error in red text
                    $('#category').addClass('is-invalid');  // Add 'is-invalid' class to the input field
                }
            },
            error: function(xhr, status, error) {
                // If the category is not unique, display a toast error message
                if (xhr.status === 422) {
                    toastr.error('Category must be unique', 'Validation Error');
                } else {
                    toastr.error('An error occurred', 'Error');
                }
            },
            complete: function() {
                // Re-enable the submit button after the response is received
                submitButton.prop('disabled', false);
            }
        });
    });


    // Edit category 

    $(document).on('click','.edit-btn',function(){
        var categoryId = $(this).data('id');
        var categoryName = $(this).data('name');

        $('#editCategoryId').val(categoryId);
        $('#editCategoryName').val(categoryName);
    })

$('#editCategoryForm').on('submit', function(event) {
    event.preventDefault();

    var categoryId = $('#editCategoryId').val();
    var categoryName = $('#editCategoryName').val();

    var submitButton = $('button[type="submit"]');
    
    // Disable the submit button to prevent multiple submissions
    submitButton.prop('disabled', true);

    // Check if the category name is empty
    if (categoryName.trim() === "") {
        toastr.error("Please enter a category name", "Error");
        submitButton.prop('disabled', false);
        return;
    }

    // Clear any previous error message
    $('#edit-category-error').text('').removeClass('text-danger');

    $.ajax({
        url: "{{ route('category.update', '') }}/" + categoryId,
        type: 'PUT',
        data: {
            name: categoryName,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                $('#editCategoryModal').modal('hide');
                toastr.success('Category updated successfully!', 'Success');
                location.reload();  // Reload page to reflect changes
            } else {
                $('#edit-category-error').text(response.message).addClass('text-danger');
                $('#editCategoryName').addClass('is-invalid');
            }
        },
        error: function(xhr) {
            toastr.error('An error occurred while trying to update the category.', 'Error');
        },
        complete: function() {
            submitButton.prop('disabled', false);
        }
    });
});









    // delete the category 
    var categoryIdToDelete = null;

    $(document).on('click','.delete-btn', function(){      
        categoryIdToDelete = $(this).data('id');
        $('#deleteConfirmationModal').modal('show');
        

    });

    $(document).on('click', '#confirmDeleteBtn', function(){
        if(categoryIdToDelete){

            $.ajax({
                url: "{{route('category.destroy','')}}/"+ categoryIdToDelete,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if(response.success){

                        $('#deleteConfirmationModal').modal('hide');
                        // Show a success message
                        toastr.success('Category deleted successfully!', 'Success');

                        location.reload();
                         // Remove the category row from the table
                        //  $('button[data-id="' + categoryIdToDelete + '"]').closest('tr').remove();
                    }else{
                        toastr.error('Failed to delete the category', 'Error');
                    }
                },
                error: function(xhr) {
                        toastr.error('An error occurred while trying to delete the category.', 'Error');
                }
            });
        }
    });
</script>




@endsection 