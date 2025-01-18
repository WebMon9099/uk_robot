@extends('layout.app')
@section('main_section')
    <div class="position-relative text-white" style="background-color: #d93b75;">
        <div>
            @include('components.navbar')
        </div>
    </div>
    <div class="position-relative py-3" style="background-color: #d93b75;">
        <div class="mt-3 container py-5">
            <div class="row w-100 align-items-center">
                <div class="col-lg-6 col-12 text-white gap-lg-0 gap-3 ">
                    <h2 class="fw-bold fs-1 mb-2">Contact Us</h2>
                    <h4>We'd love to hear from you! If you have any questions, comments or suggestions, please do not
                        hesitate to contact us.</h4>
                    <h5 class="my-2">We value your opinions and are committed to providing you with the best product
                        possible.</h5>
                        <br>
                    <p class="fs-5"><b>Address: </b><br>85 Great Portland Street, London, W1W 7LT, United Kingdom</p>
                    <p class="fs-5"><b>Email: </b><br>
                       info@robotkombucha.co.uk
                    </p>
                    <a href="https://www.netzerofoods.org" target="_blank">
                    <img src="{{ asset('images/section-8-small-img.png') }}" alt="" class="img-fluid w-25">
                </a>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="{{ route('submit.contact.form') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-4" placeholder="Name" name="name">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-4" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-4" placeholder="Phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-4" placeholder="Subject" name="subject">
                        </div>
                        <div class="mb-3">
                            <textarea type="text" class="form-control rounded-4" placeholder="Message" name="message" rows="6"></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn w-50 rounded-4" type="submit" style="background: #f2a71b">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            @include('components.news-letter')
@endsection
