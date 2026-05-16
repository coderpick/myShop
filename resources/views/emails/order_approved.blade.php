<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { text-align: center; margin-bottom: 30px; }
        .invoice-box { padding: 20px; }
        .invoice-header { display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #f8f9fa; padding-bottom: 10px; }
        .invoice-details { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border-bottom: 1px solid #eee; padding: 12px; text-align: left; }
        .table th { background-color: #f8f9fa; }
        .total-row td { font-weight: bold; font-size: 1.1rem; }
        .footer { text-align: center; margin-top: 30px; font-size: 0.9rem; color: #777; }
        .status-badge { background-color: #d1e7dd; color: #0f5132; padding: 5px 10px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Update</h1>
            <p>Dear {{ $order->user->name ?? 'Customer' }}, your order status has been updated to <strong>{{ $order->status->value }}</strong>.</p>
        </div>

        <div class="invoice-box">
            <div class="invoice-header">
                <div>
                    <strong>Order Number:</strong> #{{ $order->order_number }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}
                </div>
                <div>
                    <span class="status-badge">{{ strtoupper($order->status->value) }}</span>
                </div>
            </div>

            <div class="invoice-details">
                <strong>Shipping Address:</strong><br>
                {{ $order->user->name ?? '' }}<br>
                {{ $order->user->address ?? '' }}<br>
                {{ $order->user->city ?? '' }}, {{ $order->user->postal_code ?? '' }}<br>
                {{ $order->user->phone ?? '' }}
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>৳{{ number_format($item->price, 2) }}</td>
                        <td>৳{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">Grand Total:</td>
                        <td>৳{{ number_format($order->total_price, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>&copy; {{ date('Y') }} myShop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
