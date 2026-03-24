@extends('layouts.app')

@section('content')

<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #000;
}

/* BACKGROUND */
.main-bg {
    background: linear-gradient(to bottom, #000000, #111827, #000000);
    min-height: 100vh;
    color: white;
}

/* HERO */
.hero {
    text-align: center;
    padding: 50px 20px;
}

.hero h1 {
    font-size: 34px;
    font-weight: 800;
}

.hero span {
    color: #facc15;
}

.hero p {
    color: #9ca3af;
    margin-top: 10px;
}

/* BUTTON */
.cta-btn {
    display: inline-block;
    margin-top: 20px;
    background: #facc15;
    color: black;
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

.cta-btn:hover {
    transform: scale(1.05);
}

/* CONTAINER */
.container {
    /* max-width: 900px; */
    /* margin: auto; */
    
}

/* CARD */
.card {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.6);
}

.card h2 {
    text-align: center;
    color: #60a5fa;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 20px;
}

/* BOX */
.box {
    padding: 15px;
    border-radius: 15px;
    transition: 0.3s;
}

.box:hover {
    transform: scale(1.05);
}

/* COLORS */
.blue {
    border: 1px solid rgba(59,130,246,0.3);
    background: rgba(59,130,246,0.1);
}

.green {
    border: 1px solid rgba(34,197,94,0.3);
    background: rgba(34,197,94,0.1);
}

.yellow {
    border: 1px solid rgba(250,204,21,0.3);
    background: rgba(250,204,21,0.1);
}

.purple {
    border: 1px solid rgba(168,85,247,0.3);
    background: rgba(168,85,247,0.1);
}

/* TEXT */
.box h3 {
    margin-bottom: 10px;
}

.box ul {
    padding-left: 18px;
}

.box p {
    color: #d1d5db;
}

/* WARNING */
.warning {
    margin-top: 20px;
    padding: 15px;
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.3);
    text-align: center;
    border-radius: 12px;
    color: #f87171;
    font-weight: bold;
}

/* MOBILE */
@media(max-width:768px){
    .grid {
        grid-template-columns: 1fr;
    }

    .hero h1 {
        font-size: 18px;
    }
}
</style>


@section('title', 'Bphsuper Book Buy Deals | High Value Book Selling & Referral Commission')

@section('meta_description', 'Sell your running book at high value with Bphsuper. Minimum ₹20 Lakh deposit required. Get up to 30X valuation, fast processing, secure settlement & high referral commission.')

@section('meta_keywords', 'bphsuper, book buy deal, book selling, betting book sale, cricket betting book, online gaming book sell, high value deal, referral commission, betting panel, bookie network')
<div class="main-bg">

    <!-- HERO -->
    <div class="hero">
        <h1>🔥 Presented By <span>Bphsuper.com</span> 🔥</h1>
        <p>Your Trusted Hub for iGaming Masters & High Value Book Deals</p>

        <a href="https://walive.link/rustampanel" class="cta-btn">🚀 Get Deal Now</a>
    </div>

    <!-- MAIN CARD -->
    <div class="container">

        <div class="card">

            <h2>📊 BOOK BUY CRITERIA</h2>

            <!-- GRID -->
            <div class="grid">

                <!-- Minimum -->
                <div class="box blue">
                    <h3>💼 Minimum Requirement</h3>
                    <ul>
                        <li>Daily Deposit: <strong>₹20 Lakh+</strong></li>
                        <li>Book Value: <strong>30X of Daily Deposit</strong></li>
                    </ul>
                </div>

                <!-- Example -->
                <div class="box green">
                    <h3>👉 Example</h3>
                    <p>
                        Agar ₹50 Lakh ki running book hai, toh approx  
                        <strong>₹15 Crore tak deal possible hai</strong>
                        <br><small>(Terms & verification ke basis par)</small>
                    </p>
                </div>

                <!-- Referral -->
                <div class="box yellow">
                    <h3>💰 Referral Benefit</h3>
                    <p>
                        Kisi bhi bookie ko refer karein jo apni book sell karna chahta ho  
                        <br><strong>High Commission / Tagda Payout milega</strong>
                    </p>
                </div>

                <!-- Why Choose -->
                <div class="box purple">
                    <h3>🤝 Why Choose Bphsuper?</h3>
                    <ul>
                        <li>✔ Fast & Smooth Processing</li>
                        <li>✔ Trusted Network</li>
                        <li>✔ High Value Deals</li>
                        <li>✔ Secure Settlement</li>
                    </ul>
                </div>

            </div>

            <!-- WARNING -->
            <div class="warning">
                📲 Only Serious Buyers & Sellers <br>
                👉 Fake / Timepass log door rahein
            </div>

        </div>

    </div>

</div>

@endsection