@extends('layouts.app')

@section('title', 'Wholesale | Picklymart')

@section('content')
<div class="container static-page">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> Wholesale</nav>
    <h1 class="page-title">Wholesale Program — Bulk Pricing on Thermal &amp; POS Paper Rolls</h1>

    <div class="panel">
        <p><b>Skip the billing counters without the retail markup.</b> Picklymart offers wholesale prices for shops, cafes and businesses that print receipts every day. Our bulk program is built for retailers, restaurants, pharmacies, and POS resellers across Bangladesh.</p>

        <h2>Why buy wholesale from Picklymart?</h2>
        <ul>
            <li><b>Bulk cartons available</b> — order by the carton and save up to 35% compared to retail packs.</li>
            <li><b>MOQ friendly</b> — low minimum order quantities so small shops can also enjoy wholesale rates.</li>
            <li><b>Premium quality</b> — BPA-free thermal coated paper with protective layers and clear print quality.</li>
            <li><b>Custom sizes</b> — 56mm, 57mm, 79mm, 80mm rolls and custom sticker/label formats on request.</li>
            <li><b>Fast nationwide delivery</b> — 2–7 working days all over Bangladesh.</li>
        </ul>

        <h2>How to get a quote</h2>
        <ul>
            <li>Send us your required sizes, quantities and delivery city via the <a href="{{ route('contact') }}" style="color:#1f7a4d;font-weight:600">contact form</a>.</li>
            <li>Our wholesale desk replies with a formal quotation within one business day.</li>
            <li>Confirm the order and receive your shipment with dedicated after-sales support.</li>
        </ul>

        <p>Ready to order in bulk? <a href="{{ route('contact') }}" style="color:#1f7a4d;font-weight:600">Get a Wholesale Quote →</a></p>
    </div>
</div>
@endsection
