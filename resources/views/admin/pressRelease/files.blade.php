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
                <h4 class="mb-3">Manage Files</h4>
            </div>
        </div>
        <div class="table-responsive card-body">
            <table class="table table-hover table-border-bottom-0" id="Datatable">
        
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Type</th>
                        <th>Preview</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ strtoupper($file->file_type) }}</td>
                            <td>
                                @if ($file->file_type === 'image')
                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="Thumbnail" style="width: 100px; height: 100px;">
                                @elseif ($file->file_type === 'pdf')
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                        <img src="{{ asset('images/PDF_file_icon.png') }}" alt="PDF Icon" style="width: 50px; height: 50px;">
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">Preview</a>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger delete-file-btn" type="button"
                                        data-id="{{ $file->id }}" 
                                        data-file-name="{{ basename($file->file_path) }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Files Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>    
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the file <strong id="fileName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="successMessage"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="errorMessage"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* General alert box styling */
    .custom-alert {
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        position: relative;
        font-family: Arial, sans-serif;
        width: 100%;
        max-width: 500px;
        box-sizing: border-box;
    }

    .custom-alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .custom-alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .close-alert {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        color: inherit;
        cursor: pointer;
    }

    .close-alert:hover {
        color: #333;
    }

    .custom-alert strong {
        font-weight: bold;
    }

    /* Optional: Add animation for fade-in */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>

<script>
    $(document).on('click', '.delete-file-btn', function() {
        var fileId = $(this).data('id');
        var fileName = $(this).data('file-name'); // Get the file name

        // Set the file name in the confirmation modal
        $('#fileName').text(fileName);

        // Show the confirmation modal
        $('#confirmDeleteModal').modal('show');

        // When the user clicks 'Delete', perform the deletion
        $('#confirmDeleteBtn').on('click', function() {
            $.ajax({
                url: '{{ route('press.file.delete') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    file_id: fileId
                },
                success: function(response) {
                    if (response.success) {
                        $('#successMessage').text(response.message);
                        $('#successModal').modal('show');
                        setTimeout(function() {
                            location.reload(); 
                        }, 2000); 
                    } else {
                    
                        $('#errorMessage').text('Error: ' + response.message);
                        $('#errorModal').modal('show');
                    }
                },
                error: function(xhr) {
                    // Display error modal
                    $('#errorMessage').text('An error occurred while deleting the file.');
                    $('#errorModal').modal('show');
                }
            });
            // Close the confirmation modal
            $('#confirmDeleteModal').modal('hide');
        });
    });
</script>
@endsection
