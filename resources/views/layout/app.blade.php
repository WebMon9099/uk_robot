<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>Robot Kombucha | Organic Drinks, Kombucha, and Sustainable Cola</title> --}}
    <title>@yield('title', 'Robot Kombucha | Organic Drinks, Kombucha, and Sustainable Cola')</title>
    {{-- <meta name="description" content="Robot Kombucha offers award-winning sustainable drinks, organic kombucha, and the healthiest cola. Perfect for gut health and available in 330ml cans. B-Corp certified and net-zero brand." />
    <meta name="keywords" content="Coke, Coca~Cola, Cola, Kombucha, Sustainable Drinks, Bar Drinks, Drinks Suppliers, Organic drinks, Organic cola, Sustainable soft drinks, Worlds most sustainable cola, Healthiest cola, Sustainable drinks, Soft drinks manufacturers, Organic Kombucha, Organic Cola, Healthy Cola, Gut Health Drink, Organic Soft Drink, Award winning kombucha, Award winning cola, Robot Kombucha, Robot drinks, Robot brand, Net Zero Food, Net Zero Brand, Net Zero Drinks, Net Zero Kombucha, 330ml can, Kombucha in a can, Cola 330ml can, Honey Cola, Honey Kombucha, Organic Honey Cola, Organic Cola, Organic Kombucha, Buy drinks online, Buy Kombucha online, B-Corp Drinks Company, B-Corp Kombucha Company, B-Corp UK drinks, B-Corp ROBOT, B-Corp Net Zero Foods, Probiotic Drink, Probiotic Kombucha, Sustainable drinks, Sustainable Cola, Sustainable Kombucha, Sustainable ROBOT kombucha, ROBOT drinks, ROBOT kombucha, ROBOT cola kombucha, Award winning Kombucha, Award winning Cola, Award winning Honey Cola Kombucha, Drinks Suppliers, Drinks Manufacturer, Organic Drinks Manufacturer, Organic Drinks Supplier, Health Drink, Healthy Drink, Healthy Organic Drinks" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('og:title', 'Robot Kombucha | Organic Drinks, Kombucha, and Sustainable Cola')">
    <meta property="og:description" content="@yield('og:description', 'Robot Kombucha offers award-winning sustainable drinks, organic kombucha, and the healthiest cola. Perfect for gut health and available in 330ml cans. B-Corp certified and net-zero brand.')">
    <meta property="og:url" content="@yield('og:url', url('/'))">
    <meta property="og:image" content="@yield('og:image', asset('default-image.jpg'))">
    <meta property="og:image:alt" content="@yield('og:image:alt', 'Default Image Alt Text')">
    <meta property="og:site_name" content="Your Site Name">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" /> --}}
    <style>
        .toast-success {
            background-color: rgb(10, 192, 116) !important;
        }
    </style>
    <style>
        * {
            font-family: "Saira Condensed", sans-serif;
        }

        #main-image {
            margin-bottom: -125px;
            width: 75%;
            transform: rotate(5deg);
        }

        @media (max-width: 767px) {
            #main-image {
                margin-bottom: 0;
                width: 60%;
                text-align: center;
                margin-top: 25px;
                transform: rotate(0deg);
            }
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            background: url('{{ asset('images/logo.png') }}') center center no-repeat;
            background-size: 50%;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            border-top: 8px solid transparent;
        }

        .nav-tabs .nav-link.active {
            background-color: #324446;
            color: #ffffff !important;
        }

        body {
            /* background: rgb(99, 39, 120) */
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>

<body class="p-0 m-0 overflow-x-hidden ">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4WDMBBQDCT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4WDMBBQDCT');
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        // Set a delay time of 5 seconds (5000 milliseconds)
        setTimeout(function() {
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src =
                'https://embed.tawk.to/66fbfdd9e5982d6c7bb72efd/1i945f792'; // Replace 'key/key' with your actual key
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        }, 10000); // Delay of 5 seconds
    </script>
    <!--End of Tawk.to Script-->

    <!--End of Tawk.to Script-->
    {{-- <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <script>
        var botmanWidget = {
            frameEndpoint: '/welcome', // Adjust to your endpoint
            introMessage: "Hii! 👋 I'm your ROBOT assistant. How can I help you today?",
            title: "Chat with us!",
            bubbleAvatarUrl: "{{ asset('assets/images/chat.png') }}", // Your bot avatar URL
            bubbleBackground: "#ffffff", // Change this to your desired color
            autoOpen: false // Start with false
        };
        
        // Function to open the Botman widget
        function openBotmanWidget() {
            var maxAttempts = 10; // Maximum number of attempts to check if BotmanWidget is loaded
            var attempts = 0;
            var interval = setInterval(function() {
                if (typeof BotmanWidget !== 'undefined' && typeof BotmanWidget.open === 'function') {
                    BotmanWidget.open();
                    clearInterval(interval); // Stop checking once the widget is opened
                } else {
                    attempts++;
                    if (attempts >= maxAttempts) {
                        console.error('BotmanWidget is not defined after multiple attempts.');
                        clearInterval(interval); // Stop checking after max attempts
                    }
                }
            }, 500); // Check every 500ms
        }

        // Call the function to open the widget on page load
        window.onload = function() {
            openBotmanWidget();
        };
    </script> --}}
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-5 px-4">
                    <form action="{{ route('save.ip.form') }}" method="post">
                        @csrf
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                required>
                            <label class="form-check-label" for="flexCheckDefault">
                                Do you Accept terms and conditions and our <a
                                    href="{{ route('privacy.policy') }}">Privacy Policy</a>.
                            </label>
                        </div>
                        <button class="btn btn-dark px-4" type="submit">Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="profileModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="profileUpdate" id="profileUpdate" method="post" action="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <p class="text-danger" id="image-error"></p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @yield('main_section')
    @include('components.footer')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--owl js-->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @session('success')
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endsession
    @session('error')
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endsession
    <script>
        $(window).on('load', function() {
            $('.loader-wrapper').hide();
            $('.content').css('display', 'block');
        });
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#profileUpdate").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route('account.updateProfileImage') }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == false) {
                        var error = response.error;
                        if (error.image) {
                            $("#image-error").html(error.image);
                        }

                    } else {
                        window.location.href = '{{ url()->current() }}'
                    }
                }


            })
        });
    </script>

    <script>
        setInterval(() => {
            $.ajax({
                type: "GET",
                url: "{{ route('delete.extra.data') }}",
            });
        }, 3600000);
    </script>
    @yield('customCss')
    @yield('customJs')

</body>

</html>
