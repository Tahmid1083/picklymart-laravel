<footer class="site-footer">
    <div class="container">
        <div class="footer-cols">
            <div>
                <div class="block">
                    <h4>Contacts</h4>
                    <p class="sub">Address</p>
                    <p>6th Floor, 9R8G+C59 Chittagong Shopping Complex, 4225</p>
                    <p class="sub">Phone</p>
                    <p>+880 1700-000000</p>
                    <p class="sub">Email</p>
                    <p>info@picklymart.com</p>
                </div>
            </div>
            <div>
                <div class="block">
                    <h4>My Account</h4>
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('orders.index') }}">Order History</a>
                    <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                    <a href="{{ route('cart.index') }}">Track Order</a>
                    <a href="{{ route('wholesale') }}">Be an affiliate partner</a>
                </div>
            </div>
            <div>
                <div class="block">
                    <h4>Seller Zone</h4>
                    <a href="{{ route('register') }}">Become A Seller</a>
                    <a href="{{ route('register') }}" class="green">Apply Now</a>
                    <a href="{{ route('login') }}">Login to Seller Panel</a>
                </div>
                <div class="block">
                    <h4>Delivery Boy</h4>
                    <a href="{{ route('login') }}">Login to Delivery Boy Panel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">© {{ date('Y') }} Picklymart — Smart Picks, Smart Life. All rights reserved.</div>
    </div>
</footer>
