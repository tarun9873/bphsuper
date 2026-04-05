<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<!-- VIEWPORT -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- ================= SEO (FIXED DYNAMIC) ================= -->

<title>
{{ trim($__env->yieldContent('title')) ?: 'BPH Super Panel Provider | Trusted Betting Panel & White Label Solutions India' }}
</title>

<meta name="description" content="{{ trim($__env->yieldContent('meta_description')) ?: 'Get Admin, Master, Super Master & Agent Panels from BPH Super Panel Provider. Trusted betting panel provider in India offering white label B2B & B2C solutions with 24/7 support and instant ID creation.' }}">

<meta name="keywords" content="{{ trim($__env->yieldContent('meta_keywords')) ?: 'bph super panel provider, betting panel provider india, cricket betting panel, white label betting panel, admin panel betting, master panel betting, super master panel, agent panel provider, online betting id provider, b2b betting panel, b2c betting panel, betting software india' }}">

<meta name="robots" content="index, follow">

<meta name="google-site-verification" content="dLCAnWn88QcIW4iY1DUeDBnkXS4IJE1oq3jJIr86jDo" />

<!-- ================= FAVICON ================= -->

<link rel="icon" href="{{ asset('/img/BPH-SUPER.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/BPH-SUPER.png') }}">
<link rel="apple-touch-icon" href="{{ asset('/img/BPH-SUPER.png') }}">

<!-- ================= OPEN GRAPH ================= -->

<meta property="og:title" content="{{ trim($__env->yieldContent('title')) ?: 'BPH Super Panel Provider | Trusted Betting Panel & White Label Solutions India' }}">

<meta property="og:description" content="{{ trim($__env->yieldContent('meta_description')) ?: 'Best betting panel provider in India with white label solutions.' }}">

<meta property="og:image" content="{{ trim($__env->yieldContent('meta_image')) ?: asset('img/BPH-SUPER.png') }}">

<meta property="og:type" content="website">

<meta property="og:url" content="{{ url()->current() }}">

<!-- ================= TWITTER ================= -->

<meta name="twitter:card" content="summary_large_image">

<meta name="twitter:title" content="{{ trim($__env->yieldContent('title')) ?: 'BPH Super Panel Provider' }}">

<meta name="twitter:description" content="{{ trim($__env->yieldContent('meta_description')) ?: 'Best betting panel provider in India' }}">

<meta name="twitter:image" content="{{ trim($__env->yieldContent('meta_image')) ?: asset('img/BPH-SUPER.png') }}">

<!-- ================= CANONICAL ================= -->

<link rel="canonical" href="{{ url()->current() }}">

<!-- ================= CSS ================= -->

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')

</head>

<body>

{{-- HEADER --}}
@include('layouts.header')

{{-- CONTENT --}}
<div class="main-content">
    @yield('content')
</div>

{{-- FOOTER --}}
@include('layouts.footer')

<!-- ================= SEARCH SCRIPT ================= -->

<script>
document.getElementById("globalSearch")?.addEventListener("keyup", function () {

    let filter = this.value.toLowerCase();
    let sites = document.querySelectorAll(".site-item");

    let visibleCount = 0;

    sites.forEach(site => {

        let name = site.querySelector(".site-name-full")?.innerText.toLowerCase() || "";
        let domain = site.querySelector(".site-domain")?.innerText.toLowerCase() || "";
        let category = site.getAttribute("data-category")?.toLowerCase() || "";

        if (name.includes(filter) || domain.includes(filter) || category.includes(filter)) {
            site.style.display = "block";
            visibleCount++;
        } else {
            site.style.display = "none";
        }

    });

    let counter = document.getElementById("filteredCount");
    if(counter) counter.innerText = visibleCount;

});

</script>

</body>
</html>