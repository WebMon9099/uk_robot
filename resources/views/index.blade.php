@extends('layout.app')
@section('main_section')
<style>
    .custom-image {
    max-width: 70%;
    margin-left: 30%;
}

@media (max-width: 768px) { /* For devices with width <= 768px */
    .custom-image {
        margin-left: auto; /* Center the image */
        margin-right: auto; /* Center the image */
        display: block; /* Ensure block-level centering */
    }
}

    #main-image {
        margin-bottom: -125px;
        width: 85%;
        transform: rotate(5deg);
    }

    .home-comming-soon {
        height: 100%;
        position: absolute;
        display: inline-block;
        box-sizing: content-box;
        left: 1%;
        z-index: 1;
        width: 55%;

    }

    .home-comming-soon img {
        display: inline-block;
    position: absolute;
    transform: rotate(-10deg);
    width: 61%;
    top: 175px;
    left: 168px;
    }

    .home-comming-soon-1 {
        height: 100%;
        position: absolute;
        display: inline-block;
        box-sizing: content-box;
        left: 48%;
        /* top:54%; */
        z-index: 4;
        width: 67%;

    }

    .home-comming-soon-1 img {
        display: inline-block;
        position: absolute;
        transform: rotate(-10deg);
        /* Rotate image diagonally */
        width: 50%;
        top: 27%;
        /* Adjust size as needed */

        /* Max width for large screens */
    }
    .section-4-img
    {
        margin-left: 20%;
    }

    @media (max-width: 768px) {
        .section-4-img
        {
            margin-left:0%; 
        }
        .overlay {
            font-size: 4rem;
            /* Smaller font size for mobile */
        }

        .overlay img {
            /*transform: rotate(-5deg); Less rotation for mobile */
            width: 100%;
            /* Adjust size for smaller screens */
            max-width: 200px;
            margin-top: 170px;
            /* Max width for smaller screens */
        }
    }

    @media (max-width: 576px) {


        .home-comming-soon img {
            position: absolute;
            top: 10% !important;
            transform: rotate(0deg);
            width: 89%;
            height: 115px;
            left: 82px;
        }

        .home-comming-soon-1 img {
            position: absolute;
            top: 10% !important;
            transform: rotate(0deg);
            width: 84%;
            height: 115px;
            right: 138px;
        }
    }
