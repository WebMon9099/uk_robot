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

    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>User Profile</h4>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                    <i class="fa fa-key me-2"></i> Reset Password
                </button>
            </div>

            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets_new/img/avatars/1.png') }}" 
                         alt="Profile Picture" class="rounded-circle" width="150" height="150">
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <tr>
                            <th>Name:</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Joined At:</th>
                            <td>{{ Auth::user()->created_at->format('d M, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="modal fade" tabindex="-1" aria-labelledby="resetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="resetPasswordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="old_password">
                                Show
                            </button>
                        </div>
                        <div id="oldPasswordFeedback" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                                Show
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="confirm_password">
                                Show
                            </button>
                        </div>
                        <div id="passwordMatchFeedback" class="mt-2"></div>
                    </div>
                    <button type="button" id="resetPasswordBtn" class="btn btn-primary">Reset Password</button>
                </form>
                <div id="passwordMessage" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>


<script>

     // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetInput = document.getElementById(this.dataset.target);
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.textContent = 'Hide';
            } else {
                targetInput.type = 'password';
                this.textContent = 'Show';
            }
        });
    });

    // Check Old Password
    $('#old_password').on('input', function () {
        $.ajax({
            url: "{{ route('check.old.password') }}",
            method: 'POST',
            data: {
                old_password: $(this).val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#old_password').addClass('is-valid').removeClass('is-invalid');
                    $('#oldPasswordFeedback').html('<span class="text-success">Old password is correct.</span>');
                } else {
                    $('#old_password').addClass('is-invalid').removeClass('is-valid');
                    $('#oldPasswordFeedback').html('<span class="text-danger">' + response.message + '</span>');
                }
            }
        });
    });

    // Check Password Match
    $('#confirm_password').on('input', function () {
        if ($('#new_password').val() === $(this).val()) {
            $('#confirm_password').addClass('is-valid').removeClass('is-invalid');
            $('#passwordMatchFeedback').html('<span class="text-success">Passwords match.</span>');
        } else {
            $('#confirm_password').addClass('is-invalid').removeClass('is-valid');
            $('#passwordMatchFeedback').html('<span class="text-danger">Passwords do not match.</span>');
        }
    });

    // Reset Password
    $('#resetPasswordBtn').on('click', function () {
        $.ajax({
            url: "{{ route('password.update') }}",
            method: 'POST',
            data: {
                old_password: $('#old_password').val(),
                new_password: $('#new_password').val(),
                confirm_password: $('#confirm_password').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    $('#passwordMessage').html('<span style="color: green;">' + response.message + '</span>');
                    setTimeout(() => {
                        window.location.href = "{{ route('dashboard') }}"; // Redirect to dashboard
                    }, 500);
                } else {
                    $('#passwordMessage').html('<span style="color: red;">' + response.errors.old_password || 'Error updating password.' + '</span>');
                }
            }
        });
    });

    // Clear Modal on Close
    $('#resetPasswordModal').on('hide.bs.modal', function () {
        $('#resetPasswordForm')[0].reset();
        $('#old_password').removeClass('is-valid is-invalid');
        $('#confirm_password').removeClass('is-valid is-invalid');
        $('#oldPasswordFeedback').html('');
        $('#passwordMatchFeedback').html('');
        $('#passwordMessage').html('');
    });
</script>

@endsection
