@extends('admin.layout.master')
@section('main_section')

    <div class="container-xxl flex-grow-1 container-p-y">
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
                    <h4 class="mb-3">Press/Pr</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fa fa-plus-circle me-2"></i> Add New Press Piece
                    </button>
                </div>
            </div>
           
            <div class="table-responsive card-body">

                <table class="table table-hover table-border-bottom-0" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Title</th>
                                <th>Date</th>
                                {{-- <th>Slug</th> --}}
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($noBlogs)
                            <tr >
                                <td colspan="7" class="text-center">No Press/Pr available</td>
                            </tr>
                            @else
                            @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->date->format('Y-m-d') }}</td>
                                {{-- <td>{{ $blog->slug }}</td> --}}
                                
                                <td class="text-center">
                                    @if($blog->images->isNotEmpty())
                                        @foreach ($blog->images as $image)
                                            <img src="{{ asset('storage/' . $image->imagename) }}" alt="Blog Image" class="img-fluid avatar-sm rounded">
                                        @endforeach
                                    @else
                                        <p>No Image Available</p>
                                    @endif
                                </td>
                                <td>{{ Str::words($blog->description, 10) }}..</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <button class="btn rounded-pill btn-primary btn-sm edit-user-btn edit-btn me-2"
                                        data-id="{{ $blog->id }}"
                                        data-title="{{ $blog->title }}"
                                        data-date="{{ $blog->date->format('Y-m-d') }}"
                                        data-image-name="{{ $blog->images->isNotEmpty() ? $blog->images->first()->imagename : '' }}"
                                        
                                        data-category="{{ $blog->category }}"
                                        data-description="{{ $blog->description }}"
                                         data-pulished-by="{{ $blog->published_by }}"
                                         data-press-link="{{ $blog->press_link }}"
                                        data-bs-toggle="modal" data-bs-target="#editBlogModal">
                                        <i class="fa fa-edit m-0"></i>
                                    </button>

                                    <form action="{{ route('press.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded-pill btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash m-0"></i>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
          
        </div>
    </div>

    
<!-- Add Blog Modal -->
<div id="addBlogModal" class="modal fade" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlogModalLabel">Add NEW PRESS PIECE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBlogForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                        <div class="invalid-feedback" id="title-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" required>
                        <div class="invalid-feedback" id="date-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="blog_image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="blog_image[]" id="blog_image" required>
                        <small class="form-text text-muted">Upload up to 10 MB per image. Accepted formats: JPEG, PNG, JPG, GIF.</small>
                        <div class="invalid-feedback" id="blog_image-error"></div>
                    </div>
                   
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_name" id="category" class="form-control" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                            <option value="other">Other (Please specify)</option> <!-- Option for custom category -->
                        </select>
                        <div class="invalid-feedback" id="category-error"></div>

                        <!-- Input field for new category, hidden by default -->
                        <div id="newCategoryContainer" style="display: none;">
                            <label for="new_category" class="form-label">New Category</label>
                            <input type="text" name="new_category" id="new_category" class="form-control" placeholder="Enter new category">
                            <div class="invalid-feedback" id="new_category-error"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="8" class="form-control" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="published_by" class="form-label">Published by</label>
                        <input type="text" class="form-control" name="published_by" id="published_by">
                        <div class="invalid-feedback" id="published_by-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="press_link" class="form-label">Press Link</label>
                        <input type="url" name="press_link" id="press_link" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add PRESS & PIECE</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Edit Blog Modal -->
<div id="editBlogModal" class="modal fade" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">Edit Press & Pr</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBlogForm"  enctype="multipart/form-data" method="POST" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editBlogId" name="blog_id">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" id="editTitle" name="title" class="form-control" required>
                            <div class="invalid-feedback" id="editTitle-error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="editDate" class="form-label">Date</label>
                            <input type="date" id="editDate" name="date" class="form-control" required>
                            <div class="invalid-feedback" id="editDate-error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="editCategory" class="form-label">Category</label>
                            <select name="category_name" id="editCategory" class="form-control" required>
                                <option value="" disabled>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="edit-category-error"></div>
                        </div>

                        <div class="col-md-4 mb-3" style="display: flex; flex-direction: column;">
                            <label class="form-label">Current Image</label>
                            <img id="currentBlogImage" src="" alt="No Image Available" class="img-fluid avatar-sm rounded mb-2" style="height: 5rem; width:7rem">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="editBlogImage" class="form-label">Upload New Image</label>
                            <input class="form-control" id="editBlogImage" name="blog_image" type="file">
                            <small class="form-text text-muted">Upload up to 10 MB per image. Accepted formats: JPEG, PNG, JPG, GIF.</small>
                            <div class="invalid-feedback" id="editBlogImage-error"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea id="editDescription" name="description" rows="8" class="form-control" ></textarea>
                            {{-- <div class="invalid-feedback" id="editDescription-error"></div> --}}
                        </div>
                        <div class="mb-3">
                            <label for="editPublishedBy" class="form-label">Published by</label>
                            <input type="text" class="form-control" name="published_by" id="editPublishedBy">
                            <div class="invalid-feedback" id="published_by-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editPressLink" class="form-label">Press Link</label>
                            <input type="url" name="press_link" id="editPressLink" class="form-control">
                        </div>
                        <div class="col-md-12 my-3">
                            <button class="btn btn-primary" type="submit">Update Press and Pr</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea#description',
        width: '100%',
        height: 300,
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 
            'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 
            'insertdatetime', 'media', 'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px; }'
    });
 
   // TinyMCE initialization function for both editors
    function initializeTinyMCE(selector) {
        tinymce.init({
            selector: selector,
            width: '100%',
            height: 300,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 
                'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 
                'insertdatetime', 'media', 'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons',
            menu: {
                favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table',
            content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px; }'
        });
    }

    // Initialize TinyMCE for the 'description' editor only once on page load
    initializeTinyMCE('textarea#description');
