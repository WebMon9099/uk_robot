@extends('layout.app')

<style>
    /* CSS for smooth transitions */
    .address-card {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .address-card.hidden {
        opacity: 0;
        transform: scale(0.95);
        pointer-events: none;
        /* Prevent interaction */
    }

    .custom-radio {
        transform: scale(1.5);
        /* Scale up the radio button */
        margin-right: 10px;
        /* Space between radio button and label */
    }

    .custom-label {
        font-size: 1.2em;
        /* Increase the font size of the label */
        cursor: pointer;
        /* Change cursor to pointer */
    }

    .fade-in {
        opacity: 0;
        /* Start invisible */
        transition: opacity 0.5s ease;
        /* Smooth transition */
    }

    .fade-in.show {
        opacity: 1;
        /* Fully visible when .show is added */
    }

    .fade-out {
        opacity: 1;
        /* Fully visible initially */
        transition: opacity 0.5s ease;
        /* Smooth transition */
    }

    .fade-out.hide {
        opacity: 0;
        /* Become invisible when .hide is added */
    }


    :root {
        --color-background: #fae3ea;
        --color-primary: rgb(11, 161, 161);
        --font-family-base: Poppin, sans-serif;
        --font-size-h1: 1.25rem;
        --font-size-h2: 1rem;
    }

    * {
        box-sizing: inherit;
    }

    html {
        box-sizing: border-box;
    }

    address {
        font-style: normal;
    }

    button {
        border: 0;
        color: inherit;
        cursor: pointer;
        font: inherit;
    }

    fieldset {
        border: 0;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: var(--font-size-h1);
        line-height: 1.2;
        margin-block: 0 1.5em;
    }

    h2 {
        font-size: var(--font-size-h2);
        line-height: 1.2;
        margin-block: 0 0.5em;
    }

    legend {
        font-weight: 600;
        margin-block-end: 0.5em;
        padding: 0;
    }

    input {
        border: 0;
        color: inherit;
        font: inherit;
    }

    input[type="radio"] {
        accent-color: var(--color-primary);
    }

    table {
        border-collapse: collapse;
        inline-size: 100%;
    }

    tbody {
        color: #b4b4b4;
    }

    td {
        padding-block: 0.125em;
    }

    tfoot {
        border-top: 1px solid #b4b4b4;
        font-weight: 600;
    }

    .align {
        display: grid;
        place-items: center;
    }

    .button {
        align-items: center;
        background-color: var(--color-primary);
        border-radius: 999em;
        color: #fff;
        display: flex;
        gap: 0.5em;
        justify-content: center;
        padding-block: 0.75em;
        padding-inline: 1em;
        transition: 0.3s;
    }

    .button:focus,
    .button:hover {
        background-color: rgb(35, 209, 96);
    }

    .button--full {
        inline-size: 100%;
    }

    .card {
        border-radius: 1em;
        background-color: var(--color-primary);
        color: #fff;
        padding: 1em;
    }

    .form {
        display: grid;
        gap: 2em;
    }

    .form__radios {
        display: grid;
        gap: 1em;
    }

    .form__radio {
        align-items: center;
        background-color: #fefdfe;
        border-radius: 1em;
        box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
        display: flex;
        padding: 1em;
    }

    .form__radio label {
        align-items: center;
        display: flex;
        flex: 1;
        gap: 1em;
    }

    .header {
        display: flex;
        justify-content: center;
        padding-block: 0.5em;
        padding-inline: 1em;
    }

    .icon {
        block-size: 1em;
        display: inline-block;
        fill: currentColor;
        inline-size: 1em;
        vertical-align: middle;
    }
</style>
@section('main_section')
<div class="position-relative text-white" style="background-color: #0ba1a1;">
    <div>
        @include('components.navbar')
    </div>
</div>
<div class="container">
  
    <div class="row justify-content-center">
        @if ($cartItems->isEmpty())
        <div class="card-body cart">
            <div class="col-sm-12 empty-cart-cls text-center m-3">
                <img src="{{ asset('images/empty-cart.svg') }}" width="180" height="180"
                    class="img-fluid mb-4 mr-3">
                    <h3><strong>Your Shopping Cart Is Empty</strong></h3>
                                <h4>Looks Like you haven't added anything to your cart yet.</h4>
                                <h5>Add something to make me happy 😊</h5>
                <a href="{{ route('home') }}" class="btn btn-danger  btn-lg rounded-pill cart-btn-transform m-3"
                    data-abc="true">Continue Shopping</a>
            </div>
        </div>
    @else
        <div class="col-8">

            <header class="header">
            </header>
            <div>
                <h2>Address</h2>
                <!-- Update Address Form (Initially Hidden) -->
                <div id="editModal" style="display: none;" class="modal-overlay">
                    <div class="modal-content card p-3">
                        <h5>
                            Update Address
                            <!-- Close Button (Cross) -->
                            <button type="button" id="close-update-address-btn"
                                class="btn btn-danger btn-sm float-end">✕</button>
                        </h5>
                        <form id="update-address-form">
                            @csrf
                            <input type="hidden" id="edit-address-id" name="address_id">

                            <div class="mb-3">
                                <label for="edit-address-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit-address-name" name="update_name"
                                    placeholder="Enter your Name">
                            </div>

                            <div class="mb-3">
                                <label for="edit-address-phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="edit-address-phone"
                                    name="update_phone_number" placeholder="Enter your Phone number">
                            </div>

                            <div class="mb-3">
                                <label for="edit-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="edit-address" name="update_address"
                                    placeholder="Enter your Address">
                            </div>

                            {{-- checking --}}

                            <div class="mb-3">
                                <label for="edit-address-pincode" class="form-label">Pin / Zip Code</label>
                                <input type="text" class="form-control" id="edit-address-pincode" name="update_pin_code"
                                    placeholder="Enter your pin code / zip code">
                            </div>

                            <div class="mb-3">
                                <label for="edit-address-state" class="form-label">State</label>
                                <input type="text" class="form-control" id="edit-address-state" name="update_state"
                                    placeholder="Enter your State name">
                            </div>

                            <div class="mb-3">
                                <label for="edit-address-city" class="form-label">City</label>
                                <input type="text" class="form-control" id="edit-address-city" name="update_city"
                                    placeholder="Enter your city">
                            </div>

                            <button type="button" id="update-address-btn" class="btn btn-success">Update
                                Address</button>
                        </form>
                    </div>
                </div>

                <!-- Existing Addresses Section -->
                @auth
                <div id="existing-addresses">
                    @if (!empty($addresses))
                    @foreach($addresses as $address)
                    <div class="card mb-3 d-flex align-items-center justify-content-between flex-row"
                        data-id="{{ $address->id }}" data-name="{{ $address->name }}" data-phone="{{ $address->phone }}"
                        data-address="{{ $address->address }}" data-pincode="{{ $address->pin_code }}"
                        data-state="{{ $address->state }}" data-city="{{ $address->city }}">
                        <div class="d-flex align-items-center m-1">
                            <input type="radio" name="selected_address" id="address-{{ $address->id }}"
                                value="{{ $address->id }}" class="custom-radio form-check-input">
                            <label for="address-{{ $address->id }}" class="mb-0 custom-label form-check-label"
                                style="margin-left: 10px;">
                                <address class="m-0">
                                    {{ $address->name }}<br />
                                    {{ $address->phone }}<br />
                                    {{ $address->address }} {{ $address->state }} {{ $address->city }} {{
                                    $address->pin_code }}
                                </address>
                            </label>
                        </div>
                        <div>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-link edit-address-btn"
                                data-address-id="{{ $address->id }}">Edit</button>
                            <!-- Delete Button -->

                            <button type="button" class="delete-address-btn"
                                data-address-id="{{ $address->id }}">Delete</button>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <div class="text-muted">No existing addresses found.</div>
                    @endif
                </div>
                @endauth

                <!--for logged out user -->
                @if (!auth()->check())
                <!-- Content for guests -->
                <div id="guestAddresses">

                </div>
                @endif

                <!-- Button to Add New Address -->
                <button type="button" id="add-new-address-btn" class="btn btn-primary">+ Add New Address</button>

                <!-- New Address Form (Initially Hidden) -->
                <form id="add-address-form" action="{{ route('user.addresses.add') }}" method="POST">
                    @csrf
                    <div id="new-address-form" style="display: none;" class="mt-3">
                        <div class="card p-3">
                            <h5>
                                Enter New Address
                                <!-- Close Button (Cross) -->
                                <button type="button" id="close-new-address-btn"
                                    class="btn btn-danger btn-sm float-end">✕</button>
                            </h5>
                            <div class="mb-3">
                                <label for="new_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="new_name" name="new_name"
                                    placeholder="Enter your Name">
                                <div id="name-error" class="text-danger" style="display: none;">Name is required.</div>
                            </div>

                            <div class="mb-3">
                                <label for="new_phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="new_phone_number" name="new_phone_number"
                                    placeholder="Enter your Phone number">
                                <div id="phone-error" class="text-danger" style="display: none;">Phone number is
                                    required.</div>
                            </div>
                            <div class="mb-3">
                                <label for="new_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="new_address" name="new_address"
                                    placeholder="Enter your Address">
                                <div id="address-error" class="text-danger" style="display: none;">Address is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_pincode" class="form-label">PIN / ZIP Code</label>
                                <input type="text" class="form-control" id="new_pincode" name="new_pincode"
                                    placeholder="Enter your Pin code / Zip code">
                                <div id="pincode-error" class="text-danger" style="display: none;">pincode is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_state" class="form-label">State </label>
                                <input type="text" class="form-control" id="new_state" name="new_state"
                                    placeholder="Enter your state name">
                                <div id="state-error" class="text-danger" style="display: none;">state is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="new_city" name="new_city"
                                    placeholder="Enter your city">
                                <div id="city-error" class="text-danger" style="display: none;">city name is required.
                                </div>
                            </div>



                            <button type="submit" id="save-new-address-btn" class="btn btn-success mt-3">Save and
                                Deliver Here</button>
                        </div>
                    </div>
                </form>
            </div>

            <fieldset>
                <legend>Payment Method</legend>

                <div class="form__radios">
                    {{-- <div class="form__radio">
                        <label for="card">Card</label>
                        <input value="card" id="card" name="payment_method" type="radio" />
                    </div>

                    <!-- Card Details (Initially Hidden) -->
                    <div id="card-details" style="display: none;" class="mt-3">
                        <h4>Card Details</h4>
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number"
                                placeholder="Enter your card number">
                        </div>
                        <!-- Expiry and CVV in one row for larger screens -->
                        <div class="card-info-row">
                            <div class="mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" id="expiry_date" name="expiry_date"
                                    placeholder="MM/YY">
                            </div>
                            <div class="mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV">
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="form__radio">
                        <label for="stripe">stripe</label>
                        <input value="stripe" id="stripe" name="payment_method" type="radio" />
                    </div> --}}

                    <div class="form__radio">
                        <label for="paypal"><svg class="icon">
                                <use xlink:href="#icon-paypal" />
                            </svg>PayPal</label>
                        <input value="paypal" id="paypal" name="payment_method" type="radio" />
                    </div>

                    {{-- <div class="form__radio">
                        <label for="cod">
                            Cash on Delivery</label>
                        <input value="cod" id="cod" name="payment_method" type="radio" />
                    </div> --}}
                </div>
            </fieldset>

            <div>
                <h2 class="mt-2">Shopping Bill</h2>

                <table>
                    <tbody>
                        <tr>
                            <td>Shipping fee</td>
                            <td align="right">$00.00</td>
                        </tr>
                        <tr>
                            <td>Discount 10%</td>
                            <td align="right">$00.00</td>
                        </tr>
                        <tr>
                            <td>Price Total</td>
                            <td align="right">${{ number_format($totalAmount, 2) }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td align="right">${{ number_format($totalAmount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div>
                    <button class="button button--full m-4" type="button" id="buy-now-btn"><svg class="icon">
                            <use xlink:href="#icon-shopping-bag" />
                        </svg>Buy Now</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none">

    <symbol id="icon-shopping-bag" viewBox="0 0 24 24">
        <path
            d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z" />
    </symbol>

    <symbol id="icon-mastercard" viewBox="0 0 504 504">
        <path
            d="m504 252c0 83.2-67.2 151.2-151.2 151.2-83.2 0-151.2-68-151.2-151.2 0-83.2 67.2-151.2 150.4-151.2 84.8 0 152 68 152 151.2z"
            fill="#ffb600" />
        <path d="m352.8 100.8c83.2 0 151.2 68 151.2 151.2 0 83.2-67.2 151.2-151.2 151.2-83.2 0-151.2-68-151.2-151.2"
            fill="#f7981d" />
        <path d="m352.8 100.8c83.2 0 151.2 68 151.2 151.2 0 83.2-67.2 151.2-151.2 151.2" fill="#ff8500" />
        <path
            d="m149.6 100.8c-82.4.8-149.6 68-149.6 151.2s67.2 151.2 151.2 151.2c39.2 0 74.4-15.2 101.6-39.2 5.6-4.8 10.4-10.4 15.2-16h-31.2c-4-4.8-8-10.4-11.2-15.2h53.6c3.2-4.8 6.4-10.4 8.8-16h-71.2c-2.4-4.8-4.8-10.4-6.4-16h83.2c4.8-15.2 8-31.2 8-48 0-11.2-1.6-21.6-3.2-32h-92.8c.8-5.6 2.4-10.4 4-16h83.2c-1.6-5.6-4-11.2-6.4-16h-70.4c2.4-5.6 5.6-10.4 8.8-16h53.6c-3.2-5.6-7.2-11.2-12-16h-29.6c4.8-5.6 9.6-10.4 15.2-15.2-26.4-24.8-62.4-39.2-101.6-39.2 0-1.6 0-1.6-.8-1.6z"
            fill="#ff5050" />
        <path
            d="m0 252c0 83.2 67.2 151.2 151.2 151.2 39.2 0 74.4-15.2 101.6-39.2 5.6-4.8 10.4-10.4 15.2-16h-31.2c-4-4.8-8-10.4-11.2-15.2h53.6c3.2-4.8 6.4-10.4 8.8-16h-71.2c-2.4-4.8-4.8-10.4-6.4-16h83.2c4.8-15.2 8-31.2 8-48 0-11.2-1.6-21.6-3.2-32h-92.8c.8-5.6 2.4-10.4 4-16h83.2c-1.6-5.6-4-11.2-6.4-16h-70.4c2.4-5.6 5.6-10.4 8.8-16h53.6c-3.2-5.6-7.2-11.2-12-16h-29.6c4.8-5.6 9.6-10.4 15.2-15.2-26.4-24.8-62.4-39.2-101.6-39.2h-.8"
            fill="#e52836" />
        <path
            d="m151.2 403.2c39.2 0 74.4-15.2 101.6-39.2 5.6-4.8 10.4-10.4 15.2-16h-31.2c-4-4.8-8-10.4-11.2-15.2h53.6c3.2-4.8 6.4-10.4 8.8-16h-71.2c-2.4-4.8-4.8-10.4-6.4-16h83.2c4.8-15.2 8-31.2 8-48 0-11.2-1.6-21.6-3.2-32h-92.8c.8-5.6 2.4-10.4 4-16h83.2c-1.6-5.6-4-11.2-6.4-16h-70.4c2.4-5.6 5.6-10.4 8.8-16h53.6c-3.2-5.6-7.2-11.2-12-16h-29.6c4.8-5.6 9.6-10.4 15.2-15.2-26.4-24.8-62.4-39.2-101.6-39.2h-.8"
            fill="#cb2026" />
        <g fill="#fff">
            <path
                d="m204.8 290.4 2.4-13.6c-.8 0-2.4.8-4 .8-5.6 0-6.4-3.2-5.6-4.8l4.8-28h8.8l2.4-15.2h-8l1.6-9.6h-16s-9.6 52.8-9.6 59.2c0 9.6 5.6 13.6 12.8 13.6 4.8 0 8.8-1.6 10.4-2.4z" />
            <path
                d="m210.4 264.8c0 22.4 15.2 28 28 28 12 0 16.8-2.4 16.8-2.4l3.2-15.2s-8.8 4-16.8 4c-17.6 0-14.4-12.8-14.4-12.8h32.8s2.4-10.4 2.4-14.4c0-10.4-5.6-23.2-23.2-23.2-16.8-1.6-28.8 16-28.8 36zm28-23.2c8.8 0 7.2 10.4 7.2 11.2h-17.6c0-.8 1.6-11.2 10.4-11.2z" />
            <path
                d="m340 290.4 3.2-17.6s-8 4-13.6 4c-11.2 0-16-8.8-16-18.4 0-19.2 9.6-29.6 20.8-29.6 8 0 14.4 4.8 14.4 4.8l2.4-16.8s-9.6-4-18.4-4c-18.4 0-36.8 16-36.8 46.4 0 20 9.6 33.6 28.8 33.6 6.4 0 15.2-2.4 15.2-2.4z" />
            <path
                d="m116.8 227.2c-11.2 0-19.2 3.2-19.2 3.2l-2.4 13.6s7.2-3.2 17.6-3.2c5.6 0 10.4.8 10.4 5.6 0 3.2-.8 4-.8 4s-4.8 0-7.2 0c-13.6 0-28.8 5.6-28.8 24 0 14.4 9.6 17.6 15.2 17.6 11.2 0 16-7.2 16.8-7.2l-.8 6.4h14.4l6.4-44c0-19.2-16-20-21.6-20zm3.2 36c0 2.4-1.6 15.2-11.2 15.2-4.8 0-6.4-4-6.4-6.4 0-4 2.4-9.6 14.4-9.6 2.4.8 3.2.8 3.2.8z" />
            <path
                d="m153.6 292c4 0 24 .8 24-20.8 0-20-19.2-16-19.2-24 0-4 3.2-5.6 8.8-5.6 2.4 0 11.2.8 11.2.8l2.4-14.4s-5.6-1.6-15.2-1.6c-12 0-24 4.8-24 20.8 0 18.4 20 16.8 20 24 0 4.8-5.6 5.6-9.6 5.6-7.2 0-14.4-2.4-14.4-2.4l-2.4 14.4c.8 1.6 4.8 3.2 18.4 3.2z" />
            <path
                d="m472.8 214.4-3.2 21.6s-6.4-8-15.2-8c-14.4 0-27.2 17.6-27.2 38.4 0 12.8 6.4 26.4 20 26.4 9.6 0 15.2-6.4 15.2-6.4l-.8 5.6h16l12-76.8zm-7.2 42.4c0 8.8-4 20-12.8 20-5.6 0-8.8-4.8-8.8-12.8 0-12.8 5.6-20.8 12.8-20.8 5.6 0 8.8 4 8.8 13.6z" />
            <path
                d="m29.6 291.2 9.6-57.6 1.6 57.6h11.2l20.8-57.6-8.8 57.6h16.8l12.8-76.8h-26.4l-16 47.2-.8-47.2h-23.2l-12.8 76.8z" />
            <path
                d="m277.6 291.2c4.8-26.4 5.6-48 16.8-44 1.6-10.4 4-14.4 5.6-18.4 0 0-.8 0-3.2 0-7.2 0-12.8 9.6-12.8 9.6l1.6-8.8h-15.2l-10.4 62.4h17.6z" />
            <path
                d="m376.8 227.2c-11.2 0-19.2 3.2-19.2 3.2l-2.4 13.6s7.2-3.2 17.6-3.2c5.6 0 10.4.8 10.4 5.6 0 3.2-.8 4-.8 4s-4.8 0-7.2 0c-13.6 0-28.8 5.6-28.8 24 0 14.4 9.6 17.6 15.2 17.6 11.2 0 16-7.2 16.8-7.2l-.8 6.4h14.4l6.4-44c.8-19.2-16-20-21.6-20zm4 36c0 2.4-1.6 15.2-11.2 15.2-4.8 0-6.4-4-6.4-6.4 0-4 2.4-9.6 14.4-9.6 2.4.8 2.4.8 3.2.8z" />
            <path
                d="m412 291.2c4.8-26.4 5.6-48 16.8-44 1.6-10.4 4-14.4 5.6-18.4 0 0-.8 0-3.2 0-7.2 0-12.8 9.6-12.8 9.6l1.6-8.8h-15.2l-10.4 62.4h17.6z" />
        </g>
        <path
            d="m180 279.2c0 9.6 5.6 13.6 12.8 13.6 5.6 0 10.4-1.6 12-2.4l2.4-13.6c-.8 0-2.4.8-4 .8-5.6 0-6.4-3.2-5.6-4.8l4.8-28h8.8l2.4-15.2h-8l1.6-9.6"
            fill="#dce5e5" />
        <path
            d="m218.4 264.8c0 22.4 7.2 28 20 28 12 0 16.8-2.4 16.8-2.4l3.2-15.2s-8.8 4-16.8 4c-17.6 0-14.4-12.8-14.4-12.8h32.8s2.4-10.4 2.4-14.4c0-10.4-5.6-23.2-23.2-23.2-16.8-1.6-20.8 16-20.8 36zm20-23.2c8.8 0 10.4 10.4 10.4 11.2h-20.8c0-.8 1.6-11.2 10.4-11.2z"
            fill="#dce5e5" />
        <path
            d="m340 290.4 3.2-17.6s-8 4-13.6 4c-11.2 0-16-8.8-16-18.4 0-19.2 9.6-29.6 20.8-29.6 8 0 14.4 4.8 14.4 4.8l2.4-16.8s-9.6-4-18.4-4c-18.4 0-28.8 16-28.8 46.4 0 20 1.6 33.6 20.8 33.6 6.4 0 15.2-2.4 15.2-2.4z"
            fill="#dce5e5" />
        <path
            d="m95.2 244.8s7.2-3.2 17.6-3.2c5.6 0 10.4.8 10.4 5.6 0 3.2-.8 4-.8 4s-4.8 0-7.2 0c-13.6 0-28.8 5.6-28.8 24 0 14.4 9.6 17.6 15.2 17.6 11.2 0 16-7.2 16.8-7.2l-.8 6.4h14.4l6.4-44c0-18.4-16-19.2-22.4-19.2m12 34.4c0 2.4-9.6 15.2-19.2 15.2-4.8 0-6.4-4-6.4-6.4 0-4 2.4-9.6 14.4-9.6 2.4.8 11.2.8 11.2.8z"
            fill="#dce5e5" />
        <path
            d="m136 290.4s4.8 1.6 18.4 1.6c4 0 24 .8 24-20.8 0-20-19.2-16-19.2-24 0-4 3.2-5.6 8.8-5.6 2.4 0 11.2.8 11.2.8l2.4-14.4s-5.6-1.6-15.2-1.6c-12 0-16 4.8-16 20.8 0 18.4 12 16.8 12 24 0 4.8-5.6 5.6-9.6 5.6"
            fill="#dce5e5" />
        <path
            d="m469.6 236s-6.4-8-15.2-8c-14.4 0-19.2 17.6-19.2 38.4 0 12.8-1.6 26.4 12 26.4 9.6 0 15.2-6.4 15.2-6.4l-.8 5.6h16l12-76.8m-20.8 41.6c0 8.8-7.2 20-16 20-5.6 0-8.8-4.8-8.8-12.8 0-12.8 5.6-20.8 12.8-20.8 5.6 0 12 4 12 13.6z"
            fill="#dce5e5" />
        <path
            d="m29.6 291.2 9.6-57.6 1.6 57.6h11.2l20.8-57.6-8.8 57.6h16.8l12.8-76.8h-20l-22.4 47.2-.8-47.2h-8.8l-27.2 76.8z"
            fill="#dce5e5" />
        <path
            d="m260.8 291.2h16.8c4.8-26.4 5.6-48 16.8-44 1.6-10.4 4-14.4 5.6-18.4 0 0-.8 0-3.2 0-7.2 0-12.8 9.6-12.8 9.6l1.6-8.8"
            fill="#dce5e5" />
        <path
            d="m355.2 244.8s7.2-3.2 17.6-3.2c5.6 0 10.4.8 10.4 5.6 0 3.2-.8 4-.8 4s-4.8 0-7.2 0c-13.6 0-28.8 5.6-28.8 24 0 14.4 9.6 17.6 15.2 17.6 11.2 0 16-7.2 16.8-7.2l-.8 6.4h14.4l6.4-44c0-18.4-16-19.2-22.4-19.2m12 34.4c0 2.4-9.6 15.2-19.2 15.2-4.8 0-6.4-4-6.4-6.4 0-4 2.4-9.6 14.4-9.6 3.2.8 11.2.8 11.2.8z"
            fill="#dce5e5" />
        <path
            d="m395.2 291.2h16.8c4.8-26.4 5.6-48 16.8-44 1.6-10.4 4-14.4 5.6-18.4 0 0-.8 0-3.2 0-7.2 0-12.8 9.6-12.8 9.6l1.6-8.8"
            fill="#dce5e5" />
    </symbol>

    <symbol id="icon-paypal" viewBox="0 0 491.2 491.2">
        <path
            d="m392.049 36.8c-22.4-25.6-64-36.8-116-36.8h-152.8c-10.4 0-20 8-21.6 18.4l-64 403.2c-1.6 8 4.8 15.2 12.8 15.2h94.4l24-150.4-.8 4.8c1.6-10.4 10.4-18.4 21.6-18.4h44.8c88 0 156.8-36 176.8-139.2.8-3.2.8-6.4 1.6-8.8-2.4-1.6-2.4-1.6 0 0 5.6-38.4 0-64-20.8-88"
            fill="#263b80" />
        <path
            d="m412.849 124.8c-.8 3.2-.8 5.6-1.6 8.8-20 103.2-88.8 139.2-176.8 139.2h-44.8c-10.4 0-20 8-21.6 18.4l-29.6 186.4c-.8 7.2 4 13.6 11.2 13.6h79.2c9.6 0 17.6-7.2 19.2-16l.8-4 15.2-94.4.8-5.6c1.6-9.6 9.6-16 19.2-16h12c76.8 0 136.8-31.2 154.4-121.6 7.2-37.6 3.2-69.6-16-91.2-6.4-7.2-13.6-12.8-21.6-17.6"
            fill="#139ad6" />
        <path
            d="m391.249 116.8c-3.2-.8-6.4-1.6-9.6-2.4s-6.4-1.6-10.4-1.6c-12-2.4-25.6-3.2-39.2-3.2h-119.2c-3.2 0-5.6.8-8 1.6-5.6 2.4-9.6 8-10.4 14.4l-25.6 160.8-.8 4.8c1.6-10.4 10.4-18.4 21.6-18.4h44.8c88 0 156.8-36 176.8-139.2.8-3.2.8-6.4 1.6-8.8-4.8-2.4-10.4-4.8-16.8-7.2-1.6 0-3.2-.8-4.8-.8"
            fill="#232c65" />
        <path d="m275.249 0h-152c-10.4 0-20 8-21.6 18.4l-36.8 230.4 246.4-246.4c-11.2-1.6-23.2-2.4-36-2.4z"
            fill="#2a4dad" />
        <path
            d="m441.649 153.6c-2.4-4-4-8-7.2-12-5.6-6.4-13.6-12-21.6-16.8-.8 3.2-.8 5.6-1.6 8.8-20 103.2-88.8 139.2-176.8 139.2h-44.8c-10.4 0-20 8-21.6 18.4l-25.6 161.6z"
            fill="#0d7dbc" />
        <path d="m50.449 436.8h94.4l23.2-145.6c0-2.4.8-4 1.6-5.6l-131.2 131.2-.8 4.8c-.8 8 4.8 15.2 12.8 15.2z"
            fill="#232c65" />
        <path d="m246.449 0h-123.2c-3.2 0-5.6.8-8 1.6l-12 12c-.8 1.6-1.6 3.2-1.6 4.8l-24 150.4z" fill="#436bc4" />
        <path d="m450.449 232.8c2.4-12 3.2-23.2 3.2-34.4l-156 156c76-.8 135.2-32 152.8-121.6z" fill="#0cb2ed" />
        <path d="m248.849 471.2 12.8-80-100 100h68c9.6 0 17.6-7.2 19.2-16z" fill="#0cb2ed" />
        <g fill="#33e2ff" opacity=".6">
            <path d="m408.049 146.4 45.6 45.6c0-5.6-1.6-11.2-2.4-16.8l-40-40c-1.6 4-2.4 7.2-3.2 11.2z" />
            <path d="m396.849 180c-1.6 3.2-3.2 6.4-4.8 9.6l55.2 55.2c.8-4 1.6-8 2.4-12z" />
            <path d="m431.249 287.2c1.6-3.2 3.2-6.4 4.8-9.6l-60.8-60.8c-2.4 2.4-4 5.6-6.4 8z" />
            <path d="m335.249 250.4 69.6 69.6 7.2-7.2-68-68c-3.2 1.6-5.6 3.2-8.8 5.6z" />
            <path d="m292.849 266.4 76 76c3.2-1.6 6.4-3.2 9.6-4.8l-74.4-74.4c-4 .8-7.2 2.4-11.2 3.2z" />
            <path d="m320.849 353.6c4-.8 8.8-.8 12.8-1.6l-80-80c-4.8 0-8.8.8-13.6.8z" />
            <path d="m196.049 272.8h-6.4c-2.4 0-4.8.8-6.4.8l86.4 87.2c2.4-2.4 5.6-4.8 8.8-5.6z" />
            <path d="m164.049 314.4 94.4 94.4 2.4-12.8-94.4-94.4z" />
            <path d="m156.049 364.8 94.4 94.4 2.4-12-94.4-94.4z" />
            <path d="m150.449 403.2-1.6 12.8 75.2 75.2h5.6c2.4 0 4.8-.8 7.2-1.6z" />
            <path d="m140.049 466.4 24.8 24.8h14.4l-36.8-36.8z" />
        </g>
    </symbol>

    <symbol id="icon-visa" viewBox="0 0 504 504">
        <path d="m184.8 324.4 25.6-144h40l-24.8 144z" fill="#3c58bf" />
        <path d="m184.8 324.4 32.8-144h32.8l-24.8 144z" fill="#293688" />
        <path
            d="m370.4 182c-8-3.2-20.8-6.4-36.8-6.4-40 0-68.8 20-68.8 48.8 0 21.6 20 32.8 36 40s20.8 12 20.8 18.4c0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 42.4 0 70.4-20 70.4-50.4 0-16.8-10.4-29.6-34.4-40-14.4-7.2-23.2-11.2-23.2-18.4 0-6.4 7.2-12.8 23.2-12.8 13.6 0 23.2 2.4 30.4 5.6l4 1.6z"
            fill="#3c58bf" />
        <path
            d="m370.4 182c-8-3.2-20.8-6.4-36.8-6.4-40 0-61.6 20-61.6 48.8 0 21.6 12.8 32.8 28.8 40s20.8 12 20.8 18.4c0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 42.4 0 70.4-20 70.4-50.4 0-16.8-10.4-29.6-34.4-40-14.4-7.2-23.2-11.2-23.2-18.4 0-6.4 7.2-12.8 23.2-12.8 13.6 0 23.2 2.4 30.4 5.6l4 1.6z"
            fill="#293688" />
        <path
            d="m439.2 180.4c-9.6 0-16.8.8-20.8 10.4l-60 133.6h43.2l8-24h51.2l4.8 24h38.4l-33.6-144zm-18.4 96c2.4-7.2 16-42.4 16-42.4s3.2-8.8 5.6-14.4l2.4 13.6s8 36 9.6 44h-33.6z"
            fill="#3c58bf" />
        <path
            d="m448.8 180.4c-9.6 0-16.8.8-20.8 10.4l-69.6 133.6h43.2l8-24h51.2l4.8 24h38.4l-33.6-144zm-28 96c3.2-8 16-42.4 16-42.4s3.2-8.8 5.6-14.4l2.4 13.6s8 36 9.6 44h-33.6z"
            fill="#293688" />
        <path d="m111.2 281.2-4-20.8c-7.2-24-30.4-50.4-56-63.2l36 128h43.2l64.8-144h-43.2z" fill="#3c58bf" />
        <path d="m111.2 281.2-4-20.8c-7.2-24-30.4-50.4-56-63.2l36 128h43.2l64.8-144h-35.2z" fill="#293688" />
        <path d="m0 180.4 7.2 1.6c51.2 12 86.4 42.4 100 78.4l-14.4-68c-2.4-9.6-9.6-12-18.4-12z" fill="#ffbc00" />
        <path d="m0 180.4c51.2 12 93.6 43.2 107.2 79.2l-13.6-56.8c-2.4-9.6-10.4-15.2-19.2-15.2z" fill="#f7981d" />
        <path d="m0 180.4c51.2 12 93.6 43.2 107.2 79.2l-9.6-31.2c-2.4-9.6-5.6-19.2-16.8-23.2z" fill="#ed7c00" />
        <g fill="#051244">
            <path d="m151.2 276.4-27.2-27.2-12.8 30.4-3.2-20c-7.2-24-30.4-50.4-56-63.2l36 128h43.2z" />
            <path d="m225.6 324.4-34.4-35.2-6.4 35.2z" />
            <path
                d="m317.6 274.8c3.2 3.2 4.8 5.6 4 8.8 0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 25.6 0 46.4-7.2 58.4-20z" />
            <path
                d="m364 324.4h37.6l8-24h51.2l4.8 24h38.4l-13.6-58.4-48-46.4 2.4 12.8s8 36 9.6 44h-33.6c3.2-8 16-42.4 16-42.4s3.2-8.8 5.6-14.4" />
        </g>
    </symbol>
</svg>
@endsection

<script>
    // main code
    document.addEventListener('DOMContentLoaded', function () {
        // orignal code 

        /* const editDefaultAddressBtn = document.getElementById('edit-default-address-btn'); */
        const closeUpdateAddressBtn = document.getElementById('close-update-address-btn');
        const updateAddressForm = document.getElementById('update-address-form');
        const updateAddressButton = document.getElementById('update-address-btn');

        const addNewAddressBtn = document.getElementById('add-new-address-btn');
        const closeNewAddressBtn = document.getElementById('close-new-address-btn');
        // const existingAddressesDiv = document.getElementById('existing-addresses');
        const newAddressForm = document.getElementById('new-address-form');
        const saveNewAddressBtn = document.getElementById('save-new-address-btn');

        const expiryDateInput = document.getElementById('expiry_date');

        const editAddressButtons = document.querySelectorAll('.edit-address-btn');

        const isLoggedIn = @json(auth() -> check());
        let maxAddresses = 2; // Maximum number of addresses for guest users
        // let addressCounter = localStorage.length;
        let allAddresses = [];

        if (!isLoggedIn) {
            guestAddressDisplayLocalAddresses(); // Show local addresses on page load
        }


        const newAddressInputs = {
            name: document.getElementById('new_name'),
            /* email: document.getElementById('new_email'), */
            phone: document.getElementById('new_phone_number'),
            address: document.getElementById('new_address'),
            pin_code: document.getElementById('new_pincode'),
            state: document.getElementById('new_state'),
            city: document.getElementById('new_city')
        };

        const cardDetails = document.getElementById('card-details');

        const buyNowbtn = document.getElementById('buy-now-btn');
        const cardInputs = {
            number: document.getElementById('card_number'),
            expiry: document.getElementById('expiry_date'),
            cvv: document.getElementById('cvv')
        };

        const openEditModal = (id, name, phone, address, pincode, state, city) => {
            // Set the address data in the modal form fields
            document.getElementById('edit-address-id').value = id;
            document.getElementById('edit-address-name').value = name;
            document.getElementById('edit-address-phone').value = phone;
            document.getElementById('edit-address').value = address;
            document.getElementById('edit-address-pincode').value = pincode;
            document.getElementById('edit-address-state').value = state;
            document.getElementById('edit-address-city').value = city;
            // Show the modal
            document.getElementById('editModal').style.display = 'block';
        };

        const submitEditForm = async (event) => {
            event.preventDefault();
            const id = document.getElementById('edit-address-id').value;
            const name = document.getElementById('edit-address-name').value;
            const phone = document.getElementById('edit-address-phone').value;
            const address = document.getElementById('edit-address').value;
            const pin_code = document.getElementById('edit-address-pincode').value;
            const state = document.getElementById('edit-address-state').value;
            const city = document.getElementById('edit-address-city').value;

            try {
                const response = await fetch(`/addresses/${id}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ name, phone, address, pin_code, state, city }),
                });
                const result = await response.json();
                if (result.success) {
                    fetchAddresses(); // Refresh addresses
                    closeEditModal(); // Close modal
                }
            } catch (error) {
                console.error('Error updating address:', error);
            }
        };

        // Attach the event listeners to each "Edit" button dynamically
        editAddressButtons.forEach(button => {
            button.addEventListener('click', function () {
                const addressCard = this.closest('.card');

                // Access the data-* attributes directly
                const addressId = addressCard.getAttribute('data-id');
                const name = addressCard.getAttribute('data-name');
                const phone = addressCard.getAttribute('data-phone');
                const address = addressCard.getAttribute('data-address');
                const pincode = addressCard.getAttribute('data-pincode');
                const state = addressCard.getAttribute('data-state');
                const city = addressCard.getAttribute('data-city');


                // Call the openEditModal function with the address details
                openEditModal(addressId, name, phone, address, pincode, state, city);
            });
        });

        if (closeUpdateAddressBtn) {
            closeUpdateAddressBtn.addEventListener('click', function () {
                document.getElementById('editModal').style.display = 'none';
            });
        }

        if (isLoggedIn && updateAddressButton) {

            updateAddressButton.addEventListener('click', function () {
                const form = updateAddressForm;

                // const form = document.getElementById('update-address-form');
                const addressId = document.getElementById('edit-address-id').value;

                const formData = new FormData(form);
                console.log(formData);


                fetch(`/addresses/${addressId}/update`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is included for security
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Address updated successfully');

                            // Optionally, hide the modal and update the address list
                            document.getElementById('editModal').style.display = 'none';

                            // Reload the page after a short delay (optional)
                            setTimeout(() => {
                                location.reload(); // Reload the page to reflect changes
                            }, 5);
                        } else {
                            toastr.error('Failed to update address');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }

        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
        const cardRadio = document.getElementById('card');

        function toggleCardDetails() {
            const isVisible = cardRadio.checked;
            cardDetails.style.display = isVisible ? 'block' : 'none';
            for (const input in cardInputs) {
                cardInputs[input].required = isVisible;
                if (!isVisible) cardInputs[input].value = ''; // Clear if not visible
            }
        }

        paymentMethodRadios.forEach(radio => radio.addEventListener('change', toggleCardDetails));
      

        if (expiryDateInput) {
            expiryDateInput.addEventListener('input', function (e) {
                let input = e.target.value;
                if (input.length === 2 && !input.includes('/')) {
                    e.target.value = input + '/';
                }
            });
        }

        // Function to handle new address input enabling/disabling
        function handleNewAddressInput(enable) {
            if (enable) {

                newAddressForm.style.display = 'block';
                newAddressForm.classList.add('animate__animated', 'animate__fadeInDown');
                newAddressInputs.name.required = true;
                newAddressInputs.phone.required = true;
                newAddressInputs.address.required = true;
                newAddressInputs.pin_code.required = true;
                newAddressInputs.state.required = true;
                newAddressInputs.city.required = true;
            } else {
                // Revert to the old address data
                // existingAddress.style.display = 'block';
                newAddressForm.style.display = 'none';

                // Enable the hidden inputs for the default address
                /*  hiddenInputs.name.disabled = false;
                 hiddenInputs.email.disabled = false;
                 hiddenInputs.phone.disabled = false;
                 hiddenInputs.address.disabled = false; */

                // Disable the new address fields
                newAddressInputs.name.required = false;
                /*  newAddressInputs.email.required = false; */
                newAddressInputs.phone.required = false;
                newAddressInputs.address.required = false;
                newAddressInputs.pin_code.required = false;
                newAddressInputs.state.required = false;
                newAddressInputs.city.required = false;


                // Clear the new address inputs
                // newAddressInputs.name.value = '';
                // newAddressInputs.email.value = '';
                // newAddressInputs.phone.value = '';
                // newAddressInputs.address.value = '';
            }
        }

        // Event listener for Add New Address button
        if (addNewAddressBtn) {
            addNewAddressBtn.addEventListener('click', function () {
                handleNewAddressInput(true);
                addNewAddressBtn.style.display = 'none';
            });
        }

        // Event listener for Close button in new address form
        if (closeNewAddressBtn) {
            closeNewAddressBtn.addEventListener('click', function () {
                handleNewAddressInput(false);
                addNewAddressBtn.style.display = 'inline-block';
            });
        }

        // Function to validate and save new address
        function validateAndSaveNewAddress() {
            const errorMessages = {
                name: document.getElementById('name-error'),
                phone: document.getElementById('phone-error'),
                address: document.getElementById('address-error'),
                pin_code: document.getElementById('pincode-error'),
                state: document.getElementById('state-error'),
                city: document.getElementById('city-error')
            };

            for (const key in errorMessages) {
                errorMessages[key].style.display = 'none'; // Clear previous messages
            }

            let hasError = false;
            for (const key in newAddressInputs) {
                if (!newAddressInputs[key].value.trim()) {
                    errorMessages[key].style.display = 'block';
                    newAddressInputs[key].focus();
                    hasError = true;
                    break;
                }
            }

            if (!hasError) {

                event.preventDefault(); // Prevent form from submitting

                const addressData = {
                    new_name: newAddressInputs.name.value,
                    new_phone_number: newAddressInputs.phone.value,
                    new_address: newAddressInputs.address.value,
                    new_pin_code: newAddressInputs.pin_code.value,
                    new_state: newAddressInputs.state.value,
                    new_city: newAddressInputs.city.value
                };

                if (isLoggedIn) {
                    // User is logged in; submit the form normally
                    const form = document.getElementById('add-address-form');
                    form.submit();
                } else {
                    // User is not logged in; save locally
                    const addresses = guestAddressGetAllLocalAddresses(); // Get all stored addresses
                    const maxAddresses = 2; // Set maximum addresses

                    if (addresses.length >= maxAddresses) {
                        toastr.error('You can not add more than 2 addresses.');
                        return;
                    } else {
                        // Save address locally
                        const newAddressKey = `localaddress${addresses.length + 1}`; // Unique key based on count
                        localStorage.setItem(newAddressKey, JSON.stringify(addressData));
                        toastr.success('Address saved locally!');
                        guestAddressDisplayLocalAddresses(); // Refresh the displayed addresses
                    }
                }

                newAddressForm.style.display = 'none'; // Optional: Hide the form
                addNewAddressBtn.style.display = 'inline-block';
                handleNewAddressInput(false);
            }
        }
        // Save new address button
        if (isLoggedIn && saveNewAddressBtn) {

            saveNewAddressBtn.addEventListener('click', validateAndSaveNewAddress);
        }

        if (!isLoggedIn) {
            guestAddressDisplayLocalAddresses(); // Show local addresses on page load
        }

        // Function to display addresses stored in localStorage for guest users
        function guestAddressDisplayLocalAddresses() {
            const guestAddressesDiv = document.getElementById('guestAddresses');
            guestAddressesDiv.innerHTML = ''; // Clear existing content

            const addresses = guestAddressGetAllLocalAddresses(); // Fetch all locally saved addresses


            if (addresses.length === 0) {
                guestAddressesDiv.innerHTML = '<div class="text-danger">No existing addresses found.</div>';
            } else {
                addresses.forEach((address, index) => {
                    const addressHTML = `
                        <div class="card mb-3 d-flex align-items-center justify-content-between flex-row"
                            data-name="${address.new_name}"
                            data-phone="${address.new_phone_number}"
                            data-address="${address.new_address}">
                            <div class="d-flex align-items-center m-1">
                                <input type="radio" name="selected_address" id="addressKey_${index}" value="localaddress${index + 1}" class="custom-radio form-check-input">
                                <label for="addressKey_${index}" class="mb-0 custom-label form-check-label" style="margin-left: 10px;">
                                    <address class="m-0">
                                        ${address.new_name}<br />
                                        ${address.new_phone_number}<br />
                                        ${address.new_address}
                                    </address>
                                </label>
                            </div>
                            <div>
                                <button type="button" class="btn btn-link guestAddressEditBtn" data-address-id="${index}">Edit</button>
                                <button type="button" class="btn btn-link guestAddressDeleteBtn" data-address-id="${index}">Delete</button>
                            </div>
                        </div>
                    `;
                    guestAddressesDiv.innerHTML += addressHTML; // Append the address to the div
                });

                // Add event listeners for delete and edit buttons
                guestAddressAddEventListeners();
            }
        }

        // Function to add event listeners to edit and delete buttons
        function guestAddressAddEventListeners() {
            const deleteButtons = document.querySelectorAll('.guestAddressDeleteBtn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const index = this.getAttribute('data-address-id');
                    guestAddressDelete(index);
                });
            });

            const editButtons = document.querySelectorAll('.guestAddressEditBtn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const index = this.getAttribute('data-address-id');
                    guestAddressEdit(index);
                });
            });
        }

        // Function to delete an address from localStorage
        function guestAddressDelete(index) {
            localStorage.removeItem(`localaddress${parseInt(index) + 1}`);
            toastr.success('Address deleted successfully!'); // Display success message
            guestAddressDisplayLocalAddresses(); // Refresh the displayed addresses
        }

        // Function to edit an address
        function guestAddressEdit(index) {
            const address = JSON.parse(localStorage.getItem(`localaddress${parseInt(index) + 1}`));

            // Prefill the edit form with the existing data
            document.getElementById('edit-address-name').value = address.new_name;
            document.getElementById('edit-address-phone').value = address.new_phone_number;
            document.getElementById('edit-address').value = address.new_address;

            // Update the address ID in the hidden input
            document.getElementById('edit-address-id').value = index;

            // Show the edit modal
            document.getElementById('editModal').style.display = 'block';
        }

        // Function to validate and save updated address
        function guestAddressValidateAndUpdate() {
            const index = document.getElementById('edit-address-id').value;
            const addressData = {
                new_name: document.getElementById('edit-address-name').value,
                new_phone_number: document.getElementById('edit-address-phone').value,
                new_address: document.getElementById('edit-address').value,

            };

            // Save the updated address back to localStorage
            localStorage.setItem(`localaddress${parseInt(index) + 1}`, JSON.stringify(addressData));
            toastr.success('Address updated successfully!');

            // Close the modal and refresh displayed addresses
            guestAddressCloseEditModal();
            guestAddressDisplayLocalAddresses();
        }

        // Close modal function
        function guestAddressCloseEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Function to get all local addresses
        function guestAddressGetAllLocalAddresses() {
            const addresses = [];
            for (let i = 1; i <= maxAddresses; i++) {
                const address = JSON.parse(localStorage.getItem(`localaddress${i}`));
                if (address) {
                    addresses.push(address);
                }
            }
            return addresses;
        }

        // Function to save a new address
        function validateAndSaveNewAddresslocal() {
            const errorMessages = {
                name: document.getElementById('name-error'),
                phone: document.getElementById('phone-error'),
                address: document.getElementById('address-error'),
                pin_code: document.getElementById('pincode-error'),
                state: document.getElementById('state-error'),
                city: document.getElementById('city-error')
            };

            for (const key in errorMessages) {
                errorMessages[key].style.display = 'none'; // Clear previous messages
            }

            let hasError = false;
            for (const key in newAddressInputs) {
                if (!newAddressInputs[key].value.trim()) {
                    errorMessages[key].style.display = 'block';
                    newAddressInputs[key].focus();
                    hasError = true;
                    break;
                }
            }
            if (!hasError) {
                event.preventDefault();

                const addressData = {
                    new_name: newAddressInputs.name.value,
                    new_phone_number: newAddressInputs.phone.value,
                    new_address: newAddressInputs.address.value,
                    new_pin_code: newAddressInputs.pin_code.value,
                    new_state: newAddressInputs.state.value,
                    new_city: newAddressInputs.city.value
                };

                // Check if any address slots are available
                for (let i = 1; i <= maxAddresses; i++) {
                    if (!localStorage.getItem(`localaddress${i}`)) {
                        localStorage.setItem(`localaddress${i}`, JSON.stringify(addressData));
                        toastr.success('Address saved successfully!');
                        newAddressForm.style.display = 'none'; // Optional: Hide the form
                        addNewAddressBtn.style.display = 'inline-block';
                        handleNewAddressInput(false);
                        guestAddressDisplayLocalAddresses(); // Refresh the displayed addresses
                        return;
                    }
                    newAddressForm.style.display = 'none'; // Optional: Hide the form
                    addNewAddressBtn.style.display = 'inline-block';
                    handleNewAddressInput(false);
                }

                // If all slots are filled, you can choose to overwrite the oldest address or inform the user
                toastr.error('You can only save 2 addresses as a guest. Please delete an existing address before adding a new one.');
            }

        }

        // Save new address button
        if (!isLoggedIn && saveNewAddressBtn) {


            saveNewAddressBtn.addEventListener('click', validateAndSaveNewAddresslocal);
        }

        // Update address button
        if (!isLoggedIn && updateAddressButton) {
            updateAddressButton.addEventListener('click', guestAddressValidateAndUpdate);
        }

        // Select all delete buttons
        if (isLoggedIn) {
            const deleteButtons = document.querySelectorAll('.delete-address-btn');
            // Add event listeners to all delete buttons
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Get the address ID from the data attribute
                    const addressId = this.getAttribute('data-address-id');

                    if (confirm('Are you sure you want to delete this address?')) {
                        // Perform the delete request using fetch
                        deleteAddress(addressId);
                    }
                });
            });

            function deleteAddress(addressId) {
                fetch(`/addresses/${addressId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token for security
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Remove the address card from the DOM
                            const addressCard = document.querySelector(`.card[data-id="${addressId}"]`);
                            if (addressCard) {
                                addressCard.remove();
                            }
                            toastr.success('Address deleted successfully');
                        } else {
                            toastr.error('Failed to delete address');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the address');
                    });
            }

        }


        if (buyNowbtn) {
            buyNowbtn.addEventListener('click', function (event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the selected address and payment method radio buttons
                const selectedAddress = document.querySelector('input[name="selected_address"]:checked');
                const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

                // Validate address selection
                if (!selectedAddress) {
                    alert('Please select an address.');
                    return; // Stop the function if no address is selected
                }

                // Validate payment method selection
                if (!selectedPaymentMethod) {
                    alert('Please select a payment method.');
                    return; // Stop the function if no payment method is selected
                }

                // Retrieve the values of selected radio buttons
                const selectedAddressValue = selectedAddress.value;
                const selectedPaymentMethodValue = selectedPaymentMethod.value;

                // Log the values (optional)
                console.log('Selected Address ID:', selectedAddressValue);
                console.log('Selected Payment Method:', selectedPaymentMethodValue);

                // Get the form element
                const checkoutForm = document.getElementById('checkout-form');

                // Create hidden input fields for the selected values
                const addressInput = document.createElement('input');
                addressInput.type = 'hidden';
                addressInput.name = 'selected_address';
                addressInput.value = selectedAddressValue;

                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.type = 'hidden';
                paymentMethodInput.name = 'payment_method';
                paymentMethodInput.value = selectedPaymentMethodValue;

                // Append hidden inputs to the form
                checkoutForm.appendChild(addressInput);
                checkoutForm.appendChild(paymentMethodInput);

                // Get additional address details from the selected address
                const selectedAddressCard = selectedAddress.closest('.card'); // Get the card element of the selected address

                const name = selectedAddressCard.getAttribute('data-name');
                const phone = selectedAddressCard.getAttribute('data-phone');
                const address = selectedAddressCard.getAttribute('data-address');
                const pinCode = selectedAddressCard.getAttribute('data-pincode');
                const state = selectedAddressCard.getAttribute('data-state');
                const city = selectedAddressCard.getAttribute('data-city');
                console.log('city',city);

                // Create hidden inputs for additional address details
                const nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = 'name'; // Ensure your backend is prepared to receive this
                nameInput.value = name;

                const phoneInput = document.createElement('input');
                phoneInput.type = 'hidden';
                phoneInput.name = 'phone_number'; // Ensure your backend is prepared to receive this
                phoneInput.value = phone;

                const addressDetailInput = document.createElement('input');
                addressDetailInput.type = 'hidden';
                addressDetailInput.name = 'address'; // Ensure your backend is prepared to receive this
                addressDetailInput.value = address;

                const pinDetailInput = document.createElement('input');
                pinDetailInput.type = 'hidden';
                pinDetailInput.name = 'pin_code'; // Ensure your backend is prepared to receive this
                pinDetailInput.value = pinCode;
                
                const stateDetailInput = document.createElement('input');
                stateDetailInput.type = 'hidden';
                stateDetailInput.name = 'state'; // Ensure your backend is prepared to receive this
                stateDetailInput.value = state;

                const cityDetailInput = document.createElement('input');
                cityDetailInput.type = 'hidden';
                cityDetailInput.name = 'city'; // Ensure your backend is prepared to receive this
                cityDetailInput.value = city;

                // Append additional address detail inputs to the form
                checkoutForm.appendChild(nameInput);
                checkoutForm.appendChild(phoneInput);
                checkoutForm.appendChild(addressDetailInput);
                checkoutForm.appendChild(pinDetailInput);
                checkoutForm.appendChild(stateDetailInput);
                checkoutForm.appendChild(cityDetailInput);


                // If payment method is "card", add card details to the form
                if (selectedPaymentMethodValue === 'card') {
                    const cardNumber = cardInputs.number.value;
                    const cardCVV = cardInputs.cvv.value;
                    const cardExpiry = cardInputs.expiry.value;

                    // Validate card details
                    if (!cardNumber || !cardCVV || !cardExpiry) {
                        alert('Please enter all the card details (card number, CVV, and expiry date).');
                        return; // Stop the function if any card detail is missing
                    }

                    // Create and append hidden inputs for card details
                    const cardNumberInput = document.createElement('input');
                    cardNumberInput.type = 'hidden';
                    cardNumberInput.name = 'card_number';
                    cardNumberInput.value = cardNumber;

                    const cardCVVInput = document.createElement('input');
                    cardCVVInput.type = 'hidden';
                    cardCVVInput.name = 'card_cvv';
                    cardCVVInput.value = cardCVV;

                    const cardExpiryInput = document.createElement('input');
                    cardExpiryInput.type = 'hidden';
                    cardExpiryInput.name = 'card_expiry';
                    cardExpiryInput.value = cardExpiry;

                    // Append the card detail inputs to the form
                    checkoutForm.appendChild(cardNumberInput);
                    checkoutForm.appendChild(cardCVVInput);
                    checkoutForm.appendChild(cardExpiryInput);
                }

                // Manually submit the form after adding the selected values
                checkoutForm.submit();
            });
        }
    });
</script>