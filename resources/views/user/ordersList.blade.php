@extends('layout.app')
@section('main_section')
<div class="position-relative text-white" style="background-color: #25355c;">
    @include('components.navbar')
</div>

<section class="h-100 gradient-custom">
    <div class="container">
        <!-- Search and Filter Section -->
        <div class="search-section mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5>All Orders</h5>
                    <p>from anytime</p>
                </div>
                <div class="d-flex">
                    {{-- <input type="text" class="form-control search-input" placeholder="Search in orders"> --}}
                    {{-- <button class="search-button">
                        <i class="fas fa-search"></i> <!-- Font Awesome icon for search -->
                    </button>
                    <button class="filter-button">
                        <i class="fas fa-filter"></i> FILTER
                    </button> --}}
                </div>
            </div>
        </div>

        <!-- Order Item List Section -->
        @foreach ($orders as $order)
        @foreach ($order->orderItems as $item)
        <div class="order-card">
            <div class="order-card-header">
                <div class="order-status-icon">
                    <i class="fa-solid fa-box"></i> <!-- Font Awesome icon for status -->
                </div>
                <div class="order-details">
                    <p class="order-status">{{ ucfirst($order->status) }}</p>
                    <p class="order-arrival">Arriving Status</p>
                </div>
            </div>

            <div class="product-info">
                <img src="{{ asset($item->product->images->first()->image_path ?? 'storage/default-image.jpg') }}"
                    alt="{{ $item->product->name }}" class="product-image">
                <div class="product-details">
                    <p class="product-name">{{ $item->product->name }}</p>
                    <p class="product-description">Capacity: {{ $item->capacity ?? 'N/A' }}</p>
                    <p class="product-description">Qty: {{ $item->quantity }}</p>
                </div>
                <div class="product-chevron">
                    <!-- Link to the myitemdetails route with item ID -->
                    <a href="{{ route('myitemdetails', ['id' => $order->id]) }}">
                        <i class="fas fa-chevron-right"></i> <!-- Font Awesome icon for arrow -->
                    </a>
                </div>
            </div>
        </div>

        @if (!$loop->last)
        <hr>
        @endif
        @endforeach
        @endforeach
    </div>
</section>

<style>
/* Search bar and Filter button styles */
.search-section {
    padding: 20px;
    background-color: #ffffff;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.search-section h5 {
    margin-bottom: 5px;
}

.search-section p {
    color: #888;
}

.search-input {
    border-radius: 20px 0 0 20px;
    border: 1px solid #ddd;
    height: 40px;
    padding-left: 15px;
    width: 300px;
}

.search-button {
    border-radius: 0 20px 20px 0;
    border: 1px solid #ddd;
    height: 40px;
    padding: 0 15px;
    background-color: #fff;
}

.filter-button {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 20px;
    height: 40px;
    padding: 0 20px;
    margin-left: 15px;
}

/* Order Card Styles */
.order-card {
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 0px 2.37% 21px 2.33%;
}

.order-card-header {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 10px 10px 0 0;
}

.order-status-icon {
    background-color: #4caf50;
    color: #fff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
}

.order-details {
    margin-left: 15px;
}

.order-status {
    font-size: 16px;
    color: #4caf50;
    margin-bottom: 0;
}

.order-arrival {
    font-size: 14px;
    color: #888;
}

/* Product Details Styles */
.product-info {
    display: flex;
    padding: 15px;
    align-items: center;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.product-image {
    width: 70px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
}

.product-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.product-description {
    font-size: 14px;
    color: #888;
}

.product-chevron {
    margin-left: auto;
    font-size: 16px;
    color: #888;
}
</style>

@include('components.news-letter')
@include('components.contact-us')

@endsection