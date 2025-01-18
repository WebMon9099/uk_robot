@extends('layout.app')
@section('main_section')
    <style>
        #main-image {
            margin-bottom: -125px;
            width: 85%;
            transform: rotate(5deg);
        }
    </style>

    <div class="position-relative text-white" style="background-color: #125259;">
        <div>
            @include('components.navbar')
        </div>
        <div class="container py-5 mt-5">
            <div class="row text-white align-items-center">
                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-4 col-12 order-lg-1 order-2 ">
                    <div class="d-lg-none text-center mt-3" style="position: relative; z-index: 10;">
                        <a href="/Product/1" class="btn px-5 rounded-5 text-white"
                            style="background-color: #F2A71B; padding: 15px 40px;">Order Now</a>
                    </div>
                    <img src="{{ asset('images/page-3-section-1.png') }}" alt="" class="img-fluid" id="main-image">
                    
                </div>
                <div class="col-lg-6 col-12 order-lg-2 order-1 ">
                    <h1 style="font-size: 53px;" class="fw-bold text-uppercase">ORGANIC HONEY COLA KOMBUCHA</h1>
                    <h3>PRODUCT SPECIFICATION</h3>
                    <p>Discover the essence of pure indulgence with our Organic Honey Cola. Crafted with care using only
                        the finest organic
                        ingredients, this drink offers a delightful blend of familiar cola Flavour infused with the
                        natural sweetness of pure
                        honey.
                    </p>
                    <p>Each sip tantalizes your taste buds with a harmonious balance of Flavours, delivering a
                        refreshing
                        and satisfying
                        experience that's unlike any other.
                    </p>
                    <p>But it's not just about taste—it's about making a conscious choice for your health and the
                        environment. With organic
                        certification and eco-friendly packaging, our Organic Honey Cola reflects our commitment to
                        sustainability and quality.</p>
                    <div class="position-relative d-none d-lg-block">
                        <a href="/Product/1" class="btn-orderx btn px-5 rounded-5"
                            style="background-color: #F2A71B; padding: 15px 40px;">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-5 container py-5 " style="width:100vw; overflow-x:hidden;">
        <div class="row py-5">
            <div class="col-lg-5 col-12 text-center">
                <img src="{{ asset('/images/page-3-section-3.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-7 col-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h1>Product Information:</h1>
                    </div>
                    <div class="col-12 ms-4">
                        <div>
                            <h4>Organic Sustainable Ingredients:</h4>
                            <p class="w-75">Organic means less emissions - less CO2 into our atmosphere, and all of us
                                at ROBOT are
                                determined to focus on a better system for us all. So our organic honey cola kombucha is
                                made from
                                only the finest organic ingredients - sourced locally. Including the high quality
                                natural organic
                                honey - harvested from our own bee hives. This ensures that we cut out GM addictive and
                                highly
                                processed refined white sugar! One of the most addictive and most destructive
                                ingredients on planet
                                earth. By using honey, we use less to achieve that delicious sweet taste - but it is a
                                natural
                                sweetness - full of antioxidants, omega 3’s and anti-inflammatory qualities. Honey has
                                so many
                                incredible health benefits - we think it is the perfect ingredient for our kombucha
                                Cola.</p>
                        </div>
                        <div>
                            <h4>Balanced Flavour Profile:</h4>
                            <p class="w-75">Our organic honey cola kombucha strikes the perfect balance between
                                sweetness and
                                acidity - creating a delicious and refreshing kombucha drink which is neither too sweet
                                nor too
                                tart. It is a hand-crafted drink which will suit a majority of tastes - and it is just
                                superb as an
                                organic mixer in mocktails and cocktails!</p>
                        </div>
                        <div>
                            <h4>Versatile Serving Options:</h4>
                            <p class="w-75">Whether enjoyed on its own, mixed with your favorite spirits for a cocktail,
                                or used as
                                a base for creative mocktails, our Organic Honey Cola offers endless serving
                                possibilities. It's a
                                versatile drink that can be enjoyed in any setting.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container p-5 rounded-3 " style="background-color: rgba(173, 216, 230, 0.677);">
        <div class="row align-items-center ">
            <div class="col-lg-7 col-12 ps-4">
                <div class="mb-3">
                    <h1>Benefits</h1>
                </div>
                <div class="ps-3">
                    <div>
                    </div>
                    <div>
                        <h4>Natural Sweetness:</h4>
                        <p class="w-75">Unlike traditional colas that rely on highly refined sugar to boost the
                            sweetness - as well
                            as artificial chemical sweeteners like aspartame, ROBOT Honey Cola Kombucha - is sweetened
                            with pure
                            organic honey. This not only enhances the flavour, but also provides a much healthier
                            alternative for
                            those who are looking to reduce their sugar intake.</p>
                    </div>
                    <div>
                        <h4>Organic Certification:</h4>
                        <p class="w-75">Organic isn’t just a label - it is the ONLY reassurance that this product is
                            without
                            chemical pesticides, without genetically modified organisms (GMO’s) our commitment to using
                            organic
                            ingredients is paramount - and we will not budge an inch on this promise. That’s why we are
                            certified
                            by the Soil Association, as well as the EU organic Standards. You can trust this
                            amazing kombucha
                            whole-heartedly, in the knowledge that every sip is healthy and certified organic. You can
                            rest assured
                            that ROBOT meets the highest standards of organic certification in the world.</p>
                    </div>
                    <div>
                        <h4>Unique Flavour Profile:</h4>
                        <p class="w-75">The addition of honey gives our cola a distinctive flavour profile that sets it
                            apart from
                            other soft drinks on the market. It's a taste sensation that's sure to leave a lasting
                            impression on
                            your palate.</p>
                    </div>
                    <div>
                        <h4>Healthier Choice:</h4>
                        <p class="w-75">By choosing our Organic Honey Cola, you're opting for a healthier drink option
                            that's free
                            from artificial additives and preservatives. It's a drink that you can feel good about
                            enjoying, knowing
                            that it's made with natural, wholesome ingredients.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="position-relative d-none d-lg-block">
                    <img src="{{ asset('/images/page-3-section-4b.png') }}" alt=""
                        class="img-fluid position-absolute "
                        style="z-index: 1; transform: rotate(-5deg) ; left: -25%; width: 90%; margin-top: -45px;">
                </div>
                <img src="{{ asset('/images/page-3-section-4a.png') }}" alt="" class="img-fluid position-relative "
                    style="z-index: 3; transform: rotate(12deg); width: 80%;">
            </div>
        </div>
    </div>
    <div class="my-5 text-center container">
        <h1 class="mb-4">Customer Satisfaction:</h1>
        <p class="w-75 mx-auto mb-3">We are committed to delivering the very highest in quality when it comes to ROBOT -
            Organic Kombuchas. We strive to exceed customer expectations with our kombucha - but if for any reason, you
            are
            not fully satisfied, we’d like to hear from you. Please, get in * contact info * and tell us about your
            experience,
            we’d love to hear from you. If for any reason you’re not 100% fully satisfied, we will make it right.
            Embrace the pure joy of our rich organic flavours, with our hand-crafted organic Kombuchas.</p>
        <p class="w-75 mx-auto">Our top priority is to ensure that every customer is delighted with their purchase. We
            stand
            by our commitment to the highest quality of all our organic kombuchas. Please be mindful of the spelling of
            FLAVOUR - I have noticed that all over the site, every word ‘flavour’ is misspelled - in the English
            Language
            spelling, there is a ‘U’ in flavour.</p>
    </div>

    <br>
    @include('components.news-letter')
@endsection
