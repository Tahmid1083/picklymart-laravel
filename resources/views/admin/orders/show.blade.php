@extends('layouts.admin')

@section('title', 'Order ' . $order->code)

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">Order {{ $order->code }} <span class="status {{ $order->status }}">{{ $order->status }}</span></h2>
    <a class="btn btn-outline" href="{{ route('admin.orders.index') }}">← Back to orders</a>
</div>

<div class="form-grid" style="grid-template-columns:1fr 1fr;margin-bottom:20px">
    <div class="panel">
        <h3>Customer</h3>
        <p style="font-size:14px;margin-bottom:6px"><b>{{ $order->customer_name }}</b></p>
        <p style="font-size:13.5px;color:#6b7280">{{ $order->email }}</p>
        <p style="font-size:13.5px;color:#6b7280">{{ $order->phone }}</p>
        <p style="font-size:13.5px;color:#6b7280">{{ $order->address }}, {{ $order->city }}</p>
        @if ($order->notes)<p style="font-size:13.5px;margin-top:8px">📝 {{ $order->notes }}</p>@endif
    </div>
    <div class="panel">
        <h3>Update Status</h3>
        <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="display:flex;gap:12px;align-items:center">
            @csrf @method('PATCH')
            <select name="status" style="padding:10px 12px;border:1px solid #d6dcd6;border-radius:8px;flex:1">
                @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $st)
                    <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                @endforeach
            </select>
            <button class="btn btn-green" type="submit">Save</button>
        </form>
        <p style="font-size:13px;color:#6b7280;margin-top:12px">Placed {{ $order->created_at->format('d M, Y h:i A') }} · Payment: {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
    </div>
</div>

<div class="panel">
    <h3>Items</h3>
    <table class="admin-table">
        <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Line Total</th></tr></thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>৳{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><b>৳{{ number_format($item->price * $item->quantity, 2) }}</b></td>
                </tr>
            @endforeach
            <tr><td colspan="3" style="text-align:right;font-weight:800">Order Total</td><td><b>৳{{ number_format($order->total, 2) }}</b></td></tr>
        </tbody>
    </table>
</div>
@endsection
