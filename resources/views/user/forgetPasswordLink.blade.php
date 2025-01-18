@extends('layout.app')
@section('main_section')
    <div class="position-relative text-white"
        style="background-color: #0ba1a1; width: 100vw !important; overflow-x: hidden !important;">
        <div style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.15;"></div>
        <div>
            @include('components.navbar')
        </div>
        <div>
            <main class="login-form m-3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-lg rounded-lg mb-4">
                                <div class="row g-0 align-items-center">
                                    <div class="col-xxl-12 mx-auto">
                                        <div class="card mb-0 border-0 shadow-none mb-0">
                                            <div class="card-body p-sm-5 m-lg-2">
                                                <div class="text-center">
                                                    <h5 class="fs-3xl">Reset Password</h5>
                                                    <div>
                                                        <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid w-25">
                                                    </div>
                                                </div>
                                                <div class="p-2 mt-3">
                                                    <form id="resetPasswordFormConfirm">
                                                        @csrf
                                                        <input type="hidden" name="token" value="{{ $token }}">
                                                        
                                                        <div class="form-group row mb-3">
                                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                                            <div class="col-md-6">
                                                                <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                                                                <span class="text-danger" id="email_error"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-3">
                                                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                                            <div class="col-md-6">
                                                                <input type="password" id="password" class="form-control" name="password" required autofocus>
                                                                <span class="text-danger" id="password_error"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-3">
                                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                                            <div class="col-md-6">
                                                                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                                                <span class="text-danger" id="password_confirmation_error"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="success_message" class="alert alert-success mt-3" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include('components.news-letter')
    @include('components.contact-us')
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $('#resetPasswordFormConfirm').on('submit', function(e) {
            e.preventDefault();

            var email = $('#email_address').val();
            var password = $('#password').val();
            var password_confirmation = $('#password-confirm').val();
            var token = $('input[name="token"]').val();

            // Clear previous error messages
            $('#email_error').text('');
            $('#password_error').text('');
            $('#password_confirmation_error').text('');

            $.ajax({
                url: "{{ route('reset.password.post') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    token: token
                },
                success: function(response) {
                    if (response.success) {
                        $('#success_message').text(response.message).show();
                        setTimeout(function(){
                            window.location.href = '/login';
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                    // Validation error, check xhr.responseJSON.errors
                    var errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $('#email_error').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#password_error').text(errors.password[0]);
                    }
                    if (errors.password_confirmation) {
                        $('#password_confirmation_error').text(errors.password_confirmation[0]);
                    }
                } else {
                    alert('Something went wrong. Please try again.');
                }
                }
            });
        });
    });
</script>
@endsection
