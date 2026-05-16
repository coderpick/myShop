<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        * { font-family: 'DejaVu Sans', sans-serif; }
        body { font-size: 12px; color: #333; }
        .invoice-header { border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .invoice-header h1 { margin: 0; color: #333; }
        .info-section { width: 100%; margin-bottom: 20px; }
        .info-section td { vertical-align: top; width: 50%; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-section { margin-top: 20px; float: right; width: 30%; }
        .total-section table { width: 100%; border-collapse: collapse; }
        .total-section td { padding: 5px; }
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #777; }
        .taka-icon { width: 10px; height: 10px; vertical-align: middle; margin-right: 2px; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <table style="width: 100%;">
            <tr>
                <td><h1>INVOICE</h1></td>
                <td class="text-right">
                    <strong>#{{ $order->order_number }}</strong><br>
                    Date: {{ $order->created_at->format('d M, Y') }}
                </td>
            </tr>
        </table>
    </div>

    <table class="info-section">
        <tr>
            <td>
                <strong>Customer Information:</strong><br>
                {{ $order->user->name ?? 'Guest' }}<br>
                Email: {{ $order->user->email ?? '' }}<br>
                Phone: {{ $order->user->phone ?? '' }}
            </td>
            <td>
                <strong>Shipping Address:</strong><br>
                {{ $order->user->address ?? '' }}<br>
                {{ $order->user->city ?? '' }}, {{ $order->user->postal_code ?? '' }}
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $takaIcon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJibGFjayIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0xNi41IDE1LjVtLTEgMGExIDEgMCAxIDAgMiAwYTEgMSAwIDEgMCAtMiAwIi8+PHBhdGggZD0iTTcgN2EyIDIgMCAxIDEgNCAwdjlhMyAzIDAgMCAwIDYgMHYtLjUiLz48cGF0aCBkPSJNOCAxMWg2Ii8+PC9zdmc+';
            @endphp
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td><img src="{{ $takaIcon }}" class="taka-icon">{{ number_format($item->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="text-right"><img src="{{ $takaIcon }}" class="taka-icon">{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td class="text-right"><img src="{{ $takaIcon }}" class="taka-icon">{{ number_format($order->total_price, 2) }}</td>
            </tr>
            <tr>
                <td>Shipping:</td>
                <td class="text-right"><img src="{{ $takaIcon }}" class="taka-icon">0.00</td>
            </tr>
            <tr style="font-weight: bold; font-size: 14px;">
                <td>Grand Total:</td>
                <td class="text-right"><img src="{{ $takaIcon }}" class="taka-icon">{{ number_format($order->total_price, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This is a computer generated invoice.</p>
    </div>
</body>
</html>
