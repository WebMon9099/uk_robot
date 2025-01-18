@extends('layout.app')
@section('main_section')

  <style>
        #main-image {
            margin-bottom: -125px;
            width: 85%;
            transform: rotate(5deg);
        }
    </style>
    <!-- body -->
    <!-- {{-- section 1 --}} -->
    <div class="position-relative text-white" style="background-color: #ad0068;">
        <div>
            @include('components.navbar')
        </div>
        <div class="container py-5 mt-5">
            <div class="row text-white align-items-center  ">
                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-4 col-12 order-lg-1 order-2">
                    <img src="{{ asset('images/page-4-section-1.png')}}" alt="" class="img-fluid" id="main-image">
                </div>
                <div class="col-lg-6 col-12 order-lg-2 order-1">
                    <h1 style="font-size: 55px;" class="fw-bold text-uppercase">CHERRY COLA</h1>
                    <h3>PRODUCT SPECIFICATION</h3>
                    <p>Introducing our Cherry Cola—a beverage crafted with care and bursting with flavor. Our
                        cola starts with the
                        finest ingredients, ensuring a drink that's not just delicious but also free from
                        synthetic additives and
                        chemicals.

                    </p>
                    <p>But what sets our Cherry Cola apart is the infusion of real cherry flavor. We've captured the
                        essence of ripe cherries,
                        adding a touch of natural sweetness and a burst of fruity freshness to every sip. It's a
                        symphony of flavors, with the
                        familiar taste of cola harmonizing perfectly with the vibrant notes of cherry.
                    </p>
                    <p>With each refreshing gulp, you'll taste the difference that real ingredients make. Gone are the
                        artificial flavors and
                        cloying sweetness of conventional colas.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="my-5 container py-5 " style="width:100vw; overflow-x:hidden;">
        <div class="row py-5">
            <div class="col-lg-5 col-12 text-center">
                <img src="{{ asset('/images/page-4-section-2.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-7 col-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h1>Product Content:</h1>
                    </div>
                    <div class="col-12 ms-4">
                        <div>
                            <h4>Ingredients:</h4>
                            <p class="w-75">Our Cherry Cola is crafted using only the finest ingredients
                                sourced from trusted suppliers. This
                                ensures a pure and natural taste that you can enjoy without any worries about synthetic
                                additives or chemicals.</p>
                        </div>
                        <div>
                            <h4>Real Cherry Flavor:</h4>
                            <p class="w-75">We've infused our cola with the authentic taste of ripe cherries, adding a
                                burst of fruity sweetness to the classic cola
                                flavor. Each sip is a delightful blend of cola's familiar taste and the refreshing
                                essence of cherries.</p>
                        </div>
                        <div>
                            <h4>Balanced Flavor Profile:</h4>
                            <p class="w-75">Our Cherry Cola strikes the perfect balance between sweetness and
                                acidity, creating a refreshing beverage that's
                                neither too sugary nor too tart. It's a drink that appeals to a wide range of taste
                                preferences.</p>
                        </div>
                        <div>
                            <h4>Versatile Serving Options:</h4>
                            <p class="w-75">Whether enjoyed on its own, mixed with your favorite spirits for a cocktail,
                                or used as a base for creative mocktails,
                                our Cherry Cola offers endless serving possibilities. It's a versatile beverage
                                that can be enjoyed in any
                                setting.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-5 rounded-3 " style="background-color: rgba(173, 216, 230, 0.677);">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Benefits</h1>
            </div>
            <div class="col-lg-7 col-12 ps-4">
                <div>
                    <h4>Natural Cherry Flavor:</h4>
                    <p class="w-75">By using real cherry flavoring, our Cherry Cola offers a more authentic and
                        enjoyable drinking experience
                        compared to artificially flavored colas. It's a taste sensation that's sure to delight your
                        taste buds.</p>
                </div>
                <div>
                    <h4>Certification:</h4>
                    <p class="w-75">Our commitment to using ingredients means that you can trust the quality and
                        purity of our product. With
                        certification, you can rest assured that our Cherry Cola meets the highest standards of
                        sustainability and
                        environmental responsibility.</p>
                </div>
                <div>
                    <h4>Unique Flavor Profile:</h4>
                    <p class="w-75">The addition of Cherry gives our cola a distinctive flavor profile that sets it apart
                        from other soft drinks on the
                        market. It's a taste sensation that's sure to leave a lasting impression on your palate.</p>
                </div>
                <div>
                    <h4>Healthier Choice:</h4>
                    <p class="w-75">By choosing our Cherry Cola, you're opting for a healthier beverage option
                        that's free from artificial additives
                        and preservatives. It's a drink that you can feel good about enjoying, knowing that it's made
                        with natural, wholesome
                        ingredients.</p>
                </div>
            </div>
            <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                <div class="position-relative d-none d-lg-block text-center text-lg-start ">
                    <img src="{{ asset('/images/page-4-section-3a.png')}}" alt="" class="img-fluid position-absolute"
                        style="z-index: 1; transform: rotate(-5deg) ; left: -30%; margin-top: -160px;">
                </div>
                <img src="{{ asset('/images/page-4-section-3b.png')}}" alt="" class="img-fluid position-relative "
                    style="z-index: 3; transform: rotate(12deg); width: 55%;">
            </div>
        </div>
    </div>
    <div class="my-5 text-center container">
        <h1 class="mb-4">Customer Satisfaction:</h1>
        <p class="w-75 mx-auto mb-3">We are committed to delivering the highest quality product that exceeds our
            customers' expectations. If for any reason
            you're not satisfied with your purchase, please reach out to us, and we'll make it right. Embrace the pure
            joy of
            flavors with our Pineapple Mango Flavored soft drink—a beverage that not only quenches your
            thirst but
            also nourishes your body and soul. Cheers to a healthier, happier lifestyle!</p>
        <p class="w-75 mx-auto">Our top priority is ensuring that every customer is delighted with their purchase. We
            stand behind the quality of our
            Pineapple Mango Flavored soft drink and are committed to exceeding your expectations. If, for any
            reason, you
            find yourself less than satisfied with your experience, please don't hesitate to reach out to us.</p>
    </div>
    <br>
    @include('components.news-letter')
@endsection
