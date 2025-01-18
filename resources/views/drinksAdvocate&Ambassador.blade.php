@extends('layout.app')
@section('main_section')
    <style>
        #main-image {
            margin-bottom: -125px;
            width: 85%;
            transform: rotate(5deg);
        }

        .content-headers {
            font-size: 3.5rem;
            font-weight: bold;
        }

        .content-subheaders {
            font-size: 1.4rem;
        }

        .content-section {
            background-color: #f7f7f7;
            padding: 50px 20px;
        }

        .content-header {
            font-size: 2.5rem;
            color: #000045;
            font-weight: bold;
        }

        .content-subheader {
            font-size: 1.2rem;
            font-weight: 500;
            color: #555;
            margin-top: 15px;
        }

        .action-btn {
            background-color: #000045;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background-color: #000045;
        }

        .img-rounded {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .advocate-images {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .advocate-images img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .signup-btn {
            background-color: #0000A8;
            color: white
        }
    </style>

    <div class="position-relative text-white" style="background-color: #000045;">
        <div>
            @include('components.navbar')
        </div>
        <div class="container py-5 mt-5">
            <div class="text-center text-white">
                <h1 class="content-headers">ROBOT- Advocates & Ambassadors</h1>
                </h1>
                <p class="content-subheaders mt-3">
                    Welcome to ROBOT - Advocates & Ambassadors. Join us in creating a healthier, sustainable future with
                    ROBOT Organic Honey Cola Kombucha.
                </p>
            </div>
        </div>
    </div>

    <div class="container content-section mt-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="content-header">Why ROBOT?</h2>
                <p class="content-subheader">
                    ROBOT Organic Honey Cola Kombucha is a solution to the global sugar problem in the soft drinks industry
                    - we are seeking enthusiastic experts as ambassadors and advocates.please join us!
                    The problem of high sugar drinks is closely associated with sugar addiction, processed foods, poor
                    health is costing health systems around the world billions of pounds, and is responsible for more than
                    70% of all health issues.
                    ROBOT Organic Honey Cola Kombucha was conceived and developed specifically as a real sustainable and
                    healthy alternative to the poor quality colas, diet colas and high sugar fizzy drinks.
                </p>
                <ul class="m-2" style="font-size: 1.2rem;">
                    <li>Hand-crafted, premium health drink.</li>
                    <li>Designed to mimic mainstream cola flavors without harmful ingredients.</li>
                    <li>Developed with sustainability and health at its core.</li>
                </ul>
                <div class="mt-4" style="margin-left:15px;">
                    <a href="{{ route('advocateambassadorSignup') }}" class="action-btn mt-2">Become an Advocate</a>
                </div>
            </div>
            <div class="col-lg-5">
                <img src="{{ asset('images/home-section-image_clean_new.png') }}" alt="ROBOT Kombucha" class="">
            </div>
        </div>
    </div>

    <div class="container content-section">
        <h2 class="text-center content-header">Who Can Join?</h2>
        <div class="row text-center mt-4">
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <img src="{{ asset('images/glass.png') }}" alt="Hospitality Industry" class="img-rounded"
                    style="height: 50%; width:50%;">
                <h4 class="mt-1">Hospitality Professionals</h4>
                <p>If you are in the hospitality or bar business, we would love to invite you to sign up to our Advocacy
                    Program,
                    and become a ROBOT Trusted Advocate / Ambassador.</p>
                <a class="btn btn-sm signup-btn mt-auto" style="margin-top: auto;">Sign Up</a>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <img src="{{ asset('images/Health-Food-Enthusiasts.jpeg') }}" alt="Health Food Industry" class="img-rounded"
                    style="height: 50%; width:50%;">
                <h4 class="mt-1">Health Food Enthusiasts</h4>
                <p>Help make ROBOT more accessible to health-conscious consumers.
                    We would love to invite you to sign up to our Advocacy Program, and become a ROBOT Trusted Advocate /
                    Ambassador.
                </p>
                <a class="btn btn-sm signup-btn mt-auto" style="margin-top: auto;">Sign Up</a>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <img src="{{ asset('images/patner.png') }}" alt="Retail Industry" class="img-rounded"
                    style="height: 50%;width:50%;">
                <h4 class="mt-1">Retail Partners</h4>
                <p>If you are in retail and you’d like to get involved.We would love to invite you to sign up to our
                    Advocacy Program, and become a ROBOT Trusted Advocate / Ambassador.</p>
                <a class="btn btn-sm signup-btn mt-auto" style="margin-top: auto;">Sign Up</a>
            </div>
        </div>

    </div>
    <div class="container p-5 " style="background-color: rgba(173, 216, 230, 0.677);">
        <div class="row align-items-center ">
            <div class="col-lg-7 col-12 ps-4">
                <div class="ps-3">
                    <div>
                    </div>
                    <div>
                        <p class="w-75">
                            ROBOT is a complex, hand-crafted, super premium health drink, with real wellbeing benefits and
                            sustainability at the forefront of its ethos.
                            Everything bad about mainstream colas, has been reengineered in ROBOT, carefully redesigned and
                            expertly redeveloped so that it offers an altogether sustainable and healthy solution, and with
                            a similar taste and flavour to mainstream cola.
                            ROBOT was conceived in part, by Ai - hence the name - and whilst we observed some important
                            elements of our ai advice, we still need real people to support our work, and champion our
                            brand.
                        </p>
                    </div>
                    <div>
                        <p class="w-75"> This could be you..
                            If you work in the drinks or hospitality industry, and you’d like to help support the work we
                            do, and get involved with the ROBOT brand, we would love to hear from you.
                            We would like to hear from you also, if you work in the organic food business, health food
                            arena,
                            or public health and you’d like to see ROBOT available in more places.
                            <br>
                            We offer help and support to advocates and ambassadors of ROBOT along with offering exclusive
                            tastings and events ~ special key details. Be the first to know of new listings, be part of a
                            growing team of enthusiastic business influencers, leaders, champions and advocates.
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="position-relative d-none d-lg-block">
                    <!-- First Image -->
                    <img src="{{ asset('/images/section-5/bottle-2_clean.png') }}" alt="Bottle"
                        class="img-fluid position-absolute"
                        style="z-index: 1; transform: rotate(-5deg); left: -20%; top: -30px; width:65%;">
            
                    <!-- Second Image (New Image) -->
                    <img src="{{ asset('/images/section-5/bottle-3_clean.png') }}" alt="New Bottle"
                        class="img-fluid position-absolute"
                        style="z-index: 2; transform: rotate(-8deg); left: -3%; top: 4px; width:60%; opacity: 0.9;">
                </div>
                <!-- Third Image -->
                <img src="{{ asset('/images/section-5/bottle-1.png') }}" alt="Background"
                    class="img-fluid position-relative"
                    style="z-index: 3; transform: rotate(-7deg); margin-top: 30px; width: 80%;left:31px;">
            </div>
            
        </div>
    </div>
    <div class="container text-center py-5" id="sign-up">
        <h2 class="content-header">Sign Up to Join Us</h2>
        <p class="content-subheader">
            If you would like to be an advocate for healthy, sustainable ROBOT Kombucha ~ Please proceed to the sign-up
            process
        </p>
        <a href="{{ route('advocateambassadorSignup') }}" class="action-btn">Sign Up Now</a>
    </div>

    @include('components.news-letter')
@endsection
