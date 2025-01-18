@extends('layout.app')
@section('main_section')
    <style>
        #main-image {
            margin-bottom: -125px;
            width: 85%;
            transform: rotate(5deg);
        }
    </style>
   
    <div class="position-relative text-white" style="background-color: #F2A71B;">
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
        </div>
        <div class="position-relative" style="z-index:4;">
            @include('components.navbar')
        </div>
        <div class="container py-5 mt-5" style="z-index: 5">
            <div class="row text-white align-items-center">
                <div class="col-lg-6 col-12">
               <h1 style="font-size: 55px;" class="fw-bold text-uppercase">Introducing ROBOT Kombucha: A Journey Through History & Science</h1>
                    <p class="fs-5">Discover the fascinating world of ROBOT Kombucha, a traditional fermented sparkling
                        tea
                        drink with a
                        unique blend of flavors. Delve into the rich history and scientific process behind this exceptional
                        beverage.
                    </p>
                    <p class="fs-5">But what sets our Cherry Cola apart is the infusion of real cherry flavor. We've
                        captured the
                        essence of ripe cherries,
                        adding a touch of natural sweetness and a burst of fruity freshness to every sip. It's a
                        symphony of flavors, with the
                        familiar taste of cola harmonizing perfectly with the vibrant notes of cherry.
                    </p>
                    <p class="fs-5">With each refreshing gulp, you'll taste the difference that real ingredients make.
                        Gone are the
                        artificial flavors and
                        cloying sweetness of conventional colas.</p>
                </div>
                <div class="col-lg-6 col-12">
                    <img src="{{ asset('images/section-1-image.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 overflow-x-hidden">
        <div class="py-5 position-relative" style="background-color: #D93B75">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
            </div>
            <div class="container">
                <div class="row text-white align-items-center">
                    <div class="col-lg-12 col-12 mb-5">
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <h1 class="fw-bold ">History of Kombucha</h1>
                            </div>
                            <div class="col-lg-12 col-12 ms-4 row mt-3">
                                <div class="col-lg-7 col-12">
                                    <p class="fs-5" style=" line-height: 1.5;">Since its inception in China around 220
                                        B.C.,
                                        Kombucha has captivated the
                                        taste buds of tea enthusiasts. Its slightly sweet and acidic flavor profile offers a
                                        refreshing sensory experience. But Kombucha is more than just a delicious drink—it
                                        is
                                        renowned for its perceived health-promoting properties.</p>
                                    <p class="fs-5" style=" line-height: 1.5;">Legend has it that Dr. Kombu introduced
                                        fermented
                                        tea to Japan in 414 A.D.,
                                        where it was cherished for its digestive benefits. The name "Kombucha" itself
                                        derives
                                        from
                                        the combination of "Dr. Kombu" and the Japanese word for tea, "cha."</p>
                                          <p class="fs-5" style=" line-height: 1.5;">From Japan, Kombucha made its way to Russia
                                        as
                                        "Tea
                                        Kvass," eventually spreading to Eastern Europe in the 20th century. In Russia, it
                                        gained
                                        popularity for its potential to alleviate metabolic diseases, haemorrhoids, and
                                        rheumatism.
                                    </p>
                                    <p class="fs-5" style=" line-height: 1.5;">During World War II, Kombucha found its way
                                        to
                                        Western Europe and North Africa, marking the beginning of its global presence.
                                        Today,
                                        Kombucha is sold commercially in various flavors, while small-scale home-brewed
                                        versions
                                        can
                                        be found in local markets and communities.</p>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <img src="{{ asset('images/science/science-1.jpeg') }}" alt=""
                                        class="img-fluid w-75">
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="py-5 position-relative" style="background-color: #ff7b01">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-12 mb-3">
                        <div class="row text-white">
                            <div class="col-12 mb-3">
                                <h1 class="fw-bold ">Science of Kombucha</h1>
                            </div>
                            <div class="col-12 ms-4 row mt-3">
                                <div class="col-lg-7 col-12">
                                    <p class="fs-5" style=" line-height: 1.5;">ROBOT Kombucha takes the science of
                                        Kombucha to new
                                        heights. Our unique recipe involves fermenting organic black tea, natural sugar, and
                                        a
                                        "SCOBY" (Symbiotic Culture Of Bacteria and Yeast). With careful attention to detail,
                                        we
                                        create the perfect conditions for fermentation, using small glass jars to assist the
                                        process. As the bacteria and yeast feed on the sugar, Kombucha transforms into a
                                        tangy,
                                        slightly fizzy elixir teeming with millions of pro-biotic organisms. It's a natural
                                        and
                                        healthy drink that supports gut health.</p>
                                    <p class="fs-5" style=" line-height: 1.5;">The fermentation process of ROBOT Kombucha
                                        involves
                                        the hydrolysis of sucrose into fructose and glucose by yeast cells. These sugars are
                                        then
                                        metabolized into ethanol. Acetic acid bacteria (AA😎 further oxidize the ethanol,
                                        resulting
                                        in the production of a natural acetic acid. This not only contributes to the sour
                                        taste of
                                        Kombucha but also plays a role in reducing the pH of the drink.</p>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <img src="{{ asset('images/science/science-3.jpeg') }}" alt=""
                                        class="img-fluid w-75">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 mb-3">
                        <div class="row text-white">
                            <div class="col-12 ms-4 row mt-3">
                                <div class="col-lg-4 col-12 ">
                                    <img src="{{ asset('images/science/science-4.jpeg') }}" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="col-lg-8 col-12 ">
                                    <p class="fs-5" style=" line-height: 1.5;">From Japan, Kombucha made its way to Russia
                                        as "Tea
                                        Kvass," eventually spreading to Eastern Europe in the 20th century. In Russia, it
                                        gained
                                        popularity for its potential to alleviate metabolic diseases, haemorrhoids, and
                                        rheumatism.
                                    </p>
                                    <p class="fs-5" style=" line-height: 1.5;">During World War II, Kombucha found its way
                                        to
                                        Western Europe and North Africa, marking the beginning of its global presence.
                                        Today,
                                        Kombucha is sold commercially in various flavors, while small-scale home-brewed
                                        versions can
                                        be found in local markets and communities.</p>
                                    <p class="fs-5">Understanding the microbial diversity in Kombucha is key to producing
                                        high-quality products with potential health benefits. The characterization of AAB
                                        and yeast
                                        in the Kombucha starter culture provides valuable insights into the fermentation
                                        process.
                                        Through advanced genetic identification techniques, we gain a better understanding
                                        of the
                                        microorganisms involved in producing organic acids and other metabolites associated
                                        with
                                        health benefits and sensory properties.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" py-5 position-relative" style="background-color: #125259">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-12 mb-5">
                        <div class="row text-white">
                            <div class="col-lg-12 col-12 mb-3">
                                <h1 class="fw-bold ">Benefits of ROBOT Kombucha</h1>
                            </div>
                            <div class="col-lg-12 col-12 ms-4 row mt-3 align-items-center">
                                <div class="col-lg-7 col-12">
                                    <p class="fs-5" style=" line-height: 1.5;">ROBOT Kombucha brings back this ancient
                                        recipe as a
                                        response to the detrimental effects of industrialized processes and highly processed
                                        foods
                                        on our gut microbiome. Our commitment to all-natural, organic, and pro-biotic
                                        ingredients
                                        sets us apart. Every batch of ROBOT Kombucha is hand-made, crafted, and tested at
                                        every
                                        stage to ensure the highest quality. It's a labor of love that comes with a little
                                        extra
                                        cost, but the benefits are worth it.</p>
                                    <p class="fs-5" style=" line-height: 1.5;">In contrast to the synthetic additives used
                                        in
                                        Coca~Cola, like phosphoric acids, ROBOT Kombucha relies on nature's own balance of
                                        ingredients. Phosphoric acid, commonly found in carbonated drinks, serves as a
                                        preservative
                                        and flavor additive but is highly corrosive and harmful to our gut health. ROBOT
                                        Kombucha
                                        achieves its natural tartness and tanginess through the development of a pro-biotic
                                        "Scoby,"
                                        composed of a natural bacterial culture. This culture consumes sugar, resulting in a
                                        fully
                                        organic and healthy flavor profile.</p>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <img src="{{ asset('images/page-2-section-2.png') }}" alt=""
                                        class="img-fluid w-75">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 mb-5">
                        <div class="row text-white">
                            <div class="col-12 ms-4 row mt-3 align-items-center">
                                <div class="col-lg-4 col-12 d-flex align-items-end ">
                                    <img src="{{ asset('images/page-4-section-2.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="col-lg-8 col-12">
                                    <p class="fs-5" style=" line-height: 1.5;">While cheap soft drink brands resort to
                                        phosphoric
                                        acid, ROBOT Kombucha embraces the power of nature. Our commitment to organic
                                        ingredients
                                        means no chemical pesticides, no genetically modified organisms, and absolutely
                                        nothing fake
                                        or chemical. We prioritize your well-being and the health of our planet.
                                    </p>
                                    <p class="fs-5" style=" line-height: 1.5;">In addition to its unique taste, ROBOT
                                        Kombucha
                                        contains antioxidants that help prevent cell damage. The organic tea used in our
                                        brewing
                                        process contributes to the presence of polyphenols and flavonoids, two types of
                                        antioxidants. Furthermore, we enhance the antioxidant levels in ROBOT Kombucha by
                                        incorporating organic wild honey, a distinct feature that sets us apart.</p>
                                    <p class="fs-5" style=" line-height: 1.5;">We take pride in creating this premium
                                        pro-biotic
                                        kombucha drink, ensuring its sustainability and health benefits for both individuals
                                        and the
                                        environment. ROBOT Kombucha is not just a beverage; it's a conscious choice for a
                                        better
                                        future.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: lightblue">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
            </div>
            <div class="col-9 mx-auto text-center ">
                <p class="fs-5 my-3">Welcome to ROBOT ~ Organic Honey Cola Kombucha, the most sustainable drink in the
                    world.
                    Experience the harmony of taste, science, and nature in every sip.</p>
            </div>
        </div>
    </div>
@endsection
