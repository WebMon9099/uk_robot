@extends('layout.app')

{{-- @section('main_section')
<div class="position-relative text-white" style="background-color: #0ba1a1;">
    <div>
        @include('components.navbar')
    </div>
</div>

<section class="shopping-cart dark">
    <div class="container">
        <div class="block-heading">
            <h2>Shopping Cart</h2>
        </div>
        <div class="content">
            <div class="row">
                @if ($cartItems->isEmpty())
                <p>Your cart is empty.</p>
                @else
                <div class="col-md-12 col-lg-8">
                    <div class="items">
                        @foreach ($cartItems as $item)
                        <div class="product">
                            <div class="row">
                                <div class="col-md-3 d-flex justify-content-center">
                                    <img src="{{ $item->product->images->isNotEmpty() ? asset($item->product->images->first()->image_path) : asset('path/to/default-image.jpg') }}"
                                        alt="{{ $item->product->name }}" class="w-50 img-fluid">
                                </div>
                                <div class="col-md-9">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-md-8 product-name">
                                                <a href="#">{{ $item->product->name }}</a>
                                                <div class="product-info">
                                                    <div>Pack Of: <span class="value">{{ $item->quantity }} Cans</span>
                                                    </div>
                                                    <div>Price: <span class="value">{{ $item->product->price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 quantity">
                                                <label for="quantity-{{ $item->id }}">Quantity:</label>
                                                <input id="quantity-{{ $item->id }}" type="number"
                                                    value="{{ $item->quantity }}" class="form-control quantity-input"
                                                    data-id="{{ $item->id }}" data-price="{{ $item->product->price }}"
                                                    min="1" max="30">
                                            </div>
                                            <div class="col-md-12 price">
                                                <p id="total-price-{{ $item->id }}">
                                                    ${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="summary">
                        <h3>Summary</h3>
                        @php
                        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
                        $discount = 0;
                        $shipping = 0;
                        $total = $subtotal - $discount + $shipping;
                        @endphp
                        <div class="summary-item"><span class="text">Subtotal</span><span class="price"
                                id="subtotal">${{ number_format($subtotal, 2) }}</span></div>
                        <div class="summary-item"><span class="text">Discount</span><span class="price"
                                id="discount">${{ number_format($discount, 2) }}</span></div>
                        <div class="summary-item"><span class="text">Shipping</span><span class="price"
                                id="shipping">${{ number_format($shipping, 2) }}</span></div>
                        <div class="summary-item"><span class="text">Total</span><span class="price" id="total">${{
                                number_format($total, 2) }}</span></div>
                        <button type="button" class="btn btn-primary btn-lg btn-block">Checkout</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection --}}

@section('main_section')
    <div class="position-relative text-white" style="background-color: #0ba1a1;">
        <div>
            @include('components.navbar')
        </div>
    </div>
    <section class="" style="background-color: {{ $cartItems->isEmpty() ? 'white' : '#0ba1a1' }};">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                @if ($cartItems->isEmpty())
                    <div class="card-body cart">
                        <div class="col-sm-12 empty-cart-cls text-center">
                            <img src="{{ asset('images/empty-cart.svg') }}" width="130" height="130"
                                class="img-fluid mb-4 mr-3">
                                <h3><strong>Your Shopping Cart Is Empty</strong></h3>
                                <h4>Looks Like you haven't added anything to your cart yet.</h4>
                                <h5>Add something to make me happy 😊</h5>
                                <a href="{{ route('home') }}" class="btn btn-danger  btn-lg rounded-pill cart-btn-transform m-3"
                                data-abc="true">Continue Shopping</a>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="card card-registration card-registration-2 shadow-lg border border-dark"
                            style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0">Shopping Cart</h1>
                                            </div>
                                            <hr class="my-4">

                                            <!-- Cart Items Section -->
                                            @foreach ($cartItems as $item)
                                                <div class="row mb-4 d-flex align-items-center">
                                                    <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                                        @if (!empty($item['product']) && isset($item['product']['id']))
                                                            <img src="{{ !empty($item['product']['images']) ? asset($item['product']['images'][0]['image_path']) : asset('path/to/default-image.jpg') }}"
                                                                alt="{{ $item['product']['name'] }}"
                                                                class="w-100 img-fluid rounded cart-item-image">
                                                        @else
                                                            <p>Product not available</p>
                                                        @endif
                                                    </div>

                                                    <div class="col-4 col-md-4 col-lg-4 col-xl-3">
                                                        @if (isset($item['product']['id']))
                                                            <h6 class="text-muted product-heading">
                                                                <a href="{{ url('Product/' . $item['product']['id']) }}"
                                                                    class="text-decoration-none">
                                                                    {{ $item['product']['name'] }}
                                                                </a>
                                                            </h6>
                                                        @else
                                                            <h6>Product details missing</h6>
                                                        @endif

                                                        <h6 class="fw-bold product-heading">Pack:
                                                            <span>{{ $item['can_type'] }}</span></h6>
                                                        <h6 class="fw-bold product-heading">Quantity:
                                                            <span>{{ $item['quantity'] }}</span></h6>
                                                    </div>

                                                    <div class="col-3 col-md-3 col-lg-3 col-xl-3 offset-lg-1">
                                                        @php
                                                            $variations = is_string($item['product']['variations'])
                                                                ? json_decode($item['product']['variations'], true)
                                                                : $item['product']['variations'];
                                                            $variationPrice = 0;

                                                            if (is_array($variations)) {
                                                                foreach ($variations as $variation) {
                                                                    if (
                                                                        isset($variation['name']) &&
                                                                        trim($variation['name']) ===
                                                                            trim($item['can_type'])
                                                                    ) {
                                                                        $variationPrice = (float) $variation['price'];
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        @endphp

                                                        <h6 class="fw-bold">Price per pack: <span
                                                                class="text-muted">${{ number_format($variationPrice, 2) }}</span>
                                                        </h6>
                                                    </div>

                                                    <div class="col-3 col-md-2 col-lg-2 col-xl-2 text-end">
                                                        @if (isset($item['id']))
                                                            <p id="total-price-{{ $item['id'] }}" class="fw-bold">
                                                                ${{ number_format($variationPrice * (int) $item['quantity'], 2) }}
                                                            </p>

                                                            <!-- Delete Item Button -->
                                                            <form
                                                                action="{{ route('cart.destroy', ['id' => $item['id'], 'can_type' => $item['can_type']]) }}"
                                                                method="POST" class="delete-cart-item-form d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0 text-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <p>Item details missing</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- End Cart Items Section -->

                                            <hr class="my-4">

                                            <div class="pt-5">
                                                <h6 class="mb-0">
                                                    <a href="{{ route('product') }}" class="text-body"><i
                                                            class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 ">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                            <hr class="my-4">
                                            @php
                                                $subtotal = 0;
                                                foreach ($cartItems as $item) {
                                                    $variations = is_string($item['product']['variations'])
                                                        ? json_decode($item['product']['variations'], true)
                                                        : $item['product']['variations'];
                                                    $variationPrice = 0;

                                                    if (is_array($variations)) {
                                                        foreach ($variations as $variation) {
                                                            if (
                                                                isset($variation['name']) &&
                                                                trim($variation['name']) === trim($item['can_type'])
                                                            ) {
                                                                $variationPrice = (float) $variation['price'];
                                                                break;
                                                            }
                                                        }
                                                    }

                                                    $subtotal += $variationPrice * (int) $item['quantity'];
                                                }

                                                $discount = 0;
                                                $shipping = 0;
                                                $total = $subtotal - $discount + $shipping;
                                            @endphp

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase">Subtotal</h5>
                                                <h5 class="price" id="subtotal">${{ number_format($subtotal, 2) }}</h5>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase">Discount</h5>
                                                <h5 class="price" id="discount">${{ number_format($discount, 2) }}</h5>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase">Shipping</h5>
                                                <h5 class="price" id="shipping">${{ number_format($shipping, 2) }}</h5>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase">Total</h5>
                                                <h5 class="price" id="total">${{ number_format($total, 2) }}</h5>
                                            </div>

                                            <hr class="my-4">
                                            <form action="{{ route('checkout') }}" method="GET">
                                                <button type="submit"
                                                    class="btn btn-dark btn-lg btn-block">Checkout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('customCss')
    <style>
        .cart-item-image {
            width: 100%;
            height: auto;
        }


        @media (max-width: 576px) {
            .cart-item-image {
                width: 80%;
                height: auto;
                max-height: 100px;
            }

            .product-heading {
                font-size: 14px;
                margin-bottom: .25rem !important;
            }
        }
    </style>
@endsection
@section('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const updateCart = (itemId, newQuantity) => {
                const totalPriceElement = document.querySelector(`#total-price-${itemId}`);
                const pricePerItem = parseFloat(document.querySelector(`input[data-id="${itemId}"]`)
                    .getAttribute('data-price'));

                const newPrice = pricePerItem * newQuantity;
                totalPriceElement.textContent = `$${newPrice.toFixed(2)}`;

                // Calculate subtotal
                let subtotal = 0;
                document.querySelectorAll('.product').forEach(product => {
                    const priceText = product.querySelector('.price').textContent.replace('$', '')
                        .replace(',', '');
                    const itemTotal = parseFloat(priceText);
                    subtotal += itemTotal;
                });

                const discount = parseFloat(document.querySelector('#discount').textContent.replace('$', '')
                    .replace(',', '')) || 0;
                const shipping = parseFloat(document.querySelector('#shipping').textContent.replace('$', '')
                    .replace(',', '')) || 0;

                const total = subtotal - discount + shipping;
                document.querySelector('#subtotal').textContent = `$${subtotal.toFixed(2)}`;
                document.querySelector('#total').textContent = `$${total.toFixed(2)}`;
            };

            // Event listener for quantity change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', event => {
                    const itemId = event.target.getAttribute('data-id');
                    const newQuantity = parseInt(event.target.value, 10);

                    if (isNaN(newQuantity) || newQuantity < 1) {
                        event.target.value = 1;
                        return;
                    }

                    updateCart(itemId, newQuantity);
                });
            });
        });
    </script>
@endsection