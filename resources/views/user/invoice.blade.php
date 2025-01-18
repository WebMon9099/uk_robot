<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2,
    h3 {
        color: #333;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-header h1 {
        margin: 0;
    }

    .invoice-details {
        margin-bottom: 20px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .invoice-details p {
        margin: 5px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    .total {
        font-weight: bold;
        font-size: 1.2em;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Invoice #: {{ $order->id }}</p>
        </div>

        <div class="invoice-details">
            <h2>Order Details</h2>
            <p><strong>Order Number:</strong> {{ $order->orderNumber }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        </div>

        <div class="invoice-details">
            <h2>Billing Information</h2>
            <p><strong>Name:</strong> {{ $order->address['name'] ?? 'No Name Available' }}</p>
            <p><strong>Phone:</strong> {{ $order->address['phone_number'] ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->users->email ?? 'No Email' }}</p>
            <p><strong>Address:</strong>
                {{ $order->address['address'] ?? 'No Address Available' }},{{ $order->address['city'] ?? 'No city availabe' }},{{ $order->address['state'] ?? 'No state Availabe' }},{{ $order->address['pin_code'] ?? 'Postcode Not Available' }}
            </p>
        </div>

        <h3>Products:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if ($order->items && $order->items->isNotEmpty())
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product not available' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">No items found for this order.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <h4 class="total">Total Amount: {{ number_format($order->grand_total, 2) }}</h4>
    </div>
</body>

</html>