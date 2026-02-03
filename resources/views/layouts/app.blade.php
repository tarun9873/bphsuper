<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- BASIC -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','BPH Super Panel Provider | Trusted Betting Panel & White Label Solutions India')</title>

<meta name="description" content="@yield('meta_description','Get Admin, Master, Super Master & Agent Panels from BPH Super Panel Provider. Trusted betting panel provider in India offering white label B2B & B2C solutions with 24/7 support and instant ID creation.')">

<meta name="keywords" content="@yield('meta_keywords','bph super panel provider, betting panel provider india, cricket betting panel, white label betting panel, admin panel betting, master panel betting, super master panel, agent panel provider, online betting id provider, b2b betting panel, b2c betting panel, betting software india')">

<meta name="robots" content="index, follow">

<!-- FAVICON -->
<link rel="icon" href="{{ asset('/img/BPH-SUPER.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/BPH-SUPER.png') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

<!-- OPEN GRAPH (FACEBOOK / WHATSAPP) -->
<meta property="og:title" content="@yield('title','BPH Super Panel Provider | Trusted Betting Panel & White Label Solutions India')">
<meta property="og:description" content="@yield('meta_description','Get Admin, Master, Super Master & Agent Panels from BPH Super Panel Provider. Trusted betting panel provider in India offering white label B2B & B2C solutions with 24/7 support and instant ID creation.')">
<meta property="og:image" content="{{ asset('og-image.jpg') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">

<!-- TWITTER CARD -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title','BPH Super Panel Provider | Trusted Betting Panel & White Label Solutions India')">
<meta name="twitter:description" content="@yield('meta_description','Get Admin, Master, Super Master & Agent Panels from BPH Super Panel Provider. Trusted betting panel provider in India offering white label B2B & B2C solutions with 24/7 support and instant ID creation.')">
<meta name="twitter:image" content="{{ asset('og-image.jpg') }}">

<!-- CANONICAL -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')


</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- PAGE CONTENT --}}
    <div class="main-content">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('layouts.footer')

   
</body>
</html>
