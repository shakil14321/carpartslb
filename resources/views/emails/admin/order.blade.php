<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Order Confirmation - {{ $order->order_number }}</h2>
        <p> A new order has been placed by **{{ $order->first_name }} {{ $order->last_name }},</p>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Title</th>
                    <th>Part Number</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['title'] ?? '' }}</td>
                        <td>{{ $product['part_number'] ?? '' }}</td>
                        <td>{{ $product['sku'] ?? '' }}</td>
                        <td>{{ $product['quantity'] ?? 0 }}</td>
                        <td>${{ number_format($product['sale_price'] ?? 0, 2) }}</td>
                        <td>${{ number_format(($product['sale_price'] ?? 0) * ($product['quantity'] ?? 0), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total:</strong> {{ $order->total }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <p>Shipping Address:<br>
            {{ $order->address_line_1 }}<br>
            {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
            {{ $order->country }}
        </p>

        <p>– Car Parts Lb Support Team</p>
    </div>
</body>

</html>



{{-- @component('mail::message')
    # New Order Received

    Order Number: **{{ $order->order_number }}**

    A new order has been placed by **{{ $order->first_name }} {{ $order->last_name }}**.

    ### Order Summary
    @component('mail::table')
        | Product | SKU | Part Number | Qty | Price |
        |---------|-----|-------------|-----|-------|
        @foreach ($order->products as $item)
            | {{ $item['title'] }} | {{ $item['sku'] }} | {{ $item['part_number'] }} | {{ $item['quantity'] }} |
            ${{ number_format($item['sale_price'], 2) }} |
        @endforeach
    @endcomponent

    ### Total: **${{ $order->total }}**

    ### Shipping Address
    {{ $order->first_name }} {{ $order->last_name }}<br>
    {{ $order->address_line_1 }}<br>
    @if ($order->address_line_2)
        {{ $order->address_line_2 }}<br>
    @endif
    {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
    {{ $order->country }}

    @component('mail::button', ['url' => route('order.view', $order->id)])
        View Order
    @endcomponent
@endcomponent --}}
