@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="stat-cards">
    <div class="stat-card"><div class="v">{{ $productCount }}</div><div class="l">Total Products</div></div>
    <div class="stat-card"><div class="v">{{ $orderCount }}</div><div class="l">Total Orders</div></div>
    <div class="stat-card"><div class="v">{{ $customerCount }}</div><div class="l">Customers</div></div>
    <div class="stat-card"><div class="v">৳{{ number_format($revenue, 2) }}</div><div class="l">Confirmed Revenue</div></div>
</div>

<div class="panel">
    <h3>Recent Orders</h3>
    <table class="admin-table">
        <thead><tr><th>Code</th><th>Customer</th><th>Phone</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
            @forelse ($recentOrders as $order)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $order) }}" style="color:#1f4b3f;font-weight:700">{{ $order->code }}</a></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>৳{{ number_format($order->total, 2) }}</td>
                    <td><span class="status {{ $order->status }}">{{ $order->status }}</span></td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;color:#6b7280;padding:30px">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="panel">
    <h3>Unread Messages</h3>
    <p style="font-size:14px;color:#6b7280">
        You have <b>{{ $messageCount }}</b> unread contact message(s).
        @if ($messageCount)<a href="{{ route('admin.messages.index') }}" style="color:#1f7a4d;font-weight:600">Review them →</a>@endif
    </p>
</div>
@endsection
