@extends('layouts.app')

@section('content')

<style>

/* ===== PAGE BASE ===== */
body{
    background:#050816;
    font-family:'Poppins',sans-serif;
    color:#e6e9ff;
}

/* wrapper */
.page-wrap{
    max-width:1150px;
    margin:auto;
    padding:0 14px;
}

/* ===== HERO ===== */
.hero{
    background: radial-gradient(circle at top,#1b2a70,#060b1d);
    padding:65px 18px;
    border-radius:18px;
    text-align:center;
    margin-top:25px;
    box-shadow:0 0 35px rgba(0,0,0,.6);
}

.hero h1{
    font-size:30px;
    font-weight:800;
    color:#fff;
}

.hero p{
    color:#bfc7ff;
    margin-top:10px;
    font-size:15px;
}

.main-btn{
    background:linear-gradient(90deg,#ffb000,#ff7a00);
    padding:12px 26px;
    border-radius:10px;
    font-weight:600;
    text-decoration:none;
    color:#fff;
    display:inline-block;
    margin-top:16px;
}

/* ===== SECTION ===== */
.section{
    margin-top:55px;
}

.section h2{
    font-size:22px;
    font-weight:700;
    margin-bottom:18px;
}

/* ===== FEATURES GRID ===== */
.features-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

@media(min-width:768px){
    .features-grid{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(min-width:1100px){
    .features-grid{
        grid-template-columns:repeat(4,1fr);
    }
}

.feature-box{
    background:#0e1636;
    border-radius:14px;
    padding:18px 10px;
    text-align:center;
    border:1px solid #1b2a70;
}

.feature-box i{
    font-size:26px;
    color:#ffb000;
    margin-bottom:8px;
}

.feature-box h6{
    margin:0;
    font-size:13px;
}

/* ===== PANELS ===== */
.panel-grid{
    display:grid;
    grid-template-columns:1fr;
    gap:14px;
}

@media(min-width:768px){
    .panel-grid{
        grid-template-columns:1fr 1fr;
    }
}

.panel-card{
    background:linear-gradient(135deg,#141c3a,#0b1028);
    padding:22px;
    border-radius:14px;
    border:1px solid #1f2a64;
    text-align:center;
}

.panel-card p{
    color:#b8c1ff;
}

/* ===== INFO BOX ===== */
.info-box{
    background:#0e1636;
    border-radius:12px;
    padding:14px;
    margin-bottom:12px;
    border:1px solid #1b2a70;
}

/* ===== CTA ===== */
.cta{
    background:linear-gradient(90deg,#ffb000,#ff7a00);
    padding:26px;
    border-radius:16px;
    text-align:center;
    margin-top:50px;
    color:#fff;
}

/* ===== FLOATING BUTTONS ===== */
.floating-contact{
    position:fixed;
    right:14px;
    bottom:95px;
    display:flex;
    flex-direction:column;
    gap:12px;
    z-index:9999;
}

.floating-contact a{
    width:50px;
    height:50px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    color:#fff;
    font-size:20px;
}

.tg{background:#229ED9;}
.ig{background:linear-gradient(45deg,#fd1d1d,#e1306c,#c13584,#833ab4);}
.wa{background:#25D366;}

body{padding-bottom:80px;}

</style>   



@section('title','BPH Super Panel Provider in India | Admin, Master & White Label Betting Panel')

@section('meta_description','Join BPH Super Panel Provider and start your online gaming business in India. Get Admin Panel, Master Panel, Super Master Panel and White Label betting solutions with instant ID creation, secure system and 24/7 support.')

@section('meta_keywords','bph super panel, panel provider in india, white label betting panel india, master panel provider, super master panel, admin betting panel, online gaming panel provider, betting id provider india, cricket betting panel, agent panel provider, betting software provider india')


<div class="page-wrap">

    {{-- HERO --}}
    <div class="hero">
        <h1>BPH Super Panel Provider in India</h1>
        <p>Start your own online gaming business with Admin, Master & White Label panel. Instant ID creation & full support available.</p>
        <a href="https://wa-app.link/rustampanelsupport" class="main-btn">Get Panel Now</a>
    </div>


    {{-- ABOUT --}}
    <div class="section">
        <h2>About BPH Super Panel</h2>
        <p>BPH Super Panel is a complete iGaming management system that allows you to run your own betting network. You can manage users, agents and credit directly from your mobile.</p>
    </div>


    {{-- FEATURES --}}
    <div class="section">
        <h2>Panel Features</h2>

        <div class="features-grid">
            <div class="feature-box"><i class="fa-solid fa-user-plus"></i><h6>Instant ID Creation</h6></div>
            <div class="feature-box"><i class="fa-solid fa-dice"></i><h6>Live Casino</h6></div>
            <div class="feature-box"><i class="fa-solid fa-chart-line"></i><h6>Admin Dashboard</h6></div>
            <div class="feature-box"><i class="fa-solid fa-handshake"></i><h6>Agent Commission</h6></div>
            <div class="feature-box"><i class="fa-solid fa-mobile-screen"></i><h6>Mobile Friendly</h6></div>
            <div class="feature-box"><i class="fa-solid fa-headset"></i><h6>24/7 Support</h6></div>
        </div>
    </div>


    {{-- PANELS --}}
    <div class="section">
        <h2>Panels We Provide</h2>

        <div class="panel-grid">
            <div class="panel-card">
                <h4>Master & Super Master Panel</h4>
                <p>Create agents and earn commission from user activity.</p>
            </div>

            <div class="panel-card">
                <h4>White Label Panel</h4>
                <p>Get your own branded website and gaming platform setup.</p>
            </div>
        </div>
    </div>


    {{-- WHY --}}
    <div class="section">
        <h2>Why Choose Us?</h2>
        <div class="info-box">✔ Fast setup within 10 minutes</div>
        <div class="info-box">✔ Secure server</div>
        <div class="info-box">✔ Unlimited user creation</div>
        <div class="info-box">✔ Daily earning opportunity</div>
    </div>


    {{-- CTA --}}
    <div class="cta">
        <h3>Start Earning Today</h3>
        <p>Contact us now and activate your panel instantly.</p>
        <a href="https://wa-app.link/rustampanelsupport" class="main-btn" style="background:#000;">Join Now</a>
    </div>


    {{-- FAQ --}}
    <div class="section">
        <h2>FAQ</h2>
        <div class="info-box"><b>How fast setup?</b><br>10-30 minutes.</div>
        <div class="info-box"><b>Experience required?</b><br>No, full support provided.</div>
        <div class="info-box"><b>Support available?</b><br>Yes, 24/7.</div>
    </div>

</div>

@endsection