</style>
    <!-- body -->
    <!-- {{-- section 1 --}} -->
    <div class="position-relative text-white"
        style="background-color: #0ba1a1; width: 100vw !important; overflow-x: hidden !important;">
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.15;">
        </div>
        <div>
            @include('components.navbar')
        </div>
        <div class="container pt-lg-3 mt-lg-3 pt-0 mt-0" style="width: 100vw !important; overflow-x: hidden !important;">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 order-lg-2 order-1 text-lg-start text-center">
                    <style>
                        @media screen and (max-width: 768px) {
                            .second-p {
                                font-size: 10px !important;
                            }
                            .mobile-button {
                                display: block !important;
                                text-align: center;
                                margin-top: 20px;
                            }
                        }
                        @media screen and (min-width: 768px) {
                            .fisrt-p {
                                font-size: 25px !important;
                            }
                            .second-p {
                                font-size: 20px !important;
                            }
                        }
                    </style>
                    <div class="">
                        <h1 class="fw-bold" style="font-size: 75px" id="main-heading">ROBOT Kombucha</h1>
                    </div>
                    <div class="fs-5 d-lg-block d-md-block d-sm-block d-none">
                        <p class="fw-semibold fisrt-p">~The organic, healthy and sustainable alternative to Coca~Cola and other high sugar, unhealthy fizzy drinks.. </p>
                    </div>
                    <div class="fs-5 d-lg-block d-md-block d-sm-block d-none">
                        <p class="second-p">3 exciting flavours including Award-Winning Organic Honey Cola Kombucha, Cherry Cola Kombucha and Tropical Pineapple & Mango Kombucha</p>
                        <p class="second-p">Hand-crafted using the finest organic ingredients - including wild organic honey, natural organic kombucha, and original cola flavours such as lemon, orange and cola nut.</p>
                    </div>
                    <!-- Desktop button (hidden on mobile) -->
                    @if ($sales_status == 1)      

                    <div class="position-relative d-none d-lg-block">
                        <a href="{{ route('product') }}" class="btn px-5 rounded-5 text-white" style="background-color: #F2A71B; padding: 15px 40px;">Order Now</a>
                    </div>
                    @endif
                </div>
        
                <div class="col-12 col-lg-6 order-lg-1 order-2">
                    <div class="text-center position-relative mt-lg-5 mt-0">
                        <div class="position-absolute" style="left: 0%; z-index: 1;">
                            <img src="{{ asset('/images/star-bg.svg') }}" alt="" style="width: 80%;">
                        </div>
                        <img src="{{ asset('images/home-section-image_clean_new.png') }}" alt="" class="img-fluid main-section-img" style="position: relative; z-index: 2; width:100rem;max-width:80%;">
                    </div>
                    @if ($sales_status == 1)     
                    <!-- Mobile button (hidden on desktop, shown after image on mobile) -->
                    <div class="d-lg-none text-center mt-3"  style="position: relative; z-index: 10;">
                        <a href="{{ route('product') }}" class="btn px-5 rounded-5 text-white" style="background-color: #F2A71B; padding: 15px 40px;">Order Now</a>
                    </div>
                    @endif
                </div>
        
                <div class="col-12 col-lg-6 order-lg-1 order-2 d-lg-none d-md-none d-sm-none d-block pt-0">
                    <div class="fs-5 text-center mt-0">
                        <p class="fw-semibold fs-2 mt-0">~The organic, healthy and sustainable alternative to Coca~Cola and other high sugar, unhealthy fizzy drinks..</p>
                    </div>
                    <div class="fs-5 text-center">
                        <p>3 exciting organic flavors including Award-Winning Organic Honey Cola Kombucha, Organic Cherry Cola Kombucha and Organic Tropical Pineapple & Mango Kombucha</p>
                        <p>Hand-crafted using the finest organic ingredients - including wild organic honey, natural organic kombucha, and original organic cola flavours such as organic lemon, organic orange and organic cola nut.</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container pt-lg-3 mt-lg-3 pt-0 mt-0" style="width: 100vw !important; overflow-x: hidden !important;">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 order-lg-2 order-1 text-lg-start text-center">
                    <style>
                        @media screen and (max-width: 768px) {
                          .second-p{
                          	font-size:10px !important;
                          }
                            
                        }
                       @media screen and (min-width: 768px) {
                          .fisrt-p {
                          	font-size:25px !important;
                          }
                         .second-p {
                          	font-size:20px !important;
                          }
                        }
                    </style>
                    <div class="">
                        <h1 class="fw-bold" style="font-size: 75px" id="main-heading">ROBOT Kombucha
                        </h1>
                    </div>
                    <div class="fs-5 d-lg-block d-md-block d-sm-block d-none">
                        <p class="fw-semibold fisrt-p">~The organic,healthy and sustainable alternative to Coca~Cola and other high sugar, unhealthy fizzy drinks.. </p>
                    </div>
                    <div class="fs-5 d-lg-block d-md-block d-sm-block d-none">
                       <p class="second-p">3 exciting organic flavors including Award-Winning Organic Honey Cola
                            Kombucha, Organic Cherry Cola Kombucha and Organic Tropical Pineapple & Mango Kombucha</p>
                        <p class="second-p">Hand-crafted using the finest organic ingredients - including wild organic honey, natural organic
                            kombucha, and original organic cola flavours such as organic lemon, organic orange and organic
                            cola nut.</p>
                    </div>
                    <div class=" position-relative d-lg-block d-md-block d-sm-block d-none">
                        <a href="{{ route('product') }}" class="btn px-5 rounded-5 text-white"
                            style="background-color: #F2A71B;padding:15px, 40px, 10px, 40px">Read More</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-lg-1 order-2">
                    <div class="text-center position-relative mt-lg-5 mt-0">
                        <div class="position-absolute" style="left: 0%; z-index: 1;">
                            <img src="{{ asset('/images/star-bg.svg') }}" alt="" style="width: 80%;">
                        </div>
                        <img src="{{ asset('images/home-section-image_clean_new.png') }}" alt=""
                            class="img-fluid main-section-img" style="position: relative; z-index: 2; width:100rem; ">
                     </div>
                </div>
                <div class="col-12 col-lg-6 order-lg-1 order-2  d-lg-none d-md-none d-sm-none d-block pt-0">
                    <div class="fs-5 text-center mt-0">
                        <p class="fw-semibold fs-2 mt-0">~The organic, healthy and sustainable alternative to Coca~Cola and other high sugar, unhealthy fizzy drinks..</p>
                      
                    </div>
                    <div class="fs-5 text-center">
                      <p>3 exciting organic flavors including Award-Winning Organic Honey Cola
                            Kombucha, Organic Cherry Cola Kombucha and Organic Tropical Pineapple & Mango Kombucha</p>
                        <p>Hand-crafted using the finest organic ingredients - including wild organic honey, natural organic
                            kombucha, and original organic cola flavours such as organic lemon, organic orange and organic
                            cola nut.</p>
                    </div>
                </div>


            </div>
        </div> --}}
    </div>
    <!-- {{-- section 2 --}} -->
    <div class="position-relative py-2" style="background: #324446;">
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.2;">
        </div>
        <div class="z-3 ">
            @include('components.bullet')
            <div class="mt-3 container">
                <div class="row w-100 align-items-center">
                    <div class="col-12 col-lg-4 text-white">
                        <h2 class="fw-bold fs-1 mb-2">Organic Honey Kombucha Cola Infusion</h2>
                        <h5>ROBOT Kombucha takes the classic cola flavor to new heights by infusing it with the richness
                            of
                            organic honey. This unique twist brings a hint of sweetness and depth to each sip, making it
                            a
                            truly
                            irresistible beverage.</h5>
                        <h2 class="my-2">Sustainable and healthy for people and planet:</h2>
                        <p>Say goodbye to the artificial additives and excessive sugars found in traditional cola
                            drinks.
                            ROBOT
                            Kombucha is carefully crafted with premium, all-natural ingredients to provide you with a
                            healthier
                            alternative. It is low in calories, free from high fructose corn syrup, and packed with
                            beneficial
                            probiotics and antioxidants.</p>
                        <a href="{{ route('honey.cola') }}" class="btn w-100 rounded-4 position-relative " style="background: #41f2c0">Learn more</a>
                    </div>
                    <div class="col-12 col-lg-8">
                        <img src="{{ asset('images/section-2/section-2-bottle.png') }}" alt="" class="img-fluid custom-image">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- {{-- section 3 --}} -->
    <div class="position-relative py-3" style="background-color: #f32c00;">
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.2;">
        </div>
        <div class="row container text-white align-items-center ">
            <div class="col-lg-8 col-12">
                {{-- <div class="home-comming-soon">
                   
                    <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon" class="">
                </div> --}}
                <img src="{{ asset('images/section-3/section-3-bottle_clean_new.png') }}" alt="" class="img-fluid ">
            </div>
            <div class="col-lg-4 col-12">
                <h2>Pineapple & Mango Kombucha</h2>
                <p>ROBOT brings you the refreshing and delicious combination of tropical exotic fruits with this
                    pineapple and
                    mango kombucha. The zesty and rich sunny flavours combine with the hand-made kombucha etc.
                </p>
                <h3>Healthier Ingredients, Healthier You:</h3>
                <p>Say goodbye to the artificial additives and excessive sugars found in traditional cola drinks. ROBOT
                    Kombucha is
                    carefully crafted with premium, all-natural ingredients to provide you with a healthier alternative.
                    It is low in
                    calories, free from high fructose corn syrup, and packed with beneficial probiotics and
                    antioxidants.</p>
                <a href="{{ route('pineapple.mango') }}" class="btn w-100 rounded-4 position-relative" style="background: #41f2c0">Learn more</a>

            </div>
        </div>
    </div>

    <!-- section 4 -->
    <div class="position-relative py-3" style="background-color: #d93b75;">
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.2;">
        </div>
        <div class="mt-3 container">
            <div class="row w-100 align-items-center">
                <div class="col-lg-4 col-12 text-white">
                    <h2 class="fw-bold fs-1 mb-2">Cherry Cola Kombucha</h2>
                    <h5>ROBOT Kombucha takes the classic cola recipe to new heights by infusing it with wild
                        Honey. This unique
                        twist brings a hint of sharp sweetness and depth to every sip, making it a truly irresistible
                        and delicious
                        beverage.</h5>
                    <h2 class="my-2">Sustainable and healthy for people and planet:</h2>
                    <p>Say goodbye to the artificial additives and excessive sugars found in traditional cola drinks.
                        ROBOT Kombucha is
                        carefully crafted with premium, all-natural ingredients to provide you with a healthier
                        alternative. It is low
                        in calories, free from high fructose corn syrup, and packed with beneficial probiotics and
                        antioxidants.</p>
                    <a href="{{ route('cherry.cola') }}" class="btn w-100 rounded-4 position-relative" style="background: #f2a71b">Learn more</a>
                </div>
                <div class="col-lg-8 col-12">
                    <img src="{{ asset('/images/section-4-bottle_clean_new.png') }}" alt="" class="img-fluid section-4-img" >
                    {{-- <div class="home-comming-soon-1">
                      
                        <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon" class="">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- section 5 -->
    <div class="position-relative py-3" style="background-color: #ff7a01;">
        <div class="mt-3 container">
            <div class="row w-100 align-items-center">
                <div class="col-lg-4 col-12 order-1  justify-content-end text-white" style="text-align: right;">
                    <div>
                        <h2>The Science</h2>
                        <h4>Unlocking the Science Behind Kombucha Fermentation</h4>
                        <p>Kombucha fermentation is a fascinating process that involves the breakdown of sucrose by
                            yeast
                            cells into fructose and
                            glucose. These sugars are then metabolized into ethanol, which undergoes oxidation by acetic
                            acid bacteria (AAB) to
                            produce acetic acid. This transformation not only lowers the pH of Kombucha but also adds to
                            its
                            distinctive sour taste.</p>
                    </div>
                    <div>
                        <h2>Understanding the Role of AAB and Yeast in Kombucha Fermentation</h2>
                        <p>Studying the AAB and yeast present in the Kombucha starter culture is key to unraveling the
                            secrets of the fermentation
                            process.</p>
                        <p>By characterizing these microorganisms, we can gain valuable insights into the production of
                            metabolites, such as
                            organic acids, which are known for their potential health benefits and contribute to the
                            sensory properties of Kombucha.
                            In this review, we explore the latest advancements in isolating, enumerating, and
                            identifying AAB and yeast in Kombucha,
                            using both conventional phenotypic and modern genetic identification techniques.</p>
                        <p>
                            The aim is to shed light on the microbial diversity of this beloved beverage.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-12 order-2  d-flex flex-column align-items-center  flex-column ">
                    <img src="{{ asset('/images/section-5/bottle-1.png') }}" alt="" class="img-fluid"
                        style="transform: rotate(10deg); width: 40%; z-index: 3;">
                    <img src="{{ asset('/images/section-5/bottle-2_clean.png') }}" alt="" class="img-fluid"
                        style="transform: rotate(-10deg); width: 40%; z-index: 2;">
                    <img src="{{ asset('/images/section-5/bottle-3_clean.png') }}" alt="" class="img-fluid"
                        style="transform: rotate(10deg); width: 40%; z-index: 1;">
                </div>
                <div class="col-lg-4 col-12 order-3  text-white">
                    <h2>A Journey Through Time and Culture: The Origins of Kombucha</h2>
                    <p>Kombucha, a traditional fermented sparkling tea, has been enjoyed in China since approximately
                        220 B.C. This drink is
                        cherished for its delightful combination of slightly sweet and acidic flavors, as well as its
                        perceived health-promoting
                        properties.</p>
                    <p>Historical records indicate that Dr. Kombu introduced fermented tea to Japan around 414 A.D.,
                        where it was reputedly
                        used to alleviate digestive ailments. The name "Kombucha" itself is derived from "Dr. Kombu,"
                        while "cha" refers to tea
                        in Japanese.</p>
                    <p>From there, Kombucha made its way to Russia as "Tea Kvass," gaining popularity due to its
                        purported beneficial effects
                        on metabolic diseases, hemorrhoids, and rheumatism. During World War II, Kombucha found its way
                        to Western Europe and
                        North Africa.</p>
                    <p>Today, Kombucha production has become a global phenomenon, with commercial varieties available in
                        a range of flavors.
                        Additionally, the popularity of Kombucha has led to the creation of small-scale home-brewed
                        products, often found at
                        farmer's markets and within local communities.</p>
                    <h2>Embark on a Flavorful and Healthy Journey with Kombucha</h2>
                    <h4>Discover the fascinating science behind Kombucha fermentation, unravel the secrets of its
                        microbial diversity, and join
                        the millions around the world who enjoy this refreshing and health-promoting beverage.</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- section 6 -->
    <div class="text-white" style="background-color: #255874; min-height: 105vh;">
        <div class="container pt-5 position-relative">
            <div class="text-center">
                <h1 style="font-size: 80px; font-weight: 700; letter-spacing: -4px;">Sustainable and Ethical Choices
                </h1>
            </div>
            <div class="text-center" style="font-size: 36px; font-weight: 600">
                <p>At ROBOT Kombucha, we firmly believe in sustainability and making responsible choices.</p>
            </div>
            <div class="text-center w-75 mx-auto" style="font-size: 24px; font-weight: 400">
                <p>Our commitment to using organic ingredients ensures that you are nourishing your body while
                    supporting
                    eco-friendly farming practices. We also prioritize eco-conscious packaging, using materials that are
                    recyclable and minimizing our environmental impact.</p>
            </div>
            <div class="text-center" style="font-size: 36px; font-weight: 600">
                <p>Versatile and Convenient</p>
            </div>
            <div class="text-center w-75 mx-auto">
                <p>ROBOT Kombucha is the perfect companion for any occasion. Whether you're enjoying it on its own,
                    using it
                    as a mixer for your favorite cocktails, or incorporating it into refreshing mocktails, the
                    possibilities
                    are endless. Its portable and convenient packaging allows you to enjoy the goodness of kombucha
                    wherever
                    you go.</p>
            </div>
        </div>
        <div class="mt-5 pt-5 position-relative mx-auto">
            <div class="container  d-none d-lg-block ">
                <div class="text-center d-flex justify-content-center align-baseline ">
                    <img src="{{ asset('images/section-6/bottle-3.png') }}" alt=""
                        class="img-fluid position-absolute "
                        style="transform: rotate(-30deg); z-index: 1; width: 15%; margin-top: 50px; left: 32%">
                    <img src="{{ asset('images/section-6/bottle-2.png') }}" alt=""
                        class="img-fluid position-absolute "
                        style="transform: rotate(-15deg); z-index: 2; width: 20%; margin-top: -18px; left: 35%;">
                    <img src="{{ asset('images/section-6/bottle-1.png') }}" alt=""
                        class="img-fluid position-absolute "
                        style="transform: rotate(5deg); z-index: 3; width: 22%; margin-top: -50px; left: 40%;">
                </div>
            </div>
        </div>
    </div>
    @include('components.news-letter')
    @include('components.latest-press-pr')
    @include('components.contact-us')
@endsection
