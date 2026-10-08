@extends('layouts.app')

@section('title', $title . ' | Picklymart')

@section('content')
<div class="container static-page">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> {{ $title }}</nav>
    <h1 class="page-title">{{ $title }}</h1>

    <div class="panel">
        @if ($slug === 'terms-conditions')
            <h2>1. Acceptance of terms</h2>
            <p>By accessing Picklymart and placing an order you agree to these terms. Picklymart is an ecommerce platform operating in Bangladesh, connecting customers with quality electronics, robotics kits, sensors and POS consumables.</p>
            <h2>2. Orders and pricing</h2>
            <p>All prices are listed in Bangladeshi Taka (৳). We reserve the right to update prices and availability at any time. An order is confirmed after our team contacts you by phone or email.</p>
            <h2>3. Accounts</h2>
            <p>You are responsible for maintaining the confidentiality of your account credentials and for all activity under your account.</p>
        @elseif ($slug === 'return-policy')
            <h2>Return window</h2>
            <p>Products can be returned within <b>30 days</b> of delivery under our Cash Back Guarantee, provided the item is unused and in its original packaging.</p>
            <h2>How to return</h2>
            <ul>
                <li>Contact our support team with your order code and reason for return.</li>
                <li>Pack the item securely; our delivery partner will collect it from your address.</li>
                <li>Refunds are processed to bKash/Nagad/bank within 5–7 working days after inspection.</li>
            </ul>
        @elseif ($slug === 'support-policy')
            <h2>Support hours</h2>
            <p>Our support desk is open Saturday to Thursday, 9:00 AM – 7:00 PM (BST). We answer every message within one business day.</p>
            <h2>Contact channels</h2>
            <ul>
                <li>Phone: +880 1700-000000</li>
                <li>Email: info@picklymart.com</li>
                <li>Contact form: use the <a href="{{ route('contact') }}" style="color:#1f7a4d;font-weight:600">Contact Us page</a></li>
            </ul>
        @else
            <h2>Information we collect</h2>
            <p>We collect your name, contact details and order information solely to process and deliver your purchases. We never sell your personal data to third parties.</p>
            <h2>Cookies</h2>
            <p>We use cookies for a better user experience — keeping your cart active, remembering preferences and understanding site traffic through privacy-respecting analytics.</p>
            <h2>Data security</h2>
            <p>All sensitive data is transmitted securely and stored with industry-standard protections. You may request deletion of your account data at any time by contacting support.</p>
        @endif
    </div>
</div>
@endsection
