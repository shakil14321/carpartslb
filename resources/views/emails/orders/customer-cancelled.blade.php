<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Cancelled Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        table th {
            background-color: #f0f0f0;
        }

        table td.total {
            font-weight: bold;
        }

        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Order Cancelled by Customer</h1>
        <p>The following order has been cancelled by the customer:</p>

        <p>
            <strong>Order Number:</strong> #{{ $order->order_number }}<br>
            <strong>Customer Name:</strong> {{ $order->first_name }} {{ $order->last_name }}<br>
            <strong>Email:</strong> {{ $order->user->email ?? '-' }}<br>
            <strong>Status:</strong> Cancelled
        </p>

        <h2>Order Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Part Number</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product['title'] ?? '-' }}</td>
                        <td>{{ $product['part_number'] ?? '' }}</td>
                        <td>{{ $product['quantity'] ?? 0 }}</td>
                        <td>${{ number_format($product['sale_price'] ?? 0, 2) }}</td>
                        <td>${{ number_format(($product['sale_price'] ?? 0) * ($product['quantity'] ?? 0), 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Grand Total</td>
                    <td class="total">${{ number_format($order->total ?? 0, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            This is an automated notification from <strong> Car Parts Lb Support Team</strong>.
        </div>
    </div>
</body>

</html>
