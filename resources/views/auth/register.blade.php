@extends('layouts.app')

@section('title', 'Registration | Picklymart')

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <h1>Create your account</h1>
        <p class="sub">Join Picklymart — Smart Picks, Smart Life</p>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="field">
                <label>Full Name <span>*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
                <label>Email <span>*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="field">
                <label>Address</label>
                <input type="text" name="address" value="{{ old('address') }}">
            </div>
            <div class="field">
                <label>Password <span>*</span> <small style="color:#6b7280">(min 6 characters)</small></label>
                <input type="password" name="password" required>
            </div>
            <div class="field">
                <label>Confirm Password <span>*</span></label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button class="btn-submit" type="submit">Register</button>
        </form>

        <p class="auth-alt">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </div>
</div>
@endsection
