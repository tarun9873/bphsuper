@extends('layouts.app')




@section('title', 'DL, MDL, SMDL & Admin: Master Panel - India\'s Top Rental Panel Provider | BPH')

@section('meta_description', 'Get DL, MDL, SMDL & Admin Master Panels from BPH Super Panel Provider. India’s trusted betting panel rental service offering white label B2B & B2C solutions, instant ID creation, and 24/7 support.')

@section('meta_keywords', 'bph super panel provider, master panel india, dl mdl smdl admin panel, betting panel provider india, cricket betting panel, white label betting panel, admin panel betting, master panel betting, super master panel, agent panel provider, online betting id provider, b2b betting panel, b2c betting panel, betting software india')



@section('content')

<style>
/* PAGE */
.rental-page {
    background: #0f172a;
    min-height: 100vh;
    padding: 15px;
    color: white;
}

.rental-container {
    max-width: 900px;
    margin: auto;
}

/* SEARCH */
.global-search-box {
    margin-bottom: 15px;
}

.search-input {
    display: flex;
    align-items: center;
    background: #1e293b;
    padding: 10px;
    border-radius: 10px;
}

.search-input input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    margin-left: 10px;
    width: 100%;
}

/* CARD */
.rental-card {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, #1e293b, #0f172a);
    border-radius: 18px;
    padding: 15px;
    margin-bottom: 25px;
    border: 1px solid rgba(255,255,255,0.08);
}

/* 🔥 TOP LABEL */
.rental-badge {
    position: absolute;
    top: -10px;
    left: 15px;
    background: #facc15;
    color: black;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
}

/* LEFT */
.rental-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
    min-width: 0;
}

/* LOGO */
.rental-logo {
    width: 55px;
    height: 55px;
    background: black;
    border-radius: 12px;
    overflow: hidden;
}

.rental-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* INFO */
.rental-info h3 {
    font-size: 15px;
    font-weight: 700;
}

.rental-info p {
    font-size: 12px;
    color: #94a3b8;
}

.rental-price {
    color: #facc15;
    font-size: 13px;
    margin-top: 4px;
}

/* BUTTON */
.rental-btn {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: black;
    padding: 8px 12px;
    border-radius: 20px;
    font-weight: 700;
    text-decoration: none;
    font-size: 12px;
}

/* KEEP SAME LAYOUT MOBILE */
@media(max-width:768px){
    .rental-card {
        flex-direction: row;
    }
}
</style>

<div class="rental-page">
<div class="rental-container">

<!-- ✅ GLOBAL SEARCH -->
<div class="global-search-box">
    <div class="search-input">
        🔍
        <input type="text" id="globalSearch" placeholder="Search here...">
    </div>
</div>

<!-- ✅ CARDS -->
@foreach($rentals as $rental)

<div class="rental-card"
     data-name="{{ strtolower($rental->name) }}"
     data-type="{{ strtolower($rental->type) }}">

    <!-- 🔥 BADGE -->
    <div class="rental-badge">
        {{ strtoupper($rental->type) }}
    </div>

    <!-- LEFT -->
    <div class="rental-left">

        <div class="rental-logo">
            @if($rental->logo)
                <img src="{{ asset('storage/'.$rental->logo) }}">
            @endif
        </div>

        <div class="rental-info">
            <h3>{{ strtoupper($rental->name) }}</h3>
            <p>{{ $rental->url }}</p>

            @php
                $price = (int) $rental->price;
                $kPrice = $price >= 1000 ? round($price/1000).'k' : $price;
            @endphp

            <div class="rental-price">
                INR {{ $price }} ({{ $kPrice }})
            </div>
        </div>

    </div>

    <!-- BUTTON -->
    <a href="{{ $rental->url }}" target="_blank" class="rental-btn">
        CREATE
    </a>

</div>

@endforeach

</div>
</div>

<!-- ✅ SCRIPT -->
<script>

// ✅ Global search only
document.getElementById('globalSearch').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();

    document.querySelectorAll('.rental-card').forEach(card => {
        let name = card.dataset.name;
        let type = card.dataset.type;

        card.style.display =
            name.includes(value) || type.includes(value)
            ? 'flex' : 'none';
    });
});

</script>

@endsection