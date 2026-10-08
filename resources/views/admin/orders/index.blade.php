@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">Orders ({{ $orders->total() }})</h2>
    <form method="GET" action="{{ route('admin.orders.index') }}">
        <select name="status" onchange="this.form.submit()" style="padding:9px 12px;border:1px solid #d6dcd6;border-radius:8px">
            <option value="">All statuses</option>
            @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $st)
                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
            @endforeach
        </select>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Code</th><th>Customer</th><th>Phone</th><th>City</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>
        @forelse ($orders as $order)
            <tr>
                <td><a href="{{ route('admin.orders.show', $order) }}" style="color:#1f4b3f;font-weight:700">{{ $order->code }}</a></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->city }}</td>
                <td>৳{{ number_format($order->total, 2) }}</td>
                <td style="font-size:12px">{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</td>
                <td><span class="status {{ $order->status }}">{{ $order->status }}</span></td>
                <td>{{ $order->created_at->format('d M, Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="8" style="text-align:center;color:#6b7280;padding:30px">No orders found.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="pagination">{{ $orders->links() }}</div>
@endsection
