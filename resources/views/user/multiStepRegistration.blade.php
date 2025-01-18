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
                    <h3 class="frgtpswd">Register Here!</h3>
                    {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width:10%;"> --}}
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card-block">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 col-lg-5 d-flex justify-content-center first-row">
                                <img src="{{ asset('images/home-section-image.png') }}" alt="login form"
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
                                    <!-- Step 2 -->
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
                                    <!-- Step 8: Resale Details -->
                                    <div class="step" id="step8" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-8 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label font-style">Are you buying to re-sell?</label>
                                            <div>
                                                <button type="button" class="btn btn-warning btn-lg"
                                                    id="resellYes">Yes</button>
                                                <button type="button" class="btn btn-danger btn-lg"
                                                    id="resellNo">No</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 9: Establishment Details -->
                                    <div class="step" id="step9" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-9 mb-3"></h3>
                                            <div class="form-group mb-4" id="establishmentContainer">
                                                <label for="establishmentType" class="form-label font-style">What sort of
                                                    establishment are you
                                                    operating?</label>
                                                <select class="form-control mb-3" id="establishmentType">
                                                    <option value="Retail/Online Shop">Retail / Online Shop</option>
                                                    <option value="Luxury Retail Store">Luxury Retail Store</option>
                                                    <option value="Wholesale/Distribution">Wholesale / Cash & Carry /
                                                        Drinks Distribution
                                                    </option>
                                                    <option value="On/Off-Trade Outlet/Restaurant">On / Off-Trade Outlet /
                                                        Restaurant
                                                    </option>
                                                    <option value="Duty-Free">Duty-Free</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <button type="button" class="btn btn-warning btn-lg"
                                                    id="establishmentContainerNext">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 10: Units -->
                                    <div class="step" id="step10" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-10 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="font-style">How Many Units</label>
                                            <input class="form-control mb-2"type="number" id="units">
                                        </div>
                                        <button type="button" class="btn btn-warning btn-lg"
                                            id="unitsNext">Continue</button>
                                    </div>
                                    <!-- Step 11: Place an Order -->
                                    <div class="step" id="step11" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-11 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="font-style">Would you like to place an order?</label>
                                            <div>
                                                <button type="button" class="btn btn-warning btn-lg"
                                                    id="orderYes">Yes</button>
                                                <button type="button" class="btn btn-danger btn-lg"
                                                    id="orderNo">No</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 12: Order Options -->
                                    <!-- Step 12: Order Selection -->
                                    <div class="step" id="step12" style="display: none;">
                                        <div class="speech-bubble">
                                            <h3 class="step-text-12 mb-3"></h3>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="font-style">What type of order are you interested in?</label>
                                            <select class="form-control mb-3" id="orderType">
                                                <option value="Singles">I’m interested in ordering some singles</option>
                                                <option value="Retail">I’d like to retail ROBOT from my shop</option>
                                                <option value="Wholesale">I’m a wholesaler / Cash & Carry outlet and I’d
                                                    like to list ROBOT
                                                    on our system</option>
                                                <option value="Supermarket">We’re a Supermarket - and we’d like to stock
                                                    ROBOT</option>
                                                <option value="On-Trade">We’re On-Trade ~ looking to list ROBOT in our
                                                    restaurant or pub.
                                                </option>
                                                <option value="Other">We operate ‘Other’ outlets where we’d like to stock
                                                    ROBOT</option>
                                            </select>
                                            <button type="button" class="btn btn-warning btn-lg"
                                                id="nextStep">Next</button>
                                        </div>
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
                    "Hi, in order to satisfy your sales query, we need to take a few details.. it won’t take long.";
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
                    $('#step4').show();

                    var emailPromptText =
                        `Ok ${$('#firstName').val()} ${$('#lastName').val()}, let’s get your contact details - just in case we need to get in touch.. Type your email here, thanks`;
                    typeText($('#step4 .step-text-4'), emailPromptText, 50);

                    $('#email').show();
                    $('#emailError').hide();
                    $('#contactNext').show();
                    $('#changeEmail').show();
                });

                $('#confirmNo').click(function() {
                    $('#step3').hide();
                    $('#stepRestart').show();

                    var restartText = `It looks like there was an issue. Please start again.`;
                    typeText($('#stepRestart .step-text-restart'), restartText, 90);
                });
                  // start again 

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
                        $('#step8').show();

                        var establishmentText =
                            `Ok - I think I got that.. thank you. So you’d like to buy some ROBOT KOMBUCHA - that’s great.
                                             In order to direct your purchase to the right team, I just need to ask a couple more questions.Are you buying to re-sell?”.`;
                        typeText($('#step8 .step-text-8'), establishmentText, 50);
                    }
                });
                $('#resaleNext').click(function() {
                    var establishmentType = $('#establishmentType').val();
                    if ($('#establishmentContainer').is(':visible') && establishmentType === '') {
                        $('#establishmentTypeError').text('Please select your establishment type').show();
                    } else {
                        $('#establishmentTypeError').hide();
                        $('#step8').hide();
                        $('#step9').show();

                        var orderText =
                            `Ok, I think I got that. Thank you. So you’d like to buy some ROBOT KOMBUCHA - that’s great. In order to direct your purchase to the right team, I just need to ask a couple more questions.`;
                        typeText($('#step9 .step-text-9'), orderText, 50);
                    }
                });

                $('#resellYes').click(function() {
                    $('#step8').hide();
                    $('#step9').show();
                    var establishmentText = `Ok, got that. What sort of establishment are you operating?`;
                    typeText($('#step9 .speech-bubble h3'), establishmentText, 50);
                });

                $('#resellNo').click(function() {
                    $('#establishmentContainer').hide();
                    $('#step9').show();
                    var noResellText = `Thank you. We can proceed to the next step.`;
                    typeText($('#step9 .speech-bubble h3'), noResellText, 50);
                });

                $("#establishmentContainerNext").click(function() {
                    var establishmentType = $('#establishmentType').val();
                    $('#step9').hide();
                    $('#step10').show();

                    var orderText =
                        `Ok great so you’re in charge of a ${establishmentType}. How many units do you envisage selling per month?`;
                    typeText($('#step10 .step-text-10'), orderText, 50);
                })

                $('#unitsNext').click(function() {
                    var units = $('#units').val().trim();

                    if (units === '') {
                        // Handle validation if needed
                    } else {
                        $('#step10').hide();
                        $('#step11').show();

                        var orderPromptText =
                            `Terrific - thank you for all that information.. that helps a lot.. I’ll get someone to make contact with you ~ in the meantime, would you like to place an order?`;
                        typeText($('#step11 .step-text-11'), orderPromptText, 50);
                    }
                });

                $('#orderYes').click(function() {
                    $('#step11').hide();
                    $('#step12').show();

                    var orderOptionsText = `Great! Please select the type of order you’re interested in.`;
                    typeText($('#step12 .step-text-12'), orderOptionsText, 50);
                });

                $('#orderNo').click(function() {
                    $('#step11').hide();
                    $('#step13').show();

                    var finalText =
                        `Let me get someone to call you asap.. thank you ${$('#firstName').val()}. Thank you again.. ROBOT.`;
                    typeText($('#step13 .step-text-13'), finalText, 50);
                });

                $('#nextStep').click(function() {
                    var orderType = $('#orderType').val();

                    // Basic validation
                    if (orderType === '') {
                        alert('Please select an order type.');
                        return;
                    }

                    // Hide step 12 and show step 125
                    $('#step12').hide();
                    $('#step125').show();
                });

                $('#submitOrder').click(function() {
                    var orderType = $('#orderType').val();
                    var firstName = $('#firstName').val();
                    var lastName = $('#lastName').val();
                    var email = $('#email').val();
                    var phoneNumber = $('#phoneNumber').val();
                    var units = $('#units').val();
                    var password = $('#password').val(); // Get the password field value

                    // Basic validation
                    if (orderType === '' || firstName === '' || email === '' || phoneNumber === '' || units ===
                        '' || password === '') {
                        alert('Please fill in all required fields.');
                        return;
                    }
                    var fullName = firstName + ' ' + lastName;
                    $.ajax({
                        url: '/submit-form', // Adjust the URL based on your route
                        method: 'POST',
                        data: {
                            orderType: orderType,
                            name: fullName, // Store full name in 'name' field
                            email: email,
                            phoneNumber: phoneNumber,
                            units: units,
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
                                    `Thank you for choosing to order ${orderType}. Let me get someone to call you asap.. thank you ${firstName}. Thank you again.. ROBOT.`;

                                // Type out the text
                                $('#step13 .step-text-13').empty(); // Clear any existing text
                                typeText($('#step13 .step-text-13'), finalOrderText, 50);
                                $('#loginButton').show();
                            }
                        },
                        error: function(xhr) {
                            // Handle any errors that occurred during the AJAX request
                            alert('An error occurred. Please try again.');
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
