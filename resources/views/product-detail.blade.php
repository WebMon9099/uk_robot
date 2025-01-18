@extends('layout.app')
@section('main_section')
<style>
    .btn.active {
        background-color: #0ba1a1 !important; 
        color: #fff; 
        border-color: #d98e1a !important; 
    }

    .display-area {
        display: none;
        /* Hidden by default */
        border: 1px solid #324446;
        padding: 16px;
        margin-top: 20px;
        background-color: #fff;
    }

    .display-area ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .display-area li {
        padding: 8px 0;
    }

    .display-area li:hover {
        background-color: #F2A71B;
        color: #fff;
    }
</style>

    <div class="position-relative text-white" style="background-color: #0ba1a1;">
        @include('components.navbar')
    </div>

    <div class="container col-10">
        <div class="mx-auto my-3 py-5">
            <div class="row my-5">
                <div class="col-lg-4 col-12">
                    <div class="row rounded-3" style="background-color: #324446;">
                        <div class="col-12 p-5 text-center">
                            <img src="{{ asset($product->images->first()->image_path) }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 ps-4 mt-4">
                    <h4 class="" style="color: #324446;">ROBOT Kombucha</h4>
                    <h1 id="ProductName" class="fw-bold" style="color: #324446;">{{ $product->name }}</h1>
                    <div class="my-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="#f2a71b"
                                d="M12 2l2.772 7.514H22l-6.786 5.422 2.772 7.514L12 17.428l-7.986 5.022 2.772-7.514L2 9.514h6.228z" />
                        </svg>
                        (4.9 Rating)
                    </div>
                    <div class="my-2">
                        <h4 style="color: #324446;">
                            <label id="dynamicText" class="mb-3" style="font-size: 25px;"></label><br>
                            {{-- <span class="text-light-emphasis text-decoration-line-through me-2">$24.99</span>
                            <span id="productPrice">{{ $product->price }}</span> --}}
                        </h4>
                    </div>
                    <div class="button-container">
                        @if ($product && $product->variations)
                            @foreach ($product->variations as $index => $variation)
                                <button class="btn rounded-4 px-4 mb-3 me-3 variation-button"
                                    data-price="{{ $variation['price'] }}" data-name="{{ $variation['name'] }}"
                                    id="button{{ $index + 1 }}"
                                    style="border:1px solid #324446; background-color: #F2A71B;">
                                    {{ $variation['name'] }}
                                </button>
                            @endforeach
                        @else
                            <p>No variations available.</p>
                        @endif

                    </div>
                    <div class="my-2">
                        <h4 style="color: #324446;">Quantity:</h4>
                        <input type="number" id="quantityInput" value="1" min="1" max="5"
                            style="width:100px;" class="form-control">
                    </div>
                    {{-- <div class="mt-5">
                        @if ($product->status == 1)
                            <button class="btn rounded-4 px-4 me-3"
                                    style="border:1px solid #324446; background-color: #41F2C0;"
                                    id="addtocartButton">
                                <i class="fa-solid fa-cart-shopping me-1"></i>Add to cart
                            </button>
                            <div id="validationMessage" class="text-danger mt-2"></div>                      
                        @else
                            <p>Product Not Available yet</p>
                        @endif
                    </div> --}}

                    <div class="my-2">
                        <h4 style="color: #324446;">
                            <span id="priceDisplay">Select a variation</span>
                        </h4>
                    </div>
                    <p class="mt-3">{!! $product->description !!}</p>

                    <div class="mt-5">
                        @if ($product->status == 1)
                            <button class="btn rounded-4 px-4 me-3"
                                style="border:1px solid #324446; background-color: #41F2C0;" id="addtocartButton">
                                <i class="fa-solid fa-cart-shopping me-1"></i>Add to cart
                            </button>
                            <div id="validationMessage" class="text-danger mt-2"></div>
                        @else
                            <p>Product Not Available yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5" style="border-bottom: 1px solid #324446">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #324446;">
                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link text-black active" id="description-tab" data-bs-toggle="tab"
                        data-bs-target="#description" type="button" role="tab" aria-controls="description"
                        aria-selected="true">Description</button>
                </li>
                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link text-black" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                        type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
                </li>
                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link text-black" id="product-tab" data-bs-toggle="tab" data-bs-target="#product"
                        type="button" role="tab" aria-controls="product" aria-selected="false">Product</button>
                </li>
                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link text-black" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                        type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <div class="row py-3">
                        <div class="col-lg-4 col-12 mb-4 mb-lg-0 text-center">
                            <img src="{{ asset($product->images->first()->image_path) }}" alt=""
                                class="w-25 img-fluid">
                        </div>
                        <div class="col-lg-8 col-12">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    Review content goes here.
                </div>
                <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                    Product content goes here.
                </div>
                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                    <div class="row">
                        @foreach ($product->images as $image)
                            <div class="col-3">
                                <img src="{{ asset($image->image_path) }}" alt="" class="img-fluid w-25">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h1 class="text-bold">You may be interested</h1>
            <div class="mt-3">
                <div class="row mx-auto">
                    @for ($i = 1; $i <= 3; $i++)
                        @include('components.card')
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const text = "If you need to order multiple cans, pallets or boxes, please select the format and then enter the quantity.";
            const words = text.split(" ");
            const dynamicTextContainer = document.getElementById('dynamicText');
            let index = 0;

            function showLetter() {
                if (index < text.length) {
                    dynamicTextContainer.innerHTML += text[index]; // Add one letter at a time
                    index++;
                    setTimeout(showLetter, 30); // Adjust the speed here (in milliseconds)
                } 
                // else {
                //     // Repeat the text after finishing
                //     setTimeout(() => {
                //         dynamicTextContainer.innerHTML = ''; // Clear the text
                //         index = 0; // Reset index
                //         showLetter(); // Start showing again
                //     }, 2000); // Delay before repeating (in milliseconds)
                // }
            }

            showLetter();

            const buttons = document.querySelectorAll('.variation-button');
            const priceElement = document.getElementById('priceDisplay');
            const addtocartButton = document.getElementById('addtocartButton');
            const validationMessage = document.getElementById('validationMessage');
            const quantityInput = document.getElementById('quantityInput');
            let selectedName = null;
            let selectedPrice = null;

            priceElement.textContent = "Select a variation";
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedPrice = parseFloat(this.getAttribute('data-price'));
                    selectedName = this.getAttribute('data-name');
                    quantityInput.value = 1;
                    // Update displayed name and initial total price
                    // const initialTotalPrice = (parseInt(quantityInput.value) * selectedPrice)
                    //     .toFixed(2);
                    // priceElement.textContent = `${selectedName}: $${initialTotalPrice}`;
                    updatePriceDisplay();
                    // Highlight the selected button
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Update the total price display
                    updateTotalPrice();
                });
            });

            quantityInput.addEventListener('input', () => {
                updateTotalPrice(); // Update total price when quantity changes
            });

            function updateTotalPrice() {
                if (selectedPrice) {
                    const quantity = parseInt(quantityInput.value);
                    if (isNaN(quantity)) return; // Prevent NaN errors
                    const totalPrice = (quantity * selectedPrice).toFixed(2);
                    priceElement.textContent = `Great! 👍 You Selected: ${selectedName}🥤 - And Your Total Price 💵: $${totalPrice}`;
                    console.log('Total Price:', totalPrice); // Log total price for debugging
                }
            }

            function updatePriceDisplay() {
                const quantity = parseInt(quantityInput.value) || 0; // Default to 0 if empty
                const initialTotalPrice = (quantity * selectedPrice).toFixed(2);
                priceElement.textContent = `Selected: ${selectedName} - Price: $${initialTotalPrice}`;
            }

            // addtocartButton.addEventListener('click', () => {
            //     if (!selectedPrice) {
            //         validationMessage.textContent = 'Please select a variation.';
            //     } else {
            //         validationMessage.textContent = '';

            //         const product = @json($product);
            //         // const userId = {{ auth()->check() ? auth()->user()->id : 'null' }};

            //         // if (userId === null) {
            //         //     console.error('User is not logged in');
            //         //     toastr.error('User is not logged in');
            //         //     return;
            //         // }

            //         const quantity = parseInt(quantityInput.value); // Get quantity as an integer
            //         const totalPrice = (quantity * selectedPrice).toFixed(2); // Get selected total price
            //         const formData = new FormData();
            //         formData.append('user_id', userId);
            //         formData.append('product_id', product.id);
            //         formData.append('can_type', selectedName);
            //         formData.append('quantity', quantity);
            //         formData.append('price', selectedPrice);
            //         formData.append('total_price', totalPrice);
            //         formData.append('_token', document.querySelector('meta[name="csrf-token"]')
            //             .getAttribute('content'));

            //         fetch('/cart', {
            //                 method: 'POST',
            //                 body: formData
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.success) {
            //                     toastr.success(data.message);
            //                 } else {
            //                     toastr.error(data.message);
            //                 }
            //             })
            //             .catch(error => {
            //                 console.error('Error:', error);
            //                 toastr.error('Something went wrong.');
            //             });
            //     }
            // });
            addtocartButton.addEventListener('click', () => {
                if (!selectedPrice) {
                    validationMessage.textContent = 'Please select a variation.';
                } else {
                    validationMessage.textContent = '';

                    const product = @json($product);
                    const quantity = parseInt(quantityInput.value); // Get quantity as an integer
                    const totalPrice = (quantity * selectedPrice).toFixed(2); // Get selected total price
                    const formData = new FormData();

                    // Check if the user is logged in
                    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
                    if (!isLoggedIn) {
                        // If the user is not logged in, store cart data in the session
                        const cartData = {
                            product_id: product.id,
                            can_type: selectedName,
                            quantity: quantity,
                            price: selectedPrice,
                            total_price: totalPrice,
                        };
                        fetch('/cart/session', { // Adjust this route to handle session-based cart
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify(cartData),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    toastr.success('😀'+ data.message);
                                    updateCartCount();
                                } else {
                                    toastr.error('😟'+ data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                toastr.error('Something went wrong 😔.');
                            });
                    } else {
                        // If logged in, store cart data in the database
                        const userId = {{ auth()->check() ? auth()->user()->id : 'null' }};
                        formData.append('user_id', userId); // Add the user ID only if logged in
                        formData.append('product_id', product.id);
                        formData.append('can_type', selectedName);
                        formData.append('quantity', quantity);
                        formData.append('price', selectedPrice);
                        formData.append('total_price', totalPrice);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'));

                        fetch('/cart', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    toastr.success('😀'+ data.message);
                                    updateCartCount();
                                } else {
                                    toastr.error('😟'+ data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                toastr.error('Something went wrong 😔.');
                            });
                    }
                }
            });


        });
    </script>
@endsection
