@extends('layout.app')

@section('main_section')
<style>
.forgot-password-card {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin: 50px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: #f8f9fa;
    max-width: 800px;
}

.image-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.illustration {
    max-width: 100%;
    height: auto;
}

.form-container {
    flex: 1;
    padding: 20px;
    text-align: left;
}

.btn-custom {
    background-color: #28a745;
    color: white;
    width: 6em;
    border-radius: 30em;
    font-size: 18px;
    font-family: inherit;
    border: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #ffffff;
    margin-top: 20px;
    font-weight: 800;
    letter-spacing: 2px;
    transition: background-color 0.3s;
}

.btn-custom:hover {
    background-color: #218838;
}

.btn-custom::before {
    content: '';
    width: 0;
    height: 3em;
    border-radius: 30em;
    position: absolute;
    top: 0;
    left: 0;
    background-image: linear-gradient(to right, #0fd850 0%, #f9f047 100%);
    transition: .5s ease;
    display: block;
    z-index: -1;
}

.btn-custom:hover::before {
    width: 9em;
}

.alternative-link {
    color: #007bff;
    cursor: pointer;
    text-decoration: underline;
}

.forget-page {
    padding: 5%;
    border-radius: 5px;
}

.frgtpswd {
    font-size: 60px;
    font-weight: 700;
}

.frgtpara {
    font-weight: 500;
}
</style>

<div class="position-relative text-white"
    style="background-color: #0ba1a1; width: 100vw !important; overflow-x: hidden !important;">
    <div
            style="z-index:1; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('images/home-section-1.png') }}'); opacity: 0.15; pointer-events: none;">
        </div>
    <div>
        @include('components.navbar')
    </div>
    <main>
        <div class="container forget-page">
            <div class="forgot-password-card text-center bg-white">
                <div class="image-container">
                    <img src="{{ asset('images/illustrate.png') }}" alt="Illustration" class="illustration">
                </div>
                <div class="form-container text-dark">
                    <!-- Forgot Password Text -->
                    <h3 class="frgtpswd">Forgot Password?</h3>
                    <p class="frgtpara">Enter the email address associated with your account.</p>

                    <!-- Response Message -->
                    <div id="response-message"></div>

                    <!-- Email Input -->
                    <form id="resetPasswordForm">
                        @csrf
                        <!-- CSRF token -->
                        <div class="form-group">
                            <input type="email" id="email_address" class="form-control" name="email"
                                placeholder="Enter Email Address" required>
                            <span class="text-danger" id="email-error"></span>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-custom" id="submitBtn">
                                <span id="buttonText">Next</span>
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('customJs')
<script>
$(document).ready(function() {
    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous error messages and response message
        $('#email-error').text('');
        $('#response-message').html('');

        // Show loading spinner and disable button
        $('#submitBtn').prop('disabled', true);
        $('#buttonText').addClass('d-none');
        $('#loadingSpinner').removeClass('d-none');

        var email = $('#email_address').val();
        var token = $("input[name=_token]").val(); // CSRF token

        $.ajax({
            url: "{{ route('user.forgetPassword') }}", // Update with the correct route
            type: "POST",
            data: {
                _token: token,
                email: email
            },
            success: function(response) {
                $('#response-message').html(
                    '<div class="alert alert-success">We have e-mailed your password reset link!</div>'
                    );
                $('#submitBtn').prop('disabled', true);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var error = xhr.responseJSON.errors.email ? xhr.responseJSON.errors
                        .email[0] : 'Invalid request';
                    $('#email-error').text(error); // Display the custom email error message
                }
            },
            complete: function() {
                // Hide spinner and enable button
                $('#loadingSpinner').addClass('d-none');
                $('#buttonText').removeClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });
    });
});
</script>
@endsection