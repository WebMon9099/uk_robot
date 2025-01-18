{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Changed</title>
</head>
<body>
    <h1>Hello, {{ $order->users->name }}</h1>
    <p>Your order #{{ $order->orderNumber }} status has been updated to: <strong>{{ ucfirst($order->status) }}</strong></p>

    <p>Order Summary:</p>
    <ul>
        <li>Total: ${{ number_format($order->grand_total, 2) }}</li>
        <li>Status: {{ ucfirst($order->status) }}</li>
    </ul>

    <p>Thank you for shopping with us!</p>
</body>
</html> --}}
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
            <p><strong>Order Number:</strong> {{ $order->orderNumber }} </p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        </div>

        <div class="invoice-details">
            <h2>Billing Information</h2>
            <p><strong>Name:</strong> {{ $order->users->name ?? 'No User' }}</p>
            <p><strong>Phone:</strong> {{ $order->users->phone ?? 'No Phone' }}</p>
            <p><strong>Email:</strong> {{ $order->users->email ?? 'No Email' }}</p>
            <p><strong>Address:</strong>
                {{ $order->address->address ?? 'No Name Available' }},{{ $order->address->postcode ?? 'Postcode Not Available' }}
            </p>

            <!-- Assuming you have an address relation -->
        </div>

        <h3>Products:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Pallet</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product_name}}</td>
                    <td> {{$item->pallet}} </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="total">Total Amount: {{ number_format($order->grand_total, 2) }}</h4>

        <h5 style="padding: 5px 0; color:green;">Thank you for shopping with us!</h5>
    </div>
</body>

</html>