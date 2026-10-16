<header class="top-header">
    <div class="container">
        <button class="mobile-toggle" aria-label="Menu">☰</button>

        <a class="logo" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="Picklymart — Smart Picks, Smart Life">
        </a>

        <nav class="main-nav">
            <a href="{{ route('categories.all') }}">Category</a>
            <a href="{{ route('contact') }}">Contact Us</a>
            <a href="{{ route('wholesale') }}">Wholesale</a>
        </nav>

        <div class="header-actions">
            @auth
                <a class="btn-seller" href="{{ route('home') }}">🏪 Join as Seller</a>
            @endauth
            @guest
                <a class="btn-seller" href="{{ route('register') }}">🏪 Join as Seller</a>
            @endguest

            <input id="headerSearch" type="text" class="header-search" placeholder="Search products..." aria-label="Search">
            <button class="icon-btn" id="searchToggle" aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>

            <a class="cart-link" href="{{ route('cart.index') }}" aria-label="Cart">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1.6"/><circle cx="19" cy="21" r="1.6"/><path d="M2 3h3l2.6 12.4a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L23 7H6"/></svg>
                <span>৳{{ number_format($cartTotal, 2) }} <small>({{ $cartCount }} Items)</small></span>
            </a>

            <div class="account-area">
                <span class="avatar-circle">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6"/></svg>
                </span>
                @auth
                    <span class="account-links">
                        <a href="{{ route('orders.index') }}">{{ auth()->user()->name }}</a>
                        <span class="sep">|</span>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button type="submit" style="background:none;border:0;color:inherit;font:inherit;cursor:pointer">Logout</button></form>
                    </span>
                @endauth
                @guest
                    <span class="account-links">
                        <a href="{{ route('login') }}">Login</a>
                        <span class="sep">|</span>
                        <a href="{{ route('register') }}">Registration</a>
                    </span>
                @endguest
            </div>
        </div>
    </div>
</header>
