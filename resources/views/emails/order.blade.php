<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
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
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        h1,
        h2,
        h3 {
            margin: 0 0 15px;
            color: #333333;
        }

        p {
            line-height: 1.6;
            color: #555555;
        }

        .status-panel {
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .status-pending {
            background-color: #f0ad4e;
        }

        .status-confirmed {
            background-color: #5cb85c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
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

        .btn {
            display: inline-block;
            background-color: #0275d8;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .view_btn {
            margin-bottom: 10px;
        }

        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 30px;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Hello {{ $order->first_name }} {{ $order->last_name }},</h1>
        <p>Thank you for your order! We're excited to confirm that your order
            <strong>#{{ $order->order_number }}</strong> has been successfully received.
        </p>

        {{-- Customer Information --}}
        <p>
            {{-- <strong>Order Number:</strong> #{{ $order->order_number }}<br> --}}
            <strong>Customer Name:</strong> {{ $order->first_name }} {{ $order->last_name }}<br>
            <strong>Email:</strong> {{ $order->user->email ?? '-' }}<br>
        </p>

        {{-- Status Panel --}}
        @php
            $statusLabels = [
                'confirmed' => ['label' => '✅ Order Confirmed', 'class' => 'status-confirmed'],
            ];
            $currentStatus = $statusLabels[$order->status] ?? [
                'label' => ucfirst($order->status),
                'class' => 'status-confirmed',
            ];
        @endphp
        <div class="status-panel {{ $currentStatus['class'] }}">
            Status: {{ $currentStatus['label'] }}
        </div>

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

        <a href="{{ route('orderView.customer', $order->id) }}" class="btn view_btn">View Your Order</a>

        <h2>Shipping Address</h2>
        <p>
            <strong>{{ $order->address_line_1 }}</strong><br>
            {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
            {{ $order->country }}
        </p>

        <p>If you have any questions about your order, feel free to reply to this email or contact our support team.</p>

        <div class="footer">
            Thanks,<br>
            <strong>Car Parts Lb Support Team</strong>
        </div>
    </div>
</body>

</html>