</script>

    <script>
        // Listen for changes to the category dropdown
        document.getElementById('category').addEventListener('change', function () {
            const newCategoryContainer = document.getElementById('newCategoryContainer');
            const categoryValue = this.value;
    
            if (categoryValue === 'other') {
                // Show the input field for custom category
                newCategoryContainer.style.display = 'block';
            } else {
                // Hide the input field if 'Other' is not selected
                newCategoryContainer.style.display = 'none';
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editBlogModal = new bootstrap.Modal(document.getElementById('editBlogModal'));
    
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const blogId = button.getAttribute('data-id');
                    const title = button.getAttribute('data-title');
                    const date = button.getAttribute('data-date');
                    const imageName = button.getAttribute('data-image-name');
                    const category = button.getAttribute('data-category');
                    const description = button.getAttribute('data-description');
                    const publishedBy=button.getAttribute('data-pulished-by');
                    const pressLink=button.getAttribute('data-press-link');
    
                    // Populate the modal form fields
                    document.getElementById('editBlogId').value = blogId;
                    document.getElementById('editTitle').value = title;
                    document.getElementById('editDate').value = date;
                    //document.getElementById('editDescription').value = description;
                    document.getElementById('editPublishedBy').value =  publishedBy;
                    document.getElementById('editPressLink').value =  pressLink;

                    // Set the selected category in the dropdown
                    const editCategorySelect = document.getElementById('editCategory');
                    for (const option of editCategorySelect.options) {
                        option.selected = option.value.toLowerCase().trim() === category.toLowerCase().trim();
                    }
    
                     // Set the form's action URL using the blog ID
            const editBlogForm = document.getElementById('editBlogForm');
            editBlogForm.action = `{{ route('press.update', '') }}/${blogId}`;

            
                // Display current image or placeholder
                const currentBlogImage = document.getElementById('currentBlogImage');
                const currentImageName = document.getElementById('currentImageName');
                if (imageName) {
                    currentBlogImage.src = `{{ asset('storage') }}/${imageName}`;
                   // currentImageName.textContent = imageName;
                } else {
                    currentBlogImage.src = ""; // Blank or placeholder
                    currentImageName.textContent = "No Image Available";
                }
                    // Show the modal
                    if (tinymce.get('editDescription')) {
                        tinymce.get('editDescription').remove();
                    }
        
                    // Initialize TinyMCE for editDescription
                    initializeTinyMCE('textarea#editDescription');        
        
                    // Wait for TinyMCE to be initialized, then set the content
            const checkTinyMCEReady = setInterval(() => {
                if (tinymce.get('editDescription')) {
                    clearInterval(checkTinyMCEReady);  // Stop checking once TinyMCE is ready
                    tinymce.get('editDescription').setContent(description); // Set the content
                }
            }, 100); // Check every 100ms if TinyMCE is ready
        
                    // Show the modal
                    editBlogModal.show();
                
                });
            });
        });
    </script>


<script>
    $(document).ready(function() {
        // Open the modal if validation errors exist
        $('#addBlogForm').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission
            
            var formData = new FormData(this); // Get form data

            // Clear previous error messages
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');

            $.ajax({
                url: '{{ route('press.store') }}', // Replace with the correct route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Success message or redirection
                
                    if (response.success) {
                            $('#addBlogModal').modal('hide'); // Close the modal
                            toastr.success('Press added successfully!');
                            window.location.href = response.redirect_url; //
                    }
                },
                error: function(xhr) {
                    // If validation fails, show errors
                    if (xhr.status === 422) {  // Validation error
                        var errors = xhr.responseJSON.errors;

                        // Iterate through the errors and display them
                        for (var field in errors) {
                            // Handle category_name errors
                            if (field === 'category_name') {
                                $('#' + field).addClass('is-invalid');  // Add invalid class to category_name
                                $('#' + field + '-error').text(errors[field][0]);
                            }

                            // Handle new_category errors
                            if (field === 'new_category') {
                                $('#' + field).addClass('is-invalid');  // Add invalid class to new_category
                                $('#' + field + '-error').text(errors[field][0]);

                                // If 'Other' is selected, show the input field for the new category
                                if ($('#category').val() === 'other') {
                                    $('#newCategoryContainer').show();  // Show the new category input field
                                }
                            }

                            // Handle blog_image errors
                            if (field === 'blog_image') {
                                $('#' + field).addClass('is-invalid');  // Add invalid class to blog_image
                                $('#' + field + '-error').text(errors[field][0]);
                            }
                        }
                    }
                }
            });
        });
    });

</script>



@endsection 