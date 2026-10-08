@extends('layouts.app')

@section('title', 'Login | Picklymart')

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <h1>Welcome back 👋</h1>
        <p class="sub">Login to your Picklymart account</p>

        <div class="demo-note">Demo admin — <b>admin@picklymart.com</b> / <b>admin123</b> &nbsp;·&nbsp; Demo customer — <b>customer@picklymart.com</b> / <b>customer123</b></div>

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div class="field">
                <label>Email <span>*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="field">
                <label>Password <span>*</span></label>
                <input type="password" name="password" required>
            </div>
            <label style="display:flex;gap:8px;align-items:center;font-size:13.5px;color:#6b7280;margin:4px 0 8px">
                <input type="checkbox" name="remember"> Remember me
            </label>
            <button class="btn-submit" type="submit">Login</button>
        </form>

        <p class="auth-alt">New to Picklymart? <a href="{{ route('register') }}">Create an account</a></p>
    </div>
</div>
@endsection
