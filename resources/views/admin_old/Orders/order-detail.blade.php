@extends('admin.layout.master')

@section('main_section')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid my-3">
                <div class="row align-items-center mb-2">
                    <div class="col-lg-6 col-sm-6">
                        <h2 class="text-dark">Order: <span class="text-primary">#{{ $order->orderNumber }}</span></h2>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-end">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </section>
        

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h1 class="h4 text-decoration-underline mb-3 ">Order Summary</h1>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-8">
                                        <h5 class="mb-3">Shipping Address</h5>
                                        <address>
                                            <strong>{{ ucfirst($order->address['name'] ?? 'N/A') }}</strong><br>
                                            {{ $order->address['address'] ?? 'Address not provided' }}<br>
                                            {{ $order->address['city'] ?? 'City not provided' }},
                                            {{ $order->address['state'] ?? 'State not provided' }},
                                            {{ $order->address['pin_code'] ?? 'Postcode not provided' }}<br>
                                            Phone: {{ $order->address['phone_number'] ?? 'N/A' }}<br>
                                            Email: {{ $order->users->email ?? 'N/A' }}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <h5 class="mb-3">Order Details</h5>
                                        <b>Order ID:</b> {{ $order->id }}<br>
                                        <b>Payment Type:</b> {{ ucfirst($order->payment_method) }}<br>
                                        <b>Payment Id:</b> {{ ucfirst($order->payment_id) }}<br>
                                        <b>Payment Status:</b> {{ ucfirst($order->payment_status) }}<br>
                                        <b>Total:</b> ${{ number_format($order->grand_total, 2) }}<br>
                                        <b>Status:</b>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="badge bg-info">Shipped</span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Product</th>
                                                <th>Pallet</th>
                                                <th width="100">Price</th>
                                                <th width="100">Qty</th>
                                                <th width="100">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->pallet }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->total, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="4" class="text-right">Subtotal:</th>
                                                <td>${{ number_format($order->sub_total, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">Discount:</th>
                                                <td>${{ number_format($order->discount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">Shipping:</th>
                                                <td>${{ number_format($order->shipping, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">Grand Total:</th>
                                                <td>${{ number_format($order->grand_total, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                     
                                @foreach ($order->orderItems as $item)
                                <div class="card">
                                    <div class="card-header pt-3">
                                <form action="{{ route('order.changeOrderSatatus', $item->id) }}"
                                      method="post" name="changeOrderStatus" id="changeOrderStatus">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card mb-4 shadow-sm">
                                                <!-- Card Header -->
                                                <div class="card-header bg-primary text-white">
                                                    <h3 class="card-title text-decoration-underline">
                                                        <i class="bi bi-box-seam me-2"></i> Product Details
                                                    </h3>
                                                </div>
                                                
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <!-- Product Name -->
                                                    <div class="row mb-3 align-items-center">
                                                        <div class="col-md-4">
                                                            <strong class="fs-5"><i class="bi bi-tag me-2"></i>Product Name:</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="h6 text-primary">{{ $item->product_name }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Pallet Of -->
                                                    <div class="row mb-3 align-items-center">
                                                        <div class="col-md-4">
                                                            <strong class="fs-5"><i class="bi bi-stack me-2"></i>Pallet Of:</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="h6 text-primary">{{ $item->pallet }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Quantity -->
                                                    <div class="row mb-3 align-items-center">
                                                        <div class="col-md-4">
                                                            <strong class="fs-5"><i class="bi bi-collection me-2"></i>Quantity:</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="h6 text-primary">{{ $item->quantity }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Price -->
                                                    <div class="row mb-3 align-items-center">
                                                        <div class="col-md-4">
                                                            <strong class="fs-5"><i class="bi bi-cash me-2"></i>Price:</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="h6 text-primary">${{ number_format($item->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Status -->
                                                    <div class="row mb-3 align-items-center">
                                                        <div class="col-md-4">
                                                            <strong class="fs-5"><i class="bi bi-tags me-2"></i>Status:</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @if ($item->status == 'pending')
                                                                <span class="badge bg-danger fs-6">Pending</span>
                                                            @elseif($item->status == 'shipped')
                                                                <span class="badge bg-info fs-6">Shipped</span>
                                                            @elseif($item->status == 'delivered')
                                                                <span class="badge bg-success fs-6">Delivered</span>
                                                            @else
                                                                <span class="badge bg-secondary fs-6">Cancelled</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
        
                                        <div class="col-md-4">
                                          <div class="card">
                                            <div class="card-header bg-primary text-white">
                                                <h3 class="card-title text-decoration-underline">
                                                    <i class="bi bi-box-seam me-2"></i> Order Status
                                                </h3>
                                            </div>
                                         
                                            <div class="card-body">
                                                <div class="card-body">

                                                   
                                                    <div class="mb-3">
                                                        <select name="order_status" id="order_status" class="form-control">
                                                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="shipped" {{ $item->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                            <option value="delivered" {{ $item->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                            <option value="cancelled" {{ $item->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Shipped Date</label>
                                                        <input type="date" name="shipped_date" id="shipped_date"
                                                               class="form-control"
                                                               value="{{ $item->shipped_date ? \Carbon\Carbon::parse($item->shipped_date)->format('Y-m-d') : '' }}"
                                                               min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                               max="{{ \Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}">
                                                    </div>
            
                                                    <div class="mb-3">
                                                        <label>Shipping Partner</label>
                                                        <input type="text" name="delivery_partner" id="delivery_partner"
                                                               class="form-control"
                                                               value="{{ $item->delivery_partner ? $item->delivery_partner : '' }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tracking Number</label>
                                                        <input type="text" name="tracking_number" id="tracking_number"
                                                               class="form-control"
                                                               value="{{ $item->tracking_number ? $item->tracking_number : '' }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                                @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
        
    </div>
@endsection

@section('customeJs')
    <script>
        $(document).ready(function() {

            const shippedDateInput = document.getElementById('shipped_date');
            const selectedDate = new Date(shippedDateInput.value);
            const today = new Date();

            // Check if the selected date is today or in the future
            if (selectedDate < today) {
                e.preventDefault(); // Prevent form submission
                alert('Please select a date today or in the future.');
            }

            $("#changeOrderStatus").submit(function(e) {
                e.preventDefault();
                if (confirm("Are you sure you want to change the status?")) {
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'post',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                alert(response.message);
                                window.location.href =
                                    "{{ route('order.order-detail', $order->id) }}";
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert(
                                'An error occurred while changing the order status. Please try again.'
                                );
                        }
                    });
                }
            });
        });
    </script>
@endsection
