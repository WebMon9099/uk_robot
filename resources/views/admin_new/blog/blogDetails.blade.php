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
                    <h4 class="mb-3">Blogs</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fa fa-plus-circle me-2"></i> Add New Blog Piece
                    </button>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap card-body">

                <table class="table table-hover table-border-bottom-0" id="Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Sno</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Illuminate\Support\Str::words($blog->title,3, '...') }}</td>
                                <td>{{ $blog->date->format('Y-m-d') }}</td>
                                <td class="text-center">
                                @if ($blog->images->isNotEmpty())
                                    @php
                                        $image = $blog->images->first();
                                    @endphp
                                    <img src="{{ asset('storage/' . $image->imagename) }}" alt="Blog Image" class="img-fluid avatar-sm rounded">
                                @else
                                    <p>No Image Available</p>
                                @endif
                                </td>
                                <td>{{ Str::words($blog->description,3) }}..</td>
                                
                                <td>
                                    <button class="btn rounded-pill btn-primary btn-sm edit-user-btn edit-btn"
                                        data-id="{{ $blog->id }}" data-title="{{ $blog->title }}" data-sub-title="{{ $blog->sub_title }}"
                                        data-date="{{ $blog->date->format('Y-m-d') }}"
                                        {{-- data-image-name="{{ $blog->images->isNotEmpty() ? $blog->images->first()->imagename : '' }}" --}}
                                        data-images="{{ json_encode($blog->images->map(fn($image) => ['id' => $image->id, 'imagename' => $image->imagename, 'caption' => $image->caption])) }}"
                                        data-category="{{ $blog->category }}"
                                        data-description="{{ $blog->description }}"
                                        data-pulished-by="{{ $blog->published_by }}"
                                        data-written-by="{{ $blog->written_by }}"
                                        data-publisher-bio="{{ $blog->publisher_bio }}"
                                        data-press-link="{{ $blog->press_link }}"
                                        
                                        data-bs-toggle="modal"
                                        data-bs-target="#editBlogModal">
                                        <i class="fa fa-edit m-0"></i>
                                    </button>
                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded-pill btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash m-0"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Blogs available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            
        </div>
    </div>

    <!-- Add Blog Modal -->
    <div id="addBlogModal" class="modal fade" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBlogModalLabel">Add NEW BLOG PIECE</h5>
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
                            <label for="subtitle" class="form-label">Sub-Title</label>
                            <input type="text" class="form-control" name="sub_title" id="subtitle">
                            <div class="invalid-feedback" id="subtitle-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                            <div class="invalid-feedback" id="date-error"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="blog_images" class="form-label">Upload Images (Max: 3)</label>
                            <input type="file" name="blog_images[]" multiple>
                        </div>
                        <div id="image-captions-container" class="row g-3">
                            <!-- Captions will be added dynamically here -->
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
                                <input type="text" name="new_category" id="new_category" class="form-control"
                                    placeholder="Enter new category">
                                <div class="invalid-feedback" id="new_category-error"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="8" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="published_by" class="form-label">Published by</label>
                            <input type="text" class="form-control" name="published_by" id="published_by">
                            <div class="invalid-feedback" id="published_by-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="written_by" class="form-label">Written by</label>
                            <input type="text" class="form-control" name="written_by" id="Written_by">
                            <div class="invalid-feedback" id="written_by-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="publisher_bio" class="form-label">publisher bio</label>
                            <textarea id="publisher_bio" name="publisher_bio" rows="4" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="press_link" class="form-label">Press Link</label>
                            <input type="url" name="press_link" id="press_link" class="form-control">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="tiktok" class="form-label">TikTok</label>
                            <input type="url" name="social_links[tiktok]" class="form-control" id="tiktok">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" name="social_links[instagram]" class="form-control"
                                value="{{ $blog->social_links['instagram'] ?? '' }}" id="instagram">
                        </div>
                        <div class="mb-3">

                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="url" name="social_links[linkedin]" class="form-control"
                                value="{{ $blog->social_links['linkedin'] ?? '' }}" id="linkedin">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" name="social_links[facebook]" class="form-control"
                                value="{{ $blog->social_links['facebook'] ?? '' }}" id="facebook">
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" name="social_links[twitter]" class="form-control"
                                value="{{ $blog->social_links['twitter'] ?? '' }}" id="twitter">
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Add BLOG</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div id="editBlogModal" class="modal fade" tabindex="-1" aria-labelledby="editBlogModalLabel"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBlogForm" enctype="multipart/form-data" method="POST">
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
                                <label for="editsubTitle" class="form-label">Sub-Title</label>
                                <input type="text" id="editsubTitle" name="sub_title" class="form-control" >
                                <div class="invalid-feedback" id="editsubTitle-error"></div>
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

                             <!-- Existing Images Section -->
                            <!-- Current Images Section in Edit Modal -->
                            <div class="col-md-4 mb-3" style="display: flex; flex-direction: column;">
                                <label class="form-label">Current Images</label>
                                <div id="currentImages"></div>
                            </div>

                            
                            <div class="mb-3">
                                <label for="edit_blog_images" class="form-label">Upload Images (Max: 3)</label>
                                <input type="file" name="edit_blog_images[]" multiple>
                            </div>
                            <div id="edit-image-captions-container">
                                <!-- Captions will be added dynamically here -->
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea id="editDescription" name="description" rows="8" class="form-control"></textarea>
                                {{-- <div class="invalid-feedback" id="editDescription-error"></div> --}}
                            </div>
                            <div class="mb-3">
                                <label for="editPublishedBy" class="form-label">Published by</label>
                                <input type="text" class="form-control" name="published_by" id="editPublishedBy">
                                <div class="invalid-feedback" id="published_by-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="editwrittenBy" class="form-label">Written by</label>
                                <input type="text" class="form-control" name="written_by" id="editWrittenBy">
                                <div class="invalid-feedback" id="written_by-error"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="editpublisherbio" class="form-label">Publisher-bio</label>
                                <textarea id="editpublisherbio" name="publisher_bio" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editPressLink" class="form-label">Press Link</label>
                                <input type="url" name="press_link" id="editPressLink" class="form-control">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="tiktok" class="form-label">TikTok</label>
                                <input type="url" name="social_links[tiktok]" class="form-control" id="edit-tiktok">
                            </div>
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="url" name="social_links[instagram]" class="form-control"
                                    id="edit-instagram">
                            </div>
                            <div class="mb-3">

                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url" name="social_links[linkedin]" class="form-control"
                                    id="edit-linkedin">
                            </div>
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="url" name="social_links[facebook]" class="form-control"
                                    id="edit-facebook">
                            </div>
                            <div class="mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="url" name="social_links[twitter]" class="form-control"
                                    id="edit-twitter">
                            </div> --}}

                            <div class="col-md-12 my-3">
                                <button class="btn btn-primary" type="submit">Update Blog</button>
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
                favs: {
                    title: 'menu',
                    items: 'code visualaid | searchreplace | emoticons'
                }
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
                    favs: {
                        title: 'menu',
                        items: 'code visualaid | searchreplace | emoticons'
                    }
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
        document.getElementById('category').addEventListener('change', function() {
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
                    const subtitle = button.getAttribute('data-sub-title');
                    const date = button.getAttribute('data-date');
                                // Get the data-images attribute from the button
                    const imagesData = button.getAttribute('data-images');
                    
                    // Parse the JSON string to a JavaScript object
                    const images = JSON.parse(imagesData);
                    const category = button.getAttribute('data-category');
                    const description = button.getAttribute('data-description');
                    const publishedBy = button.getAttribute('data-pulished-by');
                    const writtenBy = button.getAttribute('data-written-by');
                    const publisherbio = button.getAttribute('data-publisher-bio');
                    const pressLink = button.getAttribute('data-press-link');
                    
                    // Populate the modal form fields
                    document.getElementById('editBlogId').value = blogId;
                    document.getElementById('editTitle').value = title;
                    document.getElementById('editsubTitle').value = subtitle;
                    document.getElementById('editDate').value = date;
                    //document.getElementById('editDescription').value = description;
                    document.getElementById('editPublishedBy').value = publishedBy;
                    document.getElementById('editWrittenBy').value = writtenBy;
                    document.getElementById('editpublisherbio').value = publisherbio;
                    document.getElementById('editPressLink').value = pressLink;

                    // Set the selected category in the dropdown
                    const editCategorySelect = document.getElementById('editCategory');
                    for (const option of editCategorySelect.options) {
                        option.selected = option.value.toLowerCase().trim() === category
                            .toLowerCase().trim();
                    }

                    // Set the form's action URL using the blog ID
                    const editBlogForm = document.getElementById('editBlogForm');
                    editBlogForm.action = `{{ route('blog.update', '') }}/${blogId}`;
                    // Set social links
                    

                    const fileInput = document.querySelector('input[name="edit_blog_images[]"]');
                    const container = document.getElementById('edit-image-captions-container');

                    fileInput.value = ''; // Clear file input
                    container.innerHTML = ''; // Clear captions container

                    // Show the modal
                    if (tinymce.get('editDescription')) {
                        tinymce.get('editDescription').remove();
                    }

                    // Initialize TinyMCE for editDescription
                    initializeTinyMCE('textarea#editDescription');

                    // Wait for TinyMCE to be initialized, then set the content
                    const checkTinyMCEReady = setInterval(() => {
                        if (tinymce.get('editDescription')) {
                            clearInterval(
                            checkTinyMCEReady); // Stop checking once TinyMCE is ready
                            tinymce.get('editDescription').setContent(
                            description); // Set the content
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
                    url: '{{ route('blog.store') }}', // Replace with the correct route
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Success message or redirection

                        if (response.success) {
                            $('#addBlogModal').modal('hide'); // Close the modal
                            toastr.success('Blog added successfully!');
                            window.location.href = response.redirect_url; //
                        }
                    },
                    error: function(xhr) {
                        // If validation fails, show errors
                        if (xhr.status === 422) { // Validation error
                            var errors = xhr.responseJSON.errors;

                            // Iterate through the errors and display them
                            for (var field in errors) {
                                // Handle category_name errors
                                if (field === 'category_name') {
                                    $('#' + field).addClass(
                                    'is-invalid'); // Add invalid class to category_name
                                    $('#' + field + '-error').text(errors[field][0]);
                                }

                                // Handle new_category errors
                                if (field === 'new_category') {
                                    $('#' + field).addClass(
                                    'is-invalid'); // Add invalid class to new_category
                                    $('#' + field + '-error').text(errors[field][0]);

                                    // If 'Other' is selected, show the input field for the new category
                                    if ($('#category').val() === 'other') {
                                        $('#newCategoryContainer')
                                    .show(); // Show the new category input field
                                    }
                                }

                                // Handle blog_image errors
                                if (field === 'blog_image') {
                                    $('#' + field).addClass(
                                    'is-invalid'); // Add invalid class to blog_image
                                    $('#' + field + '-error').text(errors[field][0]);
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.querySelector('input[name="blog_images[]"]');
            const container = document.getElementById('image-captions-container');

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    container.innerHTML = ''; // Clear previous content

                    Array.from(this.files).forEach((file, index) => {
                        // Create a div for each image
                        const div = document.createElement('div');
                        div.className = 'col-md-4'; // Bootstrap grid for 3 images per row

                        // Create an image element
                        const img = document.createElement('img');
                        img.style.maxWidth = '100%'; // Responsive width
                        img.style.height = '70%'; // Maintain aspect ratio
                        img.style.marginBottom = '1px';

                        // Use FileReader to display the image
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            img.src = e.target.result; // Set the src to the file's data URL
                        };
                        reader.readAsDataURL(file); // Read the file as a data URL

                        // Create caption input field
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = 'image_captions[]';
                        input.placeholder = `Enter caption for ${file.name}`;
                        input.className = 'form-control mt-2';
                        input.required = true;

                        // Append the image and input to the div
                        div.appendChild(img);
                        div.appendChild(input);

                        // Append the div to the container
                        container.appendChild(div);
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Load blog data into the modal
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const blogId = this.dataset.id;
                    const title = this.dataset.title;
                                // Get the data-images attribute from the button
                    const imagesData = button.getAttribute('data-images');
                    
                    // Parse the JSON string to a JavaScript object
                    const images = JSON.parse(imagesData); // Assuming images array passed in dataset

                    // Fill modal fields
                    document.getElementById('editBlogId').value = blogId;
                    document.getElementById('editTitle').value = title;

                    // Load current images with captions
                    const currentImagesDiv = document.getElementById('currentImages');
                    currentImagesDiv.innerHTML = ''; // Clear previous images
                    images.forEach(image => {
                        // Create an image element with a delete button
                        const imageDiv = document.createElement('div');
                        imageDiv.classList.add('col-md-4','mb-2');
                        imageDiv.innerHTML = `
                        <img src="{{ asset('storage/') }}/${image.imagename}" alt="Image" style="max-width: 150px;">
                        <input type="text" name="captions[${image.id}]" value="${image.caption  || ''}" placeholder="Enter caption" class="form-control mt-2" style="min-width: 150px;">
                        <button type="button" class="btn btn-danger btn-sm delete-image" data-image="${image.imagename}" data-image-id="${image.id}">
                            Delete
                        </button>
                        `;
                            currentImagesDiv.appendChild(imageDiv);
                    });

                    // Initialize delete image functionality
                    const deleteButtons = currentImagesDiv.querySelectorAll('.delete-image');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const imagePath = this.getAttribute('data-image');
                            const imageId = this.getAttribute('data-image-id');

                            // Make an Ajax request to delete the image
                            $.ajax({
                                url: '{{ route('blog.deleteImage') }}', // Define the route in Laravel
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    image_id: imageId,
                                    image_path: imagePath
                                },
                                success: function(response) {
                                    if (response.success) {
                                        toastr.success(
                                            'Image deleted successfully'
                                        );
                                        button.parentElement
                                            .remove(); // Remove image from DOM
                                    } else {
                                        toastr.error(
                                            'Error deleting image');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    toastr.error(
                                        'Error deleting image');
                                }
                            });
                        });
                    });
                });
            });

            // Add captions for new image uploads
            document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('editBlogImage');
                const newImageCaptionsContainer = document.getElementById('newImageCaptionsContainer');

                fileInput.addEventListener('change', function () {
                    newImageCaptionsContainer.innerHTML = ''; // Clear previous captions
                    Array.from(this.files).forEach((file, index) => {
                        const div = document.createElement('div');
                        div.className = 'mb-3';
                        div.innerHTML = `
                            <label>Caption for ${file.name}</label>
                            <input type="text" name="new_image_captions[]" class="form-control" placeholder="Enter caption for ${file.name}" required>
                        `;
                        newImageCaptionsContainer.appendChild(div);
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            
            const fileInput = document.querySelector('input[name="edit_blog_images[]"]');
            const container = document.getElementById('edit-image-captions-container');
    
            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    container.innerHTML = ''; // Clear previous content
    
                    Array.from(this.files).forEach((file, index) => {
                        const div = document.createElement('div');
                        div.style.marginBottom = '15px';
    
                        // Create an image element
                        const img = document.createElement('img');
                        img.style.maxWidth = '150px'; // Set a reasonable max width
                        img.style.maxHeight = '150px'; // Set a reasonable max height
                        img.style.display = 'block'; // Block to separate from caption
                        img.style.marginBottom = '10px';
    
                        // Use FileReader to display the image
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            img.src = e.target.result; // Set the src to the file's data URL
                        };
                        reader.readAsDataURL(file); // Read the file as a data URL
    
                        // Create caption input field
                        const label = document.createElement('label');
                        // label.textContent = `Caption for ${file.name}`;
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = 'image_captions[]';
                        input.placeholder = `Enter caption for ${file.name}`;
                        input.required = true;
    
                        // Append the elements to the container
                        div.appendChild(img);
                        div.appendChild(label);
                        div.appendChild(input);
                        container.appendChild(div);
                    });
                });
            }
        });
    </script>

@endsection