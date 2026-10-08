<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Picklymart Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="admin-shell">
    <aside class="admin-side">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/favicon.svg') }}" alt="" style="width:28px"> Picklymart Admin
        </a>
        <nav>
            <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
            <a class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">📦 Products</a>
            <a class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">🗂 Categories</a>
            <a class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">🧾 Orders</a>
            <a class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">✉ Messages</a>
            <a href="{{ route('home') }}">🏪 Visit Store</a>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit" style="all:unset;cursor:pointer;padding:11px 14px;display:flex;gap:10px">🚪 Logout</button>
            </form>
        </nav>
    </aside>

    <div class="admin-main">
        <div class="admin-topbar">
            <h1>@yield('title', 'Dashboard')</h1>
            <span style="font-size:13.5px;color:#6b7280">{{ auth()->user()->name }} ({{ auth()->user()->email }})</span>
        </div>

        <div class="admin-content">
            @if (session('success') || session('error') || $errors->any())
                @if (session('success'))<div class="flash flash-success">{{ session('success') }}</div>@endif
                @if (session('error'))<div class="flash flash-error">{{ session('error') }}</div>@endif
                @if ($errors->any())<div class="flash flash-error">@foreach ($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>@endif
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
