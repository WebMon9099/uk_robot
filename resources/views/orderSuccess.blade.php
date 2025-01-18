@extends('layout.app')
<style>
    .succes-img {
        / Adjust as needed /
        height: 300px;
        / Maintain aspect ratio /
    }

    .font-size-20 {
        font-size: 20px;
        / Set font size to 20px /
    }
</style>

@section('main_section')
    <!-- {{-- section 1 --}} -->
    <div class="position-relative text-white" style="background-color: #0ba1a1;">
        <div>
            @include('components.navbar')
        </div>
    </div>

    <!-- section 2 -->
    <main id="main" class="bg-white d-flex align-items-center justify-content-center">
        <div class="text-center my-5">
            <img src="{{ asset('images/success.png') }}" alt="thankyou" class="succes-img" title="">
            <p class="mt-3 h5">Your order id is {{ $orderNumber }}</p>
            <p class="font-weight-bold h2"><strong>Thank you for your order!</strong></p>
            {{-- <p class="text-xl text-secondary font-size-20">We will email you your order details and tracking information.
            </p> --}}
            <a href="{{ route('product') }}" class="btn btn-primary rounded-pill px-4 m-3 btn-lg">
                Continue Shopping
            </a>
        </div>
    </main>
@endsection
