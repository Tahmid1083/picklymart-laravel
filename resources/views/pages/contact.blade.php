@extends('layouts.app')

@section('title', 'Contact Us | Picklymart')

@section('content')
<div class="container static-page">
    <nav class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span> Contact Us</nav>
    <h1 class="page-title">Contact Us</h1>

    <div class="contact-info-band">
        <div class="contact-info-card">
            <div class="ic">📍</div>
            <h4>Address</h4>
            <p>6th Floor, 9R8G+C59 Chittagong Shopping Complex, 4225</p>
        </div>
        <div class="contact-info-card">
            <div class="ic">📞</div>
            <h4>Phone</h4>
            <p>+880 1700-000000</p>
        </div>
        <div class="contact-info-card">
            <div class="ic">✉️</div>
            <h4>Email</h4>
            <p>info@picklymart.com</p>
        </div>
    </div>

    <div class="panel">
        <h3>Send us a message</h3>
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Name <span>*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="field">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="field full">
                    <label>Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}">
                </div>
                <div class="field full">
                    <label>Message <span>*</span></label>
                    <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
            </div>
            <button class="btn btn-green" type="submit" style="margin-top:14px">Send Message</button>
        </form>
    </div>
</div>
@endsection
