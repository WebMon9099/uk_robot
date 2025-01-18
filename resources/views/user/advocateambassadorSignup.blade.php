@extends('layout.app')

@section('main_section')
    <div class="position-relative text-white"
        style="background-color: #0ba1a1; width: 100vw !important; overflow-x: hidden !important;">
        <div
            style="z-index:1; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('images/home-section-1.png') }}'); opacity: 0.15; pointer-events: none;">
        </div>
        @include('components.navbar')
        <div class="container py-5 h-100" style="position: relative; z-index:2;">
            <div class="row justify-content-center" style="height:10%">
                <div class="col-md-12 text-center">
                    <h3 class="frgtpswd">SignUp Here!</h3>
                    {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width:10%;"> --}}
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card-block">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 col-lg-5 d-flex justify-content-center first-row">
                                <img src="{{ asset('images/home-section-image_clean_new.png') }}" alt="login form"
                                    class="img-fluid login-img" style="border-radius: 1rem 0 0 1rem; height:100%;" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="position-relative container py-1 mx-auto">

                                    <!-- Step 1: First Name -->
                                    <div class="step" id="step1">
                                        <div class="speech-bubble">
                                            <h3 id="intro-text" class="mb-3"></h3>
                                            <!-- This is where the text will appear -->
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="firstName" class="form-label font-style">First Name:</label>
                                            <input type="text" class="form-control mb-2" id="firstName">
                                            <small id="firstNameError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter
                                                your first name</small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg" id="firstNext">Next</button>
                                    </div>

                                    <!-- Step 2 Last name -->
                                    <div class="step" id="step2" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-2 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="lastName" class="form-label font-style">Last Name:</label>
                                            <input type="text" class="form-control mb-2" id="lastName" required>
                                            <small id="lastNameError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter
                                                your last name</small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg" id="backToFirst">Back</button>
                                        <button type="button" class="btn btn-warning btn-lg" id="secondNext">Next</button>

                                    </div>

                                    <!-- Confirmation Step -->
                                    <div class="step" id="step3" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-3 mb-3"></h3>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg" id="confirmYes">Yes</button>
                                        <button type="button" class="btn btn-danger btn-lg" id="confirmNo">No</button>
                                    </div>

                                    <!--Step 4-->
                                    <!-- Step 4: Contact Details -->
                                    <!-- Step 4: Email Details -->
                                    <div class="step" id="step4" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-4 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="email" class="form-label font-style">Email:</label>
                                            <input type="email" class="form-control mb-2" id="email">
                                            <small id="emailError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter your
                                                email</small>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-lg" id="changeEmail">Change
                                            Email Address</button>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="contactNext">Continue</button>
                                    </div>

                                    <!-- Step 5: Email Verification -->
                                    <div class="step" id="step5" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-5 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4" id="code-container">
                                            <label for="verificationCode" class="form-label font-style">Verification
                                                Code:</label>
                                            <input type="text" class="form-control mb-2" id="verificationCode" required>
                                            <small id="verificationCodeError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please
                                                enter the verification code</small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg" id="verifyCode">Verify
                                            Code</button>
                                        <button type="button" class="btn btn-danger btn-lg" id="changeEmail"
                                            style="display: none;">Change
                                            Email Address</button>
                                    </div>

                                    <!-- Step 6: Code Confirmation -->
                                    <div class="step" id="step6" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-6 mb-3"></h3>
                                        </div>
                                    </div>

                                    <!-- Step 7: Phone Number -->
                                    <div class="step" id="step7" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-7 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phoneNumber" class="form-label font-style">Phone Number:</label>
                                            <input type="text" class="form-control mb-2" id="phoneNumber" required>
                                            <small id="phoneNumberError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;"></small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="phoneNext">Continue</button>
                                    </div>

                                    <!-- Step 8: user type options  -->
                                    <div class="step" id="step8" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-8 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label font-style">What is your role?</label>
                                            <div>
                                                <select class="form-select form-select-lg" id="userRole">
                                                    <option value="" selected disabled>Select your role</option>
                                                    <option value="3">Journalist</option>
                                                    <option value="4">Blogger</option>
                                                    <option value="5">Social Media Influencer</option>
                                                    <option value="6">Local Writer</option>
                                                </select>
                                            </div>

                                            <small id="usertypeError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please Select your Type</small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="typeNext">Continue</button>
                                    </div>

                                    <!-- Step 12.5: Password Input -->
                                    <div class="step" id="step125" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-125 mb-3 font-style">Please enter your password to proceed
                                                for login:
                                            </h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="password" class="font-style">Create Password:</label>
                                            <input type="password" class="form-control mb-2" id="password"
                                                name="password" required>
                                            <button type="button" class="btn btn-warning btn-lg mt-2"
                                                id="submitOrder">Submit</button>
                                        </div>
                                    </div>

                                    <!-- new steps changes -->

                                    <!-- new confirm step -->
                                    <div class="step" id="step14" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-14 mb-3"></h3>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="confirmYes2">Yes</button>
                                        <button type="button" class="btn btn-danger btn-lg" id="confirmNo2">No</button>
                                    </div>

                                    <!-- showing what we ask -->

                                    <div class="step" id="step15" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-15 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">

                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="weask">Continue</button>
                                    </div>

                                    <!-- questions 1 -->

                                    <div class="step" id="step16" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-16 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="jobtitle" class="form-label font-style">Job Title:</label>
                                            <input type="text" class="form-control mb-2" id="jobtitle" required>
                                            <small id="jobtitleError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter
                                                your Job Title</small>
                                        </div>
                                        {{-- <button type="button" class="btn btn-warning btn-lg" id="backToFirst">Back</button> --}}
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="jobNext">Next</button>
                                    </div>

                                    <div class="step" id="step17" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-17 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="workexp" class="form-label font-style">Years of
                                                Experience:</label>
                                            <input type="number" class="form-control mb-2" id="workexp" required>
                                            <small id="workexpError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter a valid number of years of
                                                experience.</small>
                                        </div>
                                        {{-- <button type="button" class="btn btn-warning btn-lg" id="backToFirst">Back</button> --}}
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="workNext">Next</button>
                                    </div>

                                    <div class="step" id="step18" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-18 mb-3"></h3>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label font-style">Type of industry ?</label>
                                            <div>
                                                <select class="form-select form-select-lg" id="industry">
                                                    <option value="" selected disabled>Select type</option>
                                                    <option value="RETAIL">RETAIL</option>
                                                    <option value="BAR/ PUB / RESTAURANT">BAR/ PUB / RESTAURANT</option>
                                                    <option value="WHOLESALE / DISTRIBUTION ">WHOLESALE / DISTRIBUTION
                                                    </option>
                                                    <option value="HOTEL / HOSPITALITY">HOTEL / HOSPITALITY</option>
                                                    <option value="CATERING / CHEF">CATERING / CHEF</option>
                                                    <option value="DRINKS BUSINESS">DRINKS BUSINESS</option>
                                                    <option value="JOURNALIST / WRITER / PHOTOGRAPHER">JOURNALIST / WRITER
                                                        / PHOTOGRAPHER</option>
                                                    <option value="SOCIAL INFLUENCE">SOCIAL INFLUENCE</option>
                                                    <option value="OTHER">OTHER</option>

                                                </select>
                                            </div>

                                            <small id="industrytypeError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please Select your Type</small>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="industryNext">Continue</button>
                                    </div>

                                    <div class="step" id="step19" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-19 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="companyName" class="form-label font-style">Company Name</label>
                                            <input type="text" class="form-control mb-2" id="companyName" required>
                                            <small id="companyNameError" class="form-text fw-bold fs-6 text-black"
                                                style="display: none;">Please enter where do you work currently </small>
                                        </div>
                                        {{-- <button type="button" class="btn btn-warning btn-lg" id="backToFirst">Back</button> --}}
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="companyNext">Next</button>
                                    </div>

                                    <!-- procid again step -->
                                    <div class="step" id="step20" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-20 mb-3"></h3>
                                        </div>

                                        {{-- <button type="button" class="btn btn-warning btn-lg" id="backToFirst">Back</button> --}}
                                        <button type="button" class="btn btn-warning btn-lg" id="proceedNext">Proceed
                                            Again</button>
                                             <a href="/" class="btn btn-danger btn-lg" id="goHome">Go to Home</a>
                                    </div>

                                    <!-- Step 13: Final Thank You -->
                                    <div class="step" id="step13" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-13 mb-3"></h3>
                                        </div>
                                    </div>

                                    <!-- Button to trigger redirection -->
                                    <button id="loginButton" class="btn btn-warning btn-lg" style="display:none;">Go to
                                        Login</button>

                                    <!-- Restart Step -->
                                    <div class="step" id="stepRestart" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-restart mb-3"></h3>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-lg" id="restart">Start
                                            Again</button>
                                    </div>

                                    <!-- Add additional steps here... -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chatbot Interface -->
            <div id="chatbot" class="chatbot" style="display: flex">
                <div class="chat-header">
                    <img src="{{ asset('images/bot-avatar.png') }}" alt="Bot"
                        class="d-flex justify-content-center bot-avatar">
                    <button id="close-chat" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="chat-body" id="chat-body">
                    <div class="message bot-message">
                        <span class="fw-bold px-2 ">Already have account, please click here:
                            <span class="animated-link">
                                <a href="{{ route('user.login') }}" style="padding-left:5px;font-size:18px">Login
                                    here!</a>
                            </span></span>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.9.19/libphonenumber-js.min.js"></script>

        <script>
            function transitionSteps(hideStep, showStep) {
                $(hideStep).hide(); // Hide the current step
                $(showStep).show(); // Show the next step
            }

            function isValidEmail(email) {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            function isValidPhoneNumber(phoneNumber) {
                var phonePattern = /^(\+44\s?)?07\d{3}\s?\d{6}$|^\d{4}$/;
                return phonePattern.test(phoneNumber);
            }

            $(document).ready(function() {

                function displayIntroText() {
                    var introText =
                        "Hello, we just need to gather a few details.. it won’t take long.";
                    var promptText = "Please type your first name below;";
                    var combinedText = introText + " " + promptText;

                    // Call typeText function
                    typeText($('#intro-text'), combinedText, 50);
                }

                displayIntroText();

                $('#firstNext').click(function() {
                    var firstName = $('#firstName').val().trim();
                    if (firstName === '') {
                        $('#firstNameError').show();
                    } else {
                        $('#firstNameError').hide();
                        $('#step1').hide();
                        $('#step2').show();

                        var step2Text = `Thanks ${firstName}, what’s your last name?`;
                        typeText($('#step2 .step-text-2'), step2Text, 50);
                    }
                });

                $('#backToFirst').click(function() {
                    $('#firstName').val('');
                    $('#lastName').val('');
                    // Hide all steps except the first one
                    $('#step1').show();
                    $('#step2').hide();
                    $('#intro-text').text('');
                    $('.step-text-2').text('');
                    displayIntroText();

                });

                $('#secondNext').click(function() {
                    var firstName = $('#firstName').val().trim();
                    var lastName = $('#lastName').val().trim();

                    if (lastName === '') {
                        $('#lastNameError').text('Please enter your last name').show();
                    } else {
                        $('#lastNameError').hide();
                        $('#step2').hide();
                        $('#step3').show();

                        var fullName = `${firstName} ${lastName}`;
                        var confirmationText = `So, ${fullName} is that right?`;
                        typeText($('#step3 .step-text-3'), confirmationText, 50);
                    }
                });

                $('#confirmYes').click(function() {
                    $('#step3').hide();
                    // $('#step8').show();

                    /* var establishmentText =
                            `Ok - I think I got that.. thank you. I just need to ask Your role ?”.`; 
                        typeText($('#step8 .step-text-8'), establishmentText, 50);*/

                    $('#step14').show();

                    var confirmquestions =
                        `Good to get that information ${$('#firstName').val()}, do you mind if we ask a few short questions on your work and experience`;
                    typeText($('#step14 .step-text-14'), confirmquestions, 30);

                });

                $('#confirmNo').click(function() {
                    $('#step3').hide();
                    $('#stepRestart').show();

                    var restartText = `It looks like there was an issue. Please start again.`;
                    typeText($('#stepRestart .step-text-restart'), restartText, 90);
                });


                // questions to ask 

                $('#confirmYes2').click(function() {
                    $('#step14').hide();
                    $('#step15').show();

                    var weask =
                        `Ok ${$('#firstName').val()}, great - so we would just like to know a little more about your work and experience in hospitality and drinks..`;
                    typeText($('#step15 .step-text-15'), weask, 40);

                });

                $('#confirmNo2').click(function() {
                    $('#step14').hide();
                    $('#step20').show();

                    var proceedText =
                        `we thank you for showing interest in ROBOT Kombucha - in order for you to become part of a growing team of advocates, we do need to gather some more information - If you’re happy to share this with us, Please Proceed ~ otherwise, thank you for your time and interest in ROBOT, please visit us again soon`;
                    typeText($('#step20 .step-text-20'), proceedText, 30);
                });

                // start again
                $('#proceedNext').click(function() {
                    $('#step20').hide();
                    $('#step15').show();

                    var weask =
                        `Ok ${$('#firstName').val()}, great - so we would just like to know a little more about your work and experience in hospitality and drinks..`;
                    typeText($('#step15 .step-text-15'), weask, 50);

                });

                $('#restart').click(function() {
                    // Reset the form fields
                    $('#firstName').val('');
                    $('#lastName').val('');
                    // Hide all steps except the first one
                    $('#stepRestart').hide();
                    $('#step1').show();
                    $('#step2').hide();
                    $('#step3').hide();
                    $('#step4').hide();

                    // Clear all text in speech bubbles
                    $('#intro-text').text('');
                    $('.step-text-2').text('');
                    $('.step-text-3').text('');
                    $('.step-text-restart').text('');

                    // Optionally, reinitialize the introduction text
                    displayIntroText();

                    // displayIntroText();
                    // var restartText = `It looks like there was an issue. Please start again.`;
                    // typeText($('#intro-text'), combinedText, 50);
                });

                $('#contactNext').click(function() {
                    var email = $('#email').val().trim();

                    if (email === '') {
                        $('#emailError').text('Please enter your email').show();
                    } else if (!isValidEmail(email)) {
                        $('#emailError').text('Please enter a valid email address').show();
                    } else {
                        $('#emailError').hide();
                        $('#contactNext').prop('disabled', true).text('Processing...');
                        // changes 
                        // $('#step4').hide();

                        $.ajax({
                            url: '/send-passcode',
                            method: 'POST',
                            data: {
                                email: email,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#step4').hide();
                                $('#step5').show();


                                var verifyText =
                                    `Please check your inbox and enter the passcode we sent to ${email}`;
                                typeText($('#step5 .step-text-5'), verifyText, 50);
                            },
                            error: function(xhr) {
                                var error = xhr.responseJSON;
                                if (error && error.status === 'error') {
                                    toastr.error(error
                                        .message
                                    ); // Show the error message returned from the backend
                                } else {
                                    toastr.error('Failed to send passcode');
                                }
                            },
                            complete: function() {
                                // Re-enable the button after the request completes
                                $('#contactNext').prop('disabled', false).text('Continue');
                            }
                        });
                    }
                });

                $('#changeEmail').click(function() {
                    $('#step5').hide();
                    $('#step4').show();
                    $('#email').val('');
                    $('#emailError').hide();
                });

                $('#verifyCode').click(function() {
                    var passcode = $('#verificationCode').val().trim();

                    if (passcode === '') {
                        $('#verificationCodeError').text('Please enter the verification code').show();
                    } else {
                        $('#verificationCodeError').hide();

                        $.ajax({
                            url: '/verify-passcode',
                            method: 'POST',
                            data: {
                                passcode: passcode,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#step5').hide();
                                $('#step6').hide();

                                // Make sure phone number step is visible
                                $('#step7').show(); // Ensure #step7 is hidden initially
                                $('#phoneNumber').show(); // Ensure phone number field is visible
                                $('#phoneNext').show(); // Ensure phoneNext button is visible

                                var phonePromptText =
                                    `Great! Thanks for that - so your email address is confirmed - now we just need your phone number ~ please type it in the box below - please use your full mobile or business number.`;
                                typeText($('#step7 .step-text-7'), phonePromptText, 50);
                            },
                            error: function(error) {
                                toastr.error('Invalid passcode');
                            }
                        });
                    }
                });

                // Ensure step 7 (phone number) is handled correctly
                $('#phoneNext').click(function() {
                    var phoneNumber = $('#phoneNumber').val().trim();

                    if (phoneNumber === '') {
                        $('#phoneNumberError').text('Please enter your phone number').show();
                    } else if (phoneNumber.length < 4) {
                        $('#phoneNumberError').text('The phone number must be at least 4 digits long').show();
                    } else {
                        $('#phoneNumberError').hide();
                        $('#step7').hide();

                        $('#step125').show();



                        /* var establishmentText =
                                    `Ok - I think I got that.. thank you. I just need to ask Your role ?”.`; 
                                typeText($('#step8 .step-text-8'), establishmentText, 50); */
                    }
                });

                $('#typeNext').click(function() {
                    var userType = $('#userRole').val(); // Get the selected value of the dropdown
                    if (userType === '' || userType === null) {
                        // Show error message if no role is selected
                        $('#usertypeError').text('Please select your role').show();
                    } else {
                        // Hide error, proceed to the next step
                        $('#usertypeError').hide();
                        $('#step8').hide();


                        $('#step14').show();

                        var confirmquestions =
                            `Good to get that information ${$('#firstName').val()}, do you mind if we ask a few short questions on your work and experience`;
                        typeText($('#step14 .step-text-14'), confirmquestions, 50);

                    }
                });

                $('#weask').click(function() {

                    $('#step15').hide();
                    $('#step16').show();

                    var confirmquestions =
                        `${$('#firstName').val()}, Can you tell us, your current job title?`;
                    typeText($('#step16 .step-text-16'), confirmquestions, 50);
                });

                $('#jobNext').click(function() {
                    var jobTitle = $('#jobtitle').val().trim();


                    if (jobTitle === '') {
                        $('#jobtitleError').text('Please enter your Job Title').show();
                    } else {
                        $('#jobtitleError').hide();
                        $('#step16').hide();
                        $('#step17').show();


                        var jobtitleText =
                        `That’s great - so how long have you been working as a ${jobTitle} ?`;
                        typeText($('#step17 .step-text-17'), jobtitleText, 50);
                    }
                });

                $('#workNext').click(function() {
                    var jobTitle = $('#jobtitle').val().trim();
                    var workexp = $('#workexp').val();

                    if (workexp === '') {
                        $('#workexpError').text('Please enter a valid number of years of experience.').show();
                    } else {
                        $('#workexpError').hide();
                        $('#step17').hide();
                        $('#step18').show();


                        var workText =
                            `So you’ve been working as a ${jobTitle} for ${workexp} ${workexp === 1 ? 'year' : 'years'} that’s really interesting - can we just clarify the industry for your job title `;
                        typeText($('#step18 .step-text-18'), workText, 50);
                    }
                });

                $('#industryNext').click(function() {
                    var industrytype = $('#industry').val(); // Get the selected value of the dropdown
                    if (industrytype === '' || industrytype === null) {
                        // Show error message if no role is selected
                        $('#industrytypeError').text('Please select your industry type').show();
                    } else {
                        // Hide error, proceed to the next step
                        $('#industrytypeError').hide();
                        $('#step18').hide();


                        $('#step19').show();

                        var industryquestion =
                            `${$('#firstName').val()}, where do you work currently?`;
                        typeText($('#step19 .step-text-19'), industryquestion, 50);

                    }
                });

                $('#companyNext').click(function() {
                    var companyName = $('#companyName').val().trim();


                    if (companyName === '') {
                        $('#companyNameError').text('Please enter your Name of company').show();
                    } else {
                        $('#companyNameError').hide();
                        $('#step19').hide();
                        $('#step4').show();


                        var emailPromptText =
                            `Ok ${$('#firstName').val()} ${$('#lastName').val()}, let’s get your contact details - just in case we need to get in touch.. Type your email here, thanks`;
                        typeText($('#step4 .step-text-4'), emailPromptText, 50);

                        $('#email').show();
                        $('#emailError').hide();
                        $('#contactNext').show();
                        $('#changeEmail').show();
                    }
                });

                $('#submitOrder').click(function() {
                    const submitButton = $(this); 
                    // var orderType = $('#orderType').val();
                    var firstName = $('#firstName').val();
                    var lastName = $('#lastName').val();
                    var email = $('#email').val();
                    var phoneNumber = $('#phoneNumber').val();
                    var jobTitle = $('#jobtitle').val();
                    var workExp = $('#workexp').val();
                    var industry = $('#industry').val();
                    var currentlyWork = $('#companyName').val();
                    var selectedRole = 7;
                    // var units = $('#units').val();
                    var password = $('#password').val(); // Get the password field value

                    // Basic validation
                    if (firstName === '' || email === '' || phoneNumber === '' || password === '' ||
                        selectedRole === '') {
                        alert('Please fill in all required fields.');
                        return;
                    }

                    var fullName = firstName + ' ' + lastName;
                    submitButton.prop('disabled', true).text('Submitting...');
                    $.ajax({
                        url: '/signup-submit', // Adjust the URL based on your route
                        method: 'POST',
                        data: {
                            name: fullName, // Store full name in 'name' field
                            email: email,
                            phoneNumber: phoneNumber,
                            jobTitle: jobTitle,
                            workExp: workExp,
                            industry: industry,
                            currentlyWork: currentlyWork,
                            selectedRole: selectedRole,
                            password: password, // Include the password field
                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // CSRF token for Laravel
                        },
                        success: function(response) {

                            if (response.error) {
                                alert(response.error);
                            } else {
                                // Hide step 125 and show step 13
                                $('#step125').hide();
                                $('#step13').show();

                                // Prepare the final order text
                                var finalOrderText =
                                   // `Thank you . Let me get someone to call you asap.. thank you ${firstName}. Thank you again.. ROBOT.`;
                                     `Great, thank you ${firstName} - we have sent you an email verification - which you will need to click on, to confirm and activate your account. `;
                                // Type out the text
                                $('#step13 .step-text-13').empty(); // Clear any existing text
                                typeText($('#step13 .step-text-13'), finalOrderText, 50);
                                $('#loginButton').show();
                            }
                        },
                        error: function(xhr) {
                            // Handle any errors that occurred during the AJAX request
                            alert('An error occurred. Please try again.');
                            submitButton.prop('disabled', false).text('Submit'); 
                        }
                    });
                });

                // Redirect to login page when button is clicked
                $('#loginButton').click(function() {
                    window.location.href =
                        "{{ route('user.login') }}"; // Use Laravel's route helper to generate the URL
                })




                function typeText(element, text, speed) {
                    var i = 0;

                    function type() {
                        if (i < text.length) {
                            $(element).append(text.charAt(i));
                            i++;
                            setTimeout(type, speed);
                        }
                    }
                    type();
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const chatbot = document.getElementById('chatbot');
                const closeChatBtn = document.getElementById('close-chat');
                let reopenTimer;

                function openChat() {
                    chatbot.style.display = 'flex';
                }
                setTimeout(openChat, 3000);

                closeChatBtn.addEventListener('click', function() {
                    chatbot.style.display = 'none';
                    clearTimeout(reopenTimer);
                    reopenTimer = setTimeout(openChat, 60000);
                });
            });
        </script>
    @endsection


    @section('customCss')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

            .frgtpswd {
                font-size: 45px;
                font-weight: 700;
            }

            .font-style {
                font-size: 25px;
                font-weight: 400;

            }

            .animated-link {
                position: relative;
                display: inline-block;
                color: #0ba1a1;
                cursor: pointer;
                z-index: 2;
            }

            .animated-link a {
                text-decoration: none;
                color: inherit;
            }

            .animated-link::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 57%;
                width: 120%;
                height: 120%;
                border: 3px solid red;
                border-radius: 50%;
                transform: translate(-50%, -50%);
                animation: drawCircle 2s infinite;
                opacity: 0.7;
                clip-path: circle(0%);
                z-index: 1;
                pointer-events: none;
            }

            @keyframes drawCircle {
                0% {
                    clip-path: circle(0%);
                }

                50% {
                    clip-path: circle(100%);
                }

                100% {
                    clip-path: circle(0%);

                }
            }

            body,
            html {
                height: 100%;
                /* font-family: 'Roboto', sans-serif; */
                background-color: #f8f9fa;
            }

            .card {
                border-radius: 1rem;
            }

            #instruction-message {
                color: #ffffff;
                text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.2),
                    2px 2px 0 rgba(0, 0, 0, 0.2),
                    3px 3px 0 rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
            }

            #instruction-message:hover {
                text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5),
                    2px 2px 0 rgba(0, 0, 0, 0.5),
                    3px 3px 0 rgba(0, 0, 0, 0.5);
            }

            .form-control {
                border-radius: 50px;
                padding-left: 20px;
                padding-right: 45px;
                transition: all 0.3s;
                background: #fff;
                color: #000;
            }

            .form-control:focus {
                box-shadow: none;
                border-color: #0ba1a1;
            }

            .password-icon {
                cursor: pointer;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #0ba1a1;
                transition: color 0.3s;
            }

            .password-icon:hover {
                color: #088f8f;
            }

            .chatbot {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 360px;
                max-height: 500px;
                border-radius: 10px;
                flex-direction: column;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                background-color: #fff;
                z-index: 1000;
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .chat-header {
                background-color: #0ba1a1;
                color: white;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-radius: 10px 10px 0 0;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            }

            .chat-body {
                padding: 10px;
                background-color: #f0f8ff;
                border-radius: 0 0 10px 10px;
                flex-grow: 1;
                overflow-y: auto;
            }

            .bot-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
                vertical-align: middle;
            }

            .message {
                display: flex;
                align-items: center;
                background-color: #e1f5fe;
                color: #333;
                padding: 10px;
                border-radius: 20px;
                margin: 5px 0;
                max-width: 80%;
            }

            .bot-message {
                padding: 10px;
                background-color: #e1f5fe;
                animation: fadeIn 0.5s ease;
            }

            .btn-close {
                /* background: none; */
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
            }

            /* Chatbot Animation */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 767px) {
                .login-img {
                    width: 60%;
                    height: auto !important;
                }

                .first-row {
                    height: 20%;
                }

                #instruction-message {
                    font-size: 18px;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100%;
                }

                .chatbot {
                    width: 80%;
                    left: 5%;
                }

                .speech-bubble {
                    text-align: center;
                }

            }
        </style>
    @endsection
