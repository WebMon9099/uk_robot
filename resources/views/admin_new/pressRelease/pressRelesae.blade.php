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
                    <h4 class="mb-3">PressPack</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPressModal">
                        <i class="fa fa-plus-circle me-2"></i> Add Press
                    </button>
                </div>
            </div>
            
            <div class="table-responsive card-body">

                <table class="table table-hover table-border-bottom-0" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Item</th>
                                <th>Date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pressReleases as $pressRelease)
                                <tr>
                                    <!-- Serial Number -->
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- Title -->
                                    <td>{{ $pressRelease->title }}</td>

                                    <!-- Content (Truncated to 20 Words) -->
                                    <td>{{ \Illuminate\Support\Str::words(strip_tags($pressRelease->content), 20, '...') }}
                                    </td>

                                    <!-- Files -->
                                    <td>
                                        @if ($pressRelease->files->isNotEmpty())
                                            <ul>
                                                @foreach ($pressRelease->files as $file)
                                                    <li>
                                                        <a href="{{ asset('storage/' . $file->file_path) }}"
                                                            target="_blank">
                                                            Download ({{ strtoupper($file->file_type) }})
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            No Files Available
                                        @endif
                                    </td>

                                    <!-- Created At -->
                                    <td>{{ $pressRelease->created_at->format('Y-m-d') }}</td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                        <!-- Edit Button -->
                                        <button class="btn rounded-pill btn-primary btn-sm me-2 edit-btn"
                                            data-id="{{ $pressRelease->id }}" data-title="{{ $pressRelease->title }}"
                                            data-date="{{ $pressRelease->created_at->format('Y-m-d') }}"
                                            data-images="{{ json_encode($pressRelease->files ? $pressRelease->files->pluck('file_path') : []) }}"
                                            data-description="{{ $pressRelease->content }}" data-bs-toggle="modal"
                                            data-bs-target="#editPressModal">

                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn rounded-pill btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" data-id="{{ $pressRelease->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Press Releases Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            
        </div>
    </div>


    <!-- Add Press Modal -->
    <div id="addPressModal" class="modal fade" tabindex="-1" aria-labelledby="addPressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PressModalLabel">Add NEW PRESS PIECE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPressReleaseForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                            <div class="invalid-feedback" id="title-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="content" rows="8" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="press_image" class="form-label">Upload Files (Images or PDFs)</label>
                            <input type="file" class="form-control" name="files[]" id="press_image" multiple
                                accept="image/*,application/pdf">
                            <small class="form-text text-muted">Upload up to 10 MB per image. Accepted formats: JPEG, PNG,
                                JPG, GIF.PDF</small>
                            <div class="invalid-feedback" id="press_image-error"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add PRESS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Edit Press Model-->
    <div id="editPressModal" class="modal fade" tabindex="-1" aria-label="editPressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPressModalLabel">Edit Press</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPressReleaseForm" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Hidden Input for Press ID -->
                        <input type="hidden" id="editPressId" name="press_id">

                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="editTitle" required>
                            <div class="invalid-feedback" id="title-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editdescription" class="form-label">Description</label>
                            <textarea id="Editdescription" name="content" rows="8" class="form-control"></textarea>
                        </div>
                        <!-- Current Images Section in Edit Modal -->
                        <div class="col-md-4 mb-3" style="display: flex; flex-direction: column;">
                            <label class="form-label">Current Images</label>
                            <div id="currentImages"></div>
                        </div>

                        <div class="mb-3">
                            <label for="editImages" class="form-label">Upload New Images</label>
                            <input type="file" name="images[]" id="editImages" class="form-control" multiple
                                accept="image/*,application/pdf">
                        </div>
                        <button type="submit" class="btn btn-primary">UPDATE PRESS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Press Modal-->
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this press release?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('press.release.destroy', '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="deletePressReleaseId">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
        $(document).ready(function() {
            // Open the modal if validation errors exist
            $('#addPressReleaseForm').on('submit', function(e) {
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
                            $('#addPressModal').modal('hide'); // Close the modal
                            toastr.success('Press added successfully!');
                            window.location.href = response.redirect_url; //
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            for (var field in errors) {
                                if (field === 'title') {
                                    $('#' + field).addClass(
                                        'is-invalid'); // Add invalid class to title
                                    $('#' + field + '-error').text(errors[field][
                                        0
                                    ]); // Display error for title
                                }

                                if (field === 'files') {
                                    // Show file-related error
                                    $('#press_image').addClass(
                                        'is-invalid'); // Add invalid class to file input
                                    $('#press_image-error').text(errors[field][
                                        0
                                    ]);
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
            const editPressModal = new bootstrap.Modal(document.getElementById('editPressModal'));

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const pressId = button.getAttribute('data-id');
                    const title = button.getAttribute('data-title');
                    const description = button.getAttribute('data-description');
                    const images = JSON.parse(button.getAttribute('data-images'));

                    // Fill the form with current data
                    document.getElementById('editPressId').value = pressId;
                    document.getElementById('editTitle').value = title;
                    document.getElementById('Editdescription').value = description;
                    const currentImagesDiv = document.getElementById('currentImages');
                    currentImagesDiv.innerHTML = ''; // Clear previous images


                    const editPressReleaseForm = document.getElementById('editPressReleaseForm');
                    editPressReleaseForm.action =
                        `{{ route('press-pack.update', '') }}/${pressId}`;

                    images.forEach(image => {
                        // Create an image element with a delete button
                        const imageDiv = document.createElement('div');
                        imageDiv.classList.add('col-md-4','mb-2');
                        imageDiv.innerHTML = `
                    <img src="{{ asset('storage/') }}/${image}" alt="Image" style="max-width: 150px;">
                    <button type="button" class="btn btn-danger btn-sm delete-image" data-image="${image}" data-press-id="${pressId}">
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
                            const pressId = this.getAttribute('data-press-id');

                            // Make an Ajax request to delete the image
                            $.ajax({
                                url: '{{ route('press.deleteImage') }}', // Define the route in Laravel
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    press_id: pressId,
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
        });


        function removeImage(imagePath) {
            // Remove the image from the DOM
            const imageDiv = document.querySelector(`[data-image="${imagePath}"]`);
            if (imageDiv) {
                imageDiv.remove();
            }

            // Send an AJAX request to delete the image from the server
            fetch(`/Press-Relases/delete-press-image/${encodeURIComponent(imagePath)}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.text()) // Use text() to see the raw response
                .then(data => {
                    try {
                        // Try parsing the response as JSON
                        const jsonData = JSON.parse(data);
                        if (jsonData.success) {
                            alert('Image deleted successfully!');
                        } else {
                            alert('Failed to delete the image.');
                        }
                    } catch (e) {
                        // Log the response if it's not valid JSON
                        console.error('Invalid JSON response:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script>
        // JavaScript to handle the modal trigger
        document.addEventListener('DOMContentLoaded', function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');

            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var pressReleaseId = button.getAttribute(
                'data-id'); // Extract the ID from the data-id attribute

                var form = confirmDeleteModal.querySelector('form');
                form.action = '{{ route('press.release.destroy', '') }}/' + pressReleaseId;
                document.getElementById('deletePressReleaseId').value = pressReleaseId;
            });
        });
    </script>



@endsection
