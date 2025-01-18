@extends('layout.app')

@section('main_section')
<div class="position-relative text-white" style="background-color: #25355c;">
    @include('components.navbar')
</div>

<div class="container order-container">
    <!-- Order Card -->
    <div class="order-card">
        @if ($orderItems)
            <div class="row align-items-center">
                <!-- Product Image -->
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <img src="{{ asset($orderItems->product->images->first()->image_path ?? 'storage/default-image.jpg') }}"
                        alt="{{ $orderItems->product_name }}" class="product-image img-fluid rounded shadow">
                </div>

                <!-- Product Details -->
                <div class="col-md-9">
                    <h5 class="text-primary">Order Number: <span class="text-dark">{{ $order->orderNumber }}</span></h5>
                    <h4 class="product-title">{{ $orderItems->product_name }}</h4>
                    <h5 class="">Quantity: {{ $orderItems->quantity }}</h5>
                    <h5 class="">Pallet Of: {{ $orderItems->pallet }}</h5>
                    <h5 class="">Price: ${{ $orderItems->price }}</h5>
                </div>
            </div>

            <!-- Status Timeline -->
            <div class="status-timeline mt-4">
                <div class="row align-items-center mb-2">
                    <div class="col-md-9">
                        <strong>Order Status:</strong>
                    </div>
                    <div class="col-md-3 text-end">
                        @php
                            $statusClass = 'bg-secondary';
                            switch($orderItems->status) {
                                case 'cancelled':
                                    $statusClass = 'bg-danger';
                                    break;
                                case 'delivered':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'pending':
                                    $statusClass = 'bg-warning text-dark';
                                    break;
                                case 'shipped':
                                    $statusClass = 'bg-info';
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $statusClass }} text-uppercase">{{ $orderItems->status }}</span>
                    </div>
                </div>

                <div class="progress status-bar" style="height: 10px;">
                    @php
                        $progressWidth = 0;
                        switch($orderItems->status) {
                            case 'cancelled':
                                $progressWidth = 100;
                                break;
                            case 'delivered':
                                $progressWidth = 100;
                                break;
                            case 'pending':
                                $progressWidth = 20;
                                break;
                            case 'shipped':
                                $progressWidth = 70;
                                break;
                            default:
                                $progressWidth = 0;
                        }
                        $progressClass = 'bg-secondary';
                        switch($orderItems->status) {
                            case 'cancelled':
                                $progressClass = 'bg-danger';
                                break;
                            case 'delivered':
                                $progressClass = 'bg-success';
                                break;
                            case 'pending':
                                $progressClass = 'bg-warning text-dark';
                                break;
                            case 'shipped':
                                $progressClass = 'bg-info';
                                break;
                        }
                    @endphp
                    <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $progressWidth }}%;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <p class="mt-2">
                    @if ($orderItems->status === 'cancelled')
                        <strong>Order Cancelled On:</strong> {{ $orderItems->updated_at->format('d M, Y') }}
                    @else
                        <strong>Order Placed On:</strong> {{ $orderItems->created_at->format('d M, Y') }}
                    @endif
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end mt-3">
                <!-- Cancel Order Button -->
                @if ($orderItems->status !== 'cancelled' && $orderItems->status !== 'delivered')
                    <button class="btn btn-danger me-2 cancel-order-btn" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                        <i class="fas fa-times me-1"></i> Cancel Order
                    </button>
                @endif

                <!-- Download Invoice Button -->
                @if ($orderItems->status === 'delivered')
                    <a href="{{ route('download.invoice', $order->id) }}" class="btn btn-primary">
                        <i class="fas fa-file-invoice me-1"></i> Get Invoice
                    </a>
                @endif
            </div>

            <!-- Delivery Address -->
            <div class="delivery-info mt-4 p-3 rounded shadow">
                <h5 class="text-primary">Delivery Address</h5>
                <p class="mb-1"><strong>{{ $order->address['name'] ?? 'No Name Available' }}</strong></p>
                <p class="mb-1">{{ $order->address['phone_number'] ?? 'N/A' }}</p>
                <p class="mb-0">
                    {{ $order->address['address'] ?? 'No Address Available' }},
                    {{ $order->address['city'] ?? 'No City Available' }},
                    {{ $order->address['state'] ?? 'No State Available' }},
                    {{ $order->address['pin_code'] ?? 'Postcode Not Available' }}
                </p>
            </div>

            <!-- Total Price and Payment Info -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Total Item Price</h5>
                </div>
                <div class="col-md-6 text-end">
                    <h4 class="text-danger">${{ number_format($orderItems->price, 2) }}</h4>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <strong>No order item found.</strong> Please check the ID or contact support.
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Cancel Order Modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="cancelOrderModalLabel">Confirm Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Order</button>
                <button type="button" class="btn btn-danger" onclick="confirmCancelOrder({{ $orderItems->id }})">Yes, Cancel Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter and Contact Us Components -->
@include('components.news-letter')
@include('components.contact-us')

<!-- Custom Styles -->
<style>
    .order-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
    }

    .order-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .product-image {
        width: 100%;
        max-width: 150px;
        height: auto;
    }

    .product-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333333;
    }

    .status-timeline {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    .delivery-info {
        background-color: #e9ecef;
    }

    .delivery-info h5 {
        color: #0d6efd;
    }

    .total-price {
        color: #dc3545;
    }

    /* Button Enhancements */
    .btn-danger {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }

    /* Modal Enhancements */
    .modal-title.text-danger {
        font-weight: bold;
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .order-card {
            padding: 20px;
        }

        .product-title {
            font-size: 1.3rem;
        }

        .delivery-info h5 {
            font-size: 1.2rem;
        }

        .total-price {
            font-size: 1.2rem;
        }
    }
</style>

<!-- JavaScript for Cancel Order -->
<script>
    function confirmCancelOrder(orderItemId) {
        // Send an AJAX request to cancel the order
        $.ajax({
            url: '/cancel-order', // Your route for canceling the order
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Add CSRF token
                order_item_id: orderItemId
            },
            success: function(response) {
                if (response.success) {
                    // Show success message and reload the page to reflect the changes
                    toastr.success('Order has been canceled successfully.');
                    setTimeout(function() {
                        location.reload(); // Reload the page to reflect the changes
                    }, 1500); // Delay to allow the toastr message to display
                } else {
                    // Display error message returned from the server
                    toastr.error(response.message || 'Unable to cancel the order. Please try again.');
                }
            },
            error: function(xhr) {
                // Display a general error message
                var errorMessage = 'Something went wrong. Please try again.';

                // Optional: Check for validation errors or specific server errors
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message; // Use the message from the server if available
                }
                toastr.error(errorMessage);
            }
        });
    }
</script>
@endsection
