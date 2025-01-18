@extends('layout.app')

@section('main_section')
    <!-- {{-- section 1 --}} -->
    <div class="position-relative text-white" style="background-color: #0ba1a1;">
        <div>
            @include('components.navbar')
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-lg-6 order-2 order-2 order-lg-1 ">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                <div class="mt-5">
                    <h2 class="mb-2">Shopping Details</h2>
                    <div class="mt-3">
                        <form action="{{ route('post.order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="price" id="price">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your Name">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Enter your Email">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">phone Number</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        placeholder="Enter your Phonenumber">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <textarea name="address" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="mb-3">Payment Details</h2>
                </div>
                <div class="mb-5">
                    <h3 class="mb-2">Card Details</h3>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="card_number" class="form-label text-uppercase">Card Number</label>
                            <input id="card_number" type="text" name="card_number" class="form-control rounded-3"
                                placeholder="Enter Card Number" pattern="\d{4} \d{4} \d{4} \d{4}"
                                title="Please enter a valid card number 9999 9999 9999 9999">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="cvs" class="form-label text-uppercase">CVS</label>
                            <input id="cvs" type="text" name="cvs" class="form-control rounded-3"
                                pattern="\d{3}" title="Please enter a valid CVS">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="expiry_date" class="form-label text-uppercase ">Card Expiry date</label>
                            <input id="expiry_date" name="expiry_date" type="text" class="form-control rounded-3"
                                pattern="\d{2}/\d{4}" title="Please enter a valid expiry date (MM/YYYY)">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <button class="btn w-100 rounded-4 text-white" type="submit" style="background-color: #F2A71B;">PAY
                            NOW</button>
                    </div>
                </div>

                </form>
            </div>

            <div class="col-lg-6 order-1 order-1 order-lg-2 bg-light">
                <div class="my-5 px-5">
                    <h2>Your Order</h2>
                    <hr>
                    <div class="row align-items-center mb-3">
                        <div class="col-6 d-flex justify-content-between gap-3">
                            <div class="w-50 p-1 rounded-3 h-50"
                                style="background: linear-gradient(135deg, #13C5C5 0%, #324446 100%);">
                                <img src="{{ asset($product->images->first()->image_path) }}" alt=""
                                    class="img-fluid w-100">
                            </div>
                            <h4>{{ $product->name }}</h4>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <input type="number" class="form-control quantity" value="1" style="width: 35%;">
                                <h4 class="mt-1">
                                    <span class="price" data-price="{{ $product->price }}"></span>
                                    <span class="total-price">Total: {{ $product->price }} </span>
                                </h4>
                            </div>

                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.quantity').change(function(e) {
                e.preventDefault();
                var quantity = $(this).val();
                var price = $(this).closest('.row').find('.price').data('price');
                var total = quantity * parseFloat(price);
                $(this).closest('.row').find('.total-price').text(total.toFixed(2));
                $('#price').val(total.toFixed(2)); // Set the value of the hidden input field to the total price
            });
        });
    </script>
@endsection
