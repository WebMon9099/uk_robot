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
                    <h3 class="frgtpswd">Login Here!</h3>
                    {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width:10%;"> --}}
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card-block">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-flex justify-content-center first-row">
                                <img src="{{ asset('images/home-section-image_clean_new.png') }}" alt="login form"
                                    class="img-fluid login-img" style="border-radius: 1rem 0 0 1rem; height:100%;max-width:110%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    @if (session('success'))
                                        <script>
                                            toastr.success("{{ session('success') }}");
                                        </script>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form id="login-form" method="POST" action="{{ route('user.login') }}">
                                        @csrf
                                        <h4 id="instruction-message" class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">
                                        </h4>

                                        <div class="form-outline mb-4">
                                            <input type="email" class="form-control form-control-lg mb-1" id="email"
                                                name="email" placeholder="Enter your email" required>
                                            <span id="email-error" class="text-warning ml-1 fw-bold" ></span>
                                        </div>

                                        <div class="form-outline position-relative mb-4">
                                            <input type="password" class="form-control form-control-lg pe-5 password-input"
                                                placeholder="Enter password" id="password-input" name="password" required>
                                            <i class="fa-regular fa-eye-slash align-middle position-absolute end-0 top-50 text-muted password-icon"
                                                id="password-addon"
                                                style="cursor: pointer; transform: translateY(-50%);padding-right:5%;"></i>
                                            <span id="password-error" class="text-warning ml-1 fw-bold" ></span>
                                        </div>

                                        <div class="pt-1 mb-4 d-flex justify-content-center">
                                            <button class="btn btn-warning btn-lg btn-block w-50 me-2"
                                                type="submit">Login</button>
                                            {{-- <a href="{{ route('mutiRegsiter') }}"
                                                class="btn btn-warning btn-lg btn-block w-50">Signup</a> --}}
                                        </div>


                                        <div class="d-flex justify-content-center align-items-center">
                                            <a class="fw-bolder fs-5 text-white text-center"
                                                href="{{ route('user.forgetPasswordView') }}">Forgot password?</a>
                                        </div>
                                        @php
    $referer = request()->headers->get('referer');
@endphp

@if (!in_array($referer, ['https://robotkombucha.co.uk/press', 'https://robotkombucha.co.uk/blog']))

    <div class="d-flex justify-content-center align-items-center mt-1">
        <span class="fw-bolder fs-5 text-white text-center">If you don't have an account?
            <a href="{{ route('mutiRegsiter') }}" class="text-white text-center">SignUp</a>
        </span>
    </div>
@endif

                                        <div id="error-message" class="text-warning ml-1 fw-bold" style=""></div>
                                    </form>
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
                    <!-- <div class="message bot-message">
                        <span class="fw-bold px-2 ">If you don't have an account, please click here:
                            <span class="animated-link">
                                <a href="{{ route('mutiRegsiter') }}" style="padding-left:5px;font-size:18px">Sign up
                                    here!</a>
                            </span></span>
                    </div> -->
                    @php
    $referer = request()->headers->get('referer');
    $route = in_array($referer, ['https://robotkombucha.co.uk/blog', 'https://robotkombucha.co.uk/press']) 
                ? route('register')  // Redirect to the register route
                : route('mutiRegsiter'); // Default route
@endphp

<div class="message bot-message">
    <span class="fw-bold px-2">If you don't have an account, please click here:
        <span class="animated-link">
            <a href="{{ $route }}" style="padding-left:5px;font-size:18px">Sign up here!</a>
        </span>
    </span>
</div>

                </div>
            </div>

        </div>

        {{-- @include('components.news-letter')
        @include('components.contact-us') --}}
    @endsection

    @section('customCss')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

            .frgtpswd {
                font-size: 45px;
                font-weight: 700;
            }

            .animated-link {
                pointer-events: auto;
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
                font-family: 'Roboto', sans-serif;
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

            }
        </style>
    @endsection

    @section('customJs')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
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

        document.addEventListener('DOMContentLoaded', function() {
            const message = "Welcome to Robot Kombucha, For login please provide your email and password.";
            const instructionMessageElement = document.getElementById("instruction-message");

            let index = 0;

            function typeLetter() {
                if (index < message.length) {
                    instructionMessageElement.textContent += message.charAt(index);
                    index++;
                    setTimeout(typeLetter, 100);
                }
            }

            typeLetter();

            document.getElementById('password-addon').addEventListener('click', function() {
                const passwordInput = document.getElementById('password-input');
                const icon = this;

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);
            const errorMessageContainer = document.getElementById('error-message');
            errorMessageContainer.innerHTML = '';
            const emailErrorContainer = document.getElementById('email-error');
            emailErrorContainer.innerHTML = '';
            const passwordErrorContainer = document.getElementById('password-error');
            passwordErrorContainer.innerHTML = '';

            fetch('{{ route('user.login') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        if (data.errors) {
                            if (data.errors.password) {
                                passwordErrorContainer.innerHTML = data.errors.password;
                            }
                            if (data.errors.email) {
                                emailErrorContainer.innerHTML = data.errors.email; // Add this line
                            }

                        } else {
                            passwordErrorContainer.innerHTML = data.error;
                        }
                    }
                })
                .catch(error => {
                    errorMessageContainer.innerHTML =
                        'An unexpected error occurred. Please try again.'; // Handle network errors
                    console.error('Error:', error);
                });
        });
    </script>
@endsection