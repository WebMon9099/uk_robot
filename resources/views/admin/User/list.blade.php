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
                    <h4 class="mb-3">Users</h4>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="fa fa-plus-circle me-2"></i>
                        Add User</button>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap card-body">
                <table class="table table-hover table-border-bottom-0" id="Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Sno</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @php
                                    $userTypes = [
                                        1 => 'admin',
                                        2 => 'User',
                                        3 => 'Journalist',
                                        4 => 'Blogger',
                                        5 => 'Social Media Influencer',
                                        6 => 'Local Writer',
                                    ];
                                @endphp
                                <td>{{ $userTypes[$user->user_type] ?? 'Unknown' }}</td>
                                <td class="{{ $user->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                </td>

                                <td>
                                    <button class="btn rounded-pill btn-primary btn-sm edit-user-btn"
                                        data-id="{{ $user->id }}"><i class="fa fa-edit m-0"></i></button>
                                    <a href="{{ route('user.destroy', ['id' => $user->id]) }}"
                                        class="btn rounded-pill btn-danger btn-sm"><i class="fa fa-trash m-0"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <p class="text-danger"></p>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">User Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                            <p></p>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="generatePassword()">Generate</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i id="passwordToggleIcon" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <p class="text-danger"></p>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">User Contact</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <!-- User Details (always show these fields) -->
                        <div class="row">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="postcode" class="form-label">Postcode</label>
                                <input type="text" class="form-control" id="postcode" name="postcode">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>
                        </div>

                        <!--user type --->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="user_role" class="form-label">User Role</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    @if (Auth::user()->user_type == 0) <!-- Check if logged-in user is Super Admin -->
                                        <option value="1">Admin</option>
                                    @endif
                                    <option value="2">User</option>
                                    <option value="3">Journalist </option>
                                    <option value="4"> Blogger</option>
                                    <option value="5"> Social Media Influencer</option>
                                    <option value="6"> Local Writer</option>
                                </select>
                            </div>
                        </div>

                        <!-- User Status -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="user_status" class="form-label">User Status</label>
                                <select name="user_status" id="user_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>
    <script>
        $(document).ready(function() {
            $('.edit-user-btn').click(function(e) {
                e.preventDefault();
                let userID = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.edit') }}",
                    data: {
                        id: userID
                    },
                    success: function(response) {
                        $('#editModal').empty();
                        $('#editModal').html(response).modal('show');
                    }
                });
            });
        });

        function generatePassword() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$&*';
            let password = '';
            for (let i = 0; i < 12; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('password').value = password;
        }

        // Function to toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }

        $("#addUserForm").submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            $.ajax({
                url: '{{ route('user.store') }}', // Replace with your store route
                type: 'post',
                dataType: 'json',
                data: $("#addUserForm").serializeArray(),
                success: function(response) {
                    if (response.error) {
                        var error = response.error;

                        // Handle name field error
                        if (error.name) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(error.name);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handle email field error
                        if (error.email) {
                            $("#email").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.email);
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handle password field error
                        if (error.password) {
                            $("#password").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.password);
                        } else {
                            $("#password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                    } else {
                        // If no errors, redirect or show success message
                        window.location.href = "{{ route('user.index') }}";
                    }
                },
                error: function(xhr) {
                    console.error("Error occurred: ", xhr.responseJSON);
                }
            });
        });
    </script>

@endsection
