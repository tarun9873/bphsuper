<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUSTAMPANEL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS for Image Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>

        body{
   user-select:none;
   -webkit-user-select:none;
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }
        
        body {
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            background: #121212;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
            padding-bottom: 70px;
        }
        
        .main-content {
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
        }
        
        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 15px;
            border-bottom: 1px solid #2a2a2a;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            width: 100%;
        }
        
        .header-content {
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* ===== IMAGE SLIDER STYLES ===== */
        .image-slider-container {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        
        .image-slider {
            width: 100%;
            height: 180px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        
        .swiper {
            width: 100%;
            height: 100%;
        }
        
        .swiper-slide {
            position: relative;
            overflow: hidden;
            display: flex;
            gap: 5px;
            padding: 5px;
        }
        
        .slide-image-container {
            flex: 1;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .swiper-slide img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }
        
        /* Navigation buttons - Hide on mobile */
        .swiper-button-next, .swiper-button-prev {
            color: white;
            background: rgb(227 155 24);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
            display: none;
        }
        
        /* Show navigation buttons on desktop */
        @media (min-width: 769px) {
            .swiper-button-next, .swiper-button-prev {
                display: flex;
            }
            
            .image-slider {
                height: 100%;
            }
        }
        
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 16px;
            font-weight: 900;
        }
        
        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 0.7;
            width: 8px;
            height: 8px;
        }
        
        .swiper-pagination-bullet-active {
            background: #e99f19;
            opacity: 1;
            width: 20px;
            border-radius: 5px;
        }
        /* ===== END IMAGE SLIDER STYLES ===== */
        
        /* ===== RR PANEL PROVIDER SECTION ===== */
        .rr-panel-section {
            padding: 20px 15px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            margin: 15px 0;
            border-radius: 15px;
            border: 1px solid #2a2a2a;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .rr-panel-title {
            text-align: center;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 15px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .rr-panel-description {
            text-align: center;
            font-size: 15px;
            line-height: 1.6;
            color: #aaa;
            margin-bottom: 20px;
            padding: 0 10px;
        }
        
        .rr-panel-features {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .feature-box {
            flex: 1;
            min-width: 150px;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .feature-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }
        
        .feature-subtitle {
            font-size: 14px;
            color: #aaa;
            font-weight: 600;
        }
        
        .rr-telegram-btn {
            display: block;
            width: 100%;
            background: #ffa605;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }
        
        .rr-telegram-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 136, 204, 0.3);
        }
        
        .rr-telegram-btn:active {
            transform: translateY(0);
        }
        
        .telegram-icon {
            font-size: 20px;
        }
        /* ===== END RR PANEL PROVIDER SECTION ===== */
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-text {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
            white-space: nowrap;
        }
        
        .get-id-btn {
            background:#e99f19;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .get-id-btn:active {
            transform: scale(0.95);
        }
        
        .demo-id {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            margin: 10px 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            backdrop-filter: blur(10px);
            width: 100%;
        }
        
        .marquee-container {
            background: #e99f19;
            padding: 8px 0;
            overflow: hidden;
            position: relative;
            width: 100%;
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
        }
        
        .marquee-container2 {
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        
        .marquee-wrapper {
            display: flex;
            width: max-content;
            animation: marquee 20s linear infinite;
        }
        
        .marquee-content {
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        
        .marquee-content span {
            margin: 0 10px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }
        
        .marquee-content i {
            color: #ffd700;
            font-size: 16px;
        }
        
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        .content {
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        
        .site-type-dropdown {
            background: #1e1e1e;
            padding: 20px;
            margin: 20px 0 25px;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            position: relative;
        }
        
        .dropdown-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            cursor: pointer;
            padding: 12px 15px;
            background: #2a2a2a;
            border-radius: 10px;
            border: 1px solid #3a3a3a;
            transition: all 0.3s ease;
        }
        
        .dropdown-header:hover {
            border-color: #667eea;
        }
        
        .dropdown-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
        }
        
        .dropdown-title i {
            color: #667eea;
            font-size: 18px;
        }
        
        .dropdown-arrow {
            color: #aaa;
            transition: transform 0.3s ease;
            font-size: 14px;
        }
        
        .dropdown-arrow.open {
            transform: rotate(180deg);
            color: #667eea;
        }
        
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            background: #2a2a2a;
            border-radius: 10px;
            border: 1px solid #3a3a3a;
            position: absolute;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
        }
        
        .dropdown-content.open {
            max-height: 400px;
            opacity: 1;
            visibility: visible;
        }
        
        .search-box {
            padding: 15px;
            border-bottom: 1px solid #3a3a3a;
        }
        
        .search-input {
            display: flex;
            align-items: center;
            background: #1e1e1e;
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #3a3a3a;
        }
        
        .search-input i {
            color: #667eea;
            margin-right: 10px;
            font-size: 16px;
        }
        
        .search-input input {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 14px;
            width: 100%;
        }
        
        .search-input input::placeholder {
            color: #888;
        }
        
        .category-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
        }
        
        .category-item {
            padding: 12px 15px;
            margin: 5px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .category-item:hover {
            background: #3a3a3a;
        }
        
        .category-item.active {
            background: #1a1a2e;
            color: white;
        }
        
        .category-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }
        
        .category-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .category-count {
            background: rgba(255, 255, 255, 0.1);
            color: #aaa;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .category-item.active .category-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .site-list {
            margin: 25px 0 40px;
            width: 100%;
        }
        
        .results-info {
            color: #aaa;
            font-size: 14px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .results-info i {
            color: #667eea;
        }
        
        .site-items-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .site-item {
            background: #1e1e1e;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            border: 1px solid #2a2a2a;
            transition: all 0.3s ease;
            width: 100%;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .site-item:active {
            transform: scale(0.98);
        }
        
        .site-item-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .site-logo {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            overflow: hidden;
        }
        
        .site-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .site-info {
            flex: 1;
        }
        
        .site-name-full {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            line-height: 1.4;
            margin-bottom: 5px;
        }
        
        .site-name-version {
            color: #aaa;
            font-weight: 600;
            font-size: 14px;
        }
        
        .site-domain {
            color: #aaa;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .site-price {
            color: #4CAF50;
            font-size: 14px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .button-row {
            display: flex;
            gap: 10px;
            width: 100%;
        }
        
        .visit-btn {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.2s;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .visit-btn:active {
            transform: scale(0.98);
        }
        
        .get-id-btn-site {
            background: #e99f19;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.2s;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }
        
        .get-id-btn-site:active {
            transform: scale(0.98);
        }
        
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1a1a2e;
            display: flex;
            justify-content: space-around;
            padding: 12px 0;
            z-index: 100;
            border-top: 1px solid #2a2a2a;
            backdrop-filter: blur(10px);
            width: 100%;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #aaa;
            font-size: 11px;
            flex: 1;
            padding: 5px;
            transition: all 0.3s ease;
        }
        
        .nav-item.active {
            color: #e99f19;
        }
        
        .nav-icon {
            font-size: 20px;
            margin-bottom: 4px;
        }
        
        @media (min-width: 769px) {
            .container {
                max-width: 100%;
            }
            
            .header, .main-content, .marquee-container, .bottom-nav {
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .header, .main-content, .marquee-container2, .bottom-nav {
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .image-slider {
                height: 100%;
            }
            
            .bottom-nav {
                left: 50%;
                transform: translateX(-50%);
                width: 800px;
            }
            
            .site-items-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .site-item-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 10px;
            }
            
            .site-logo {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }
            
            .site-info {
                width: 100%;
            }
            
            .button-row {
                flex-direction: row;
            }
            
            .rr-panel-features {
                flex-wrap: nowrap;
                gap: 20px;
            }
            
            .feature-box {
                min-width: auto;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 12px;
            }
            
            .logo-text {
                font-size: 20px;
            }
            
            .get-id-btn {
                padding: 8px 15px;
                font-size: 13px;
            }
            
            .demo-id {
                font-size: 13px;
                padding: 10px;
            }
            
            .site-name-full {
                font-size: 15px;
            }
            
            .site-items-container {
                flex-direction: column;
            }
            
            .site-item-header {
                flex-direction: row;
                align-items: flex-start;
                text-align: left;
            }
            
            .site-logo {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
            
            .button-row {
                flex-direction: row;
            }
            
            .visit-btn,
            .get-id-btn-site {
                padding: 10px;
                font-size: 13px;
            }
            
            .rr-panel-title {
                font-size: 20px;
            }
            
            .rr-panel-description {
                font-size: 14px;
            }
            
            .feature-title {
                font-size: 16px;
            }
            
            .feature-subtitle {
                font-size: 13px;
            }
            
            .rr-telegram-btn {
                padding: 14px;
                font-size: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .image-slider {
                height: 100%;
            }
            
            .swiper-slide {
                gap: 3px;
                padding: 3px;
            }
            
            .rr-panel-features {
                flex-direction: row;
                gap: 10px;
            }
            
            .feature-box {
                width: 100%;
            }
        }
        
        @media (max-width: 380px) {
            .image-slider {
                height: 140px;
            }
            
            .logo-text {
                font-size: 18px;
            }
            
            .get-id-btn {
                padding: 6px 12px;
                font-size: 12px;
            }
            
            .demo-id {
                font-size: 12px;
                padding: 8px;
            }
            
            .site-name-full {
                font-size: 14px;
            }
            
            .site-logo {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }
            
            .button-row {
                gap: 8px;
            }
            
            .visit-btn,
            .get-id-btn-site {
                padding: 8px;
                font-size: 12px;
            }
            
            .rr-panel-title {
                font-size: 18px;
            }
            
            .rr-panel-description {
                font-size: 13px;
                padding: 0;
            }
        }
        
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        
        .no-sites-message {
            text-align: center;
            padding: 40px 20px;
            background: #1e1e1e;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
            margin-top: 20px;
        }
        
        .no-sites-message i {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .no-sites-message h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #fff;
        }
        
        .no-sites-message p {
            color: #aaa;
            font-size: 14px;
        }

        /* PAYMENT MARQUEE */

        .payment-marquee {
            width:100%;
            overflow:hidden;
            background:#111;
            padding:12px 0;
        }

        .payment-track {
            display:flex;
            align-items:center;
            gap:40px;
            width:max-content;
            animation: paymentScroll 25s linear infinite;
        }

        .FooterPaymentMethods--footerPaymentMethodsImage img {
            height:40px;
            object-fit:contain;
            filter:brightness(1);
        }

        /* ANIMATION */
        @keyframes paymentScroll {
            from {
                transform:translateX(0);
            }
            to {
                transform:translateX(-50%);
            }
        }

        /* Mobile Smaller Logos */
        @media(max-width:768px) {
            .FooterPaymentMethods--footerPaymentMethodsImage img {
                height:32px;
            }
        }



        /* Overlay */
.popup-overlay{
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.7);
  display:none;
  align-items:center;
  justify-content:center;
  z-index:99999;
}

/* Box */
.popup-box{
  background:#111;
  width:90%;
  max-width:400px;
  padding:25px;
  border-radius:15px;
  text-align:center;
  color:#fff;
  position:relative;
  animation:scaleIn .4s ease;
}

/* Close */
.popup-close{
  position:absolute;
  top:10px;
  right:15px;
  font-size:26px;
  cursor:pointer;
}

/* Logo */
.popup-logo{
  width:120px;
  margin-bottom:15px;
}

/* Text */
.popup-box h2{
  color:#ffb400;
  margin-bottom:10px;
}

.tagline{
  font-size:15px;
  margin-bottom:10px;
}

.desc{
  font-size:14px;
  line-height:1.6;
  margin-bottom:15px;
}

/* Social Icons */
.popup-social{
  display:flex;
  justify-content:center;
  gap:15px;
}

.popup-social a{
  width:45px;
  height:45px;
  background:#222;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-size:20px;
  transition:.3s;
}

.popup-social a:hover{
  background:#ffb400;
  color:#000;
}

/* Animation */
@keyframes scaleIn{
  from{transform:scale(0.7);opacity:0;}
  to{transform:scale(1);opacity:1;}
}

/* Mobile */
@media(max-width:480px){
  .popup-box{
    padding:20px;
  }
}

.b2bc-btn{
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    margin-top: 10px;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    border-radius: 20px;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 10px rgba(79,70,229,0.25);
}

.b2bc-btn i{
    font-size: 12px;
}

.b2bc-btn:hover{
    background: linear-gradient(135deg, #4338ca, #4f46e5);
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(79,70,229,0.35);
}


    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <div class="header-top">
                    <div class="logo-container">
                        <img src="{{ asset('/img/BPH-SUPER.png') }}" 
                             alt="Rustampanel Logo" 
                             style="height: 65px; width: auto;">
                        <div class="logo-text">BPH SUPER</div>
                    </div>
                    
                    <button class="get-id-btn" onclick="window.location.href='https://walive.link/rustampanel'">
                        <i class="fas fa-id-card"></i> Get Panel
                    </button>
                </div>
                
                <div class="demo-id">Your Trusted Hub for iGaming Masters, Super Masters & White-Label Solutions</div>
            </div>
        </header>