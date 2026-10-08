<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Picklymart | Ecommerce Website')</title>
    <meta name="description" content="@yield('meta_description', 'Picklymart — Smart Picks, Smart Life. Shop robotics kits, boards, sensors, POS paper rolls and more at the best prices in Bangladesh.')">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('partials.header')

    @if (session('success') || session('error') || $errors->any())
        <div class="flash-wrap">
            @if (session('success'))<div class="flash flash-success">{{ session('success') }}</div>@endif
            @if (session('error'))<div class="flash flash-error">{{ session('error') }}</div>@endif
            @if ($errors->any())
                <div class="flash flash-error">
                    @foreach ($errors->all() as $err)<div>{{ $err }}</div>@endforeach
                </div>
            @endif
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.policy-strip')
    @include('partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
