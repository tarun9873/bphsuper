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
            height: 180px; /* Reduced height for mobile */
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
                height: 100%; /* Increased height for desktop */
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
            margin-top: 10px;
        }
        
        .dropdown-content.open {
            max-height: 400px;
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
        
        .selected-category {
            padding: 15px;
            background: #2a2a2a;
            border-radius: 10px;
            margin-top: 15px;
            display: none;
        }
        
        .selected-category.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        .selected-label {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 5px;
        }
        
        .selected-value {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .clear-filter {
            margin-top: 10px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 6px;
            color: #aaa;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .clear-filter:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
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
                height: 100%; /* Even smaller height for very small screens */
            }
            
            .swiper-slide {
                gap: 3px; /* Reduced gap */
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
                height: 140px; /* Adjusted height */
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
                        <i class="fas fa-id-card"></i> GET ID
                    </button>
                </div>
                
                <div class="demo-id">Yourrr Trusted Hub for iGaming Masters, Super Masters & White-Label Solutions</div>
            </div>
        </header>

        <div class="marquee-container">
            <div class="marquee-wrapper">
                <div class="marquee-content">
                    <span><i class="fas fa-bolt"></i> 24/7 Support Available</span>
                    <span><i class="fas fa-star"></i> New IDs Created Instantly</span>
                    <span><i class="fas fa-shield-alt"></i> 100% Secure & Trusted</span>
                    <span><i class="fas fa-bolt"></i> 24/7 Support Available</span>
                    <span><i class="fas fa-star"></i> New IDs Created Instantly</span>
                    <span><i class="fas fa-shield-alt"></i> 100% Secure & Trusted</span>
                </div>
                <div class="marquee-content">
                    <span><i class="fas fa-bolt"></i> 24/7 Support Available</span>
                    <span><i class="fas fa-star"></i> New IDs Created Instantly</span>
                    <span><i class="fas fa-shield-alt"></i> 100% Secure & Trusted</span>
                    <span><i class="fas fa-bolt"></i> 24/7 Support Available</span>
                    <span><i class="fas fa-star"></i> New IDs Created Instantly</span>
                    <span><i class="fas fa-shield-alt"></i> 100% Secure & Trusted</span>
                </div>
            </div>
        </div>

        <div class="main-content">
            <!-- ===== IMAGE SLIDER SECTION ===== -->
            <section class="image-slider-container">
                <div class="image-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 - Two Images Side by Side -->
                            <div class="swiper-slide">
                                <!-- First Image -->
                                <div class="slide-image-container">
                                    <img src="/img/012120.webp" 
                                         alt="Sports Betting Banner 1"
                                         onerror="this.src='https://via.placeholder.com/800x250/1a1a2e/ffffff?text=BPH+SUPER+PANEL+1'">
                                </div>
                                
                                <!-- Second Image -->
                                <div class="slide-image-container">
                                    <img src="/img/748523.webp" 
                                         alt="Sports Betting Banner 2"
                                         onerror="this.src='https://via.placeholder.com/800x250/0c2461/ffffff?text=BPH+SUPER+PANEL+2'">
                                </div>
                            </div>
                            
                            <!-- Slide 2 - Two Images Side by Side -->
                            <div class="swiper-slide">
                                <!-- First Image -->
                                <div class="slide-image-container">
                                    <img src="/img/06547865.webp"
                                         alt="Sports Betting Banner 3"
                                         onerror="this.src='https://via.placeholder.com/800x250/FF5733/ffffff?text=EXPLAY+3%25+BONUS'">
                                </div>
                                
                                <!-- Second Image -->
                                <div class="slide-image-container">
                                    <img src="/img/9845623.webp"
                                         alt="Sports Betting Banner 4"
                                         onerror="this.src='https://via.placeholder.com/800x250/C70039/ffffff?text=1XPLAY+INPLAY'">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        
                        <!-- Pagination dots -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <!-- ===== END IMAGE SLIDER SECTION ===== -->

            <!-- ===== RR PANEL PROVIDER SECTION ===== -->
            <section class="rr-panel-section">
                <h2 class="rr-panel-title">BPH SUPER PANEL PROVIDER</h2>
                
                <p class="rr-panel-description">
                    Get Your Admin, Master, Super Master, Agent Panel<br>
                    From Trusted Panel Provider in India BPH SUPER PANEL Provider
                </p>
                
                <div class="rr-panel-features">
                    <div class="feature-box">
                        <div class="feature-title">DL MDL SMDL</div>
                        <div class="feature-subtitle">/ B2B</div>
                    </div>
                    
                    <div class="feature-box">
                        <div class="feature-title">WHITE LABEL</div>
                        <div class="feature-subtitle">/ B2C</div>
                    </div>
                </div>
                
                <a href="https://t.me/rustampanel" target="_blank" class="rr-telegram-btn">
                    <i class="fab fa-telegram telegram-icon"></i>
                    JOIN OFFICIAL TELEGRAM - Join Telegram
                </a>
            </section>
            <!-- ===== END RR PANEL PROVIDER SECTION ===== -->

            <main id="allpanel" class="content">
                <section class="site-type-dropdown">
                    <div class="dropdown-header" id="dropdownHeader">
                        <div class="dropdown-title">
                            <i class="fas fa-filter"></i>
                            <span>Site Type</span>
                        </div>
                        <div class="dropdown-arrow" id="dropdownArrow">▼</div>
                    </div>
                    
                    <div class="dropdown-content" id="dropdownContent">
                        <div class="search-box">
                            <div class="search-input">
                                <i class="fas fa-search"></i>
                                <input type="text" id="categorySearch" placeholder="Search site type...">
                            </div>
                        </div>
                        
                        <div class="category-list" id="categoryList">
                        </div>
                    </div>
                    
                    <div class="selected-category" id="selectedCategory">
                        <div class="selected-label">Selected Category:</div>
                        <div class="selected-value" id="selectedValue">
                            <i class="fas fa-globe"></i>
                            <span>All Site</span>
                        </div>
                        <button class="clear-filter" id="clearFilter">
                            <i class="fas fa-times"></i>
                            Clear Filter
                        </button>
                    </div>
                </section>

                <section class="site-list">
                    <div class="results-info">
                        <i class="fas fa-info-circle"></i>
                        Showing <span id="filteredCount">{{ $sites->count() }}</span> of <span id="totalCount">{{ $sites->count() }}</span> sites
                    </div>
                    
                    <div class="site-items-container" id="sitesContainer">
                        @if($sites->count() > 0)
                            @foreach($sites as $site)
                                <div class="site-item" data-category="{{ $site->category }}">
                                    <div class="site-item-header">
                                        <div class="site-logo">
                                            <img src="{{ asset('storage/logos/' . $site->logo) }}" 
                                                 alt="{{ $site->name }} Logo" 
                                                 onerror="handleLogoError(this, '{{ substr($site->name, 0, 1) }}')">
                                        </div>
                                        <div class="site-info">
                                            <div class="site-name-full">{{ $site->name }} 
                                                @if($site->category)
                                                    <span class="site-name-version">({{ $site->category }})</span>
                                                @endif
                                            </div>
                                            @if($site->url)
                                                @php
                                                    $domain = parse_url($site->url, PHP_URL_HOST);
                                                    $domain = str_replace(['www.', 'http://', 'https://'], '', $domain);
                                                @endphp
                                                <div class="site-domain">{{ $domain ?? $site->url }}</div>
                                            @endif
                                            <div class="site-price">Market Rate:- {{ (int)$site->market_percentage }}%</div>
                                        </div>
                                    </div>
                                    <div class="button-row">
                                        <a href="{{ $site->url }}" target="_blank" class="visit-btn">Visit Website</a>
                                        <a href="https://walive.link/rustampanel" target="_blank" class="get-id-btn-site">
                                            <i class="fas fa-id-card"></i> Get ID
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-sites-message">
                                <i class="fas fa-search"></i>
                                <h3>No Sites Available</h3>
                                <p>Check back soon for new site additions!</p>
                            </div>
                        @endif
                    </div>
                </section>
            </main>
        </div>

        <nav class="bottom-nav">
            <a href="{{route('front')}}" class="nav-item active">
                <i class="fas fa-home nav-icon"></i>
                <span>Home</span>
            </a>

            <a href="https://walive.link/rustampanel" class="nav-item">
                <i class="fas fa-id-card nav-icon"></i>
                <span>Get IDs</span>
            </a>

            <a href="#allpanel"  class="nav-item">
                <i class="fas fa-th-large nav-icon"></i>
                <span>All Panel</span>
            </a>

            <a href="https://www.fairplay1.app/" class="nav-item">
                <i class="fas fa-play-circle nav-icon"></i>
                <span>Inplay</span>
            </a>

            <a href="https://walive.link/rustampanelsupport" class="nav-item">
                <i class="fas fa-headset nav-icon"></i>
                <span>Support</span>
            </a>
        </nav>
    </div>

    <!-- Swiper JS for Image Slider -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Initialize Swiper Image Slider with 2 images per slide
        const swiper = new Swiper('.swiper', {
            // Loop enabled for infinite scrolling
            loop: true,
            
            // Autoplay configuration
            autoplay: {
                delay: 4000, // 4 seconds delay between slides
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // Pagination dots
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            
            // Navigation arrows (hidden on mobile, shown on desktop)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Effect and speed
            effect: 'slide',
            speed: 800,
            
            // Responsive breakpoints
            breakpoints: {
                // For desktop - 2 images per slide
                769: {
                    slidesPerView: 1, // 1 slide (which contains 2 images)
                    spaceBetween: 0,
                },
                // For mobile - 2 images per slide (already set in CSS)
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                }
            }
        });

        // Rest of the JavaScript code remains the same...
        const allSites = {!! json_encode($sites) !!};
        
        const dropdownHeader = document.getElementById('dropdownHeader');
        const dropdownContent = document.getElementById('dropdownContent');
        const dropdownArrow = document.getElementById('dropdownArrow');
        const categoryList = document.getElementById('categoryList');
        const categorySearch = document.getElementById('categorySearch');
        const selectedCategory = document.getElementById('selectedCategory');
        const selectedValue = document.getElementById('selectedValue');
        const clearFilter = document.getElementById('clearFilter');
        const sitesContainer = document.getElementById('sitesContainer');
        const filteredCount = document.getElementById('filteredCount');
        const totalCountElement = document.getElementById('totalCount');
        
        let selectedSiteType = "All Site";
        let isDropdownOpen = false;

        function getCategoryIcon(categoryName) {
            const iconMap = {
                'All Site': 'fas fa-globe',
                '9wicket': 'fas fa-star',
                'AB Exch': 'fas fa-exchange-alt',
                'Asia': 'fas fa-flag',
                'D247': 'fas fa-bolt',
                'Diamond': 'fas fa-gem',
                'Dream 555': 'fas fa-cloud',
                'Exch247': 'fas fa-chart-line',
                'Diamond white label': 'fas fa-crown',
                'rustom': 'fas fa-shield-alt',
                '9wicket Type': 'fas fa-star',
                'AB Exch Type': 'fas fa-exchange-alt',
                'Asia Type': 'fas fa-flag',
                'D247 Type': 'fas fa-bolt',
                'Diamond Type': 'fas fa-gem',
                'Dream 555 Type': 'fas fa-cloud',
                'Exch247 Type': 'fas fa-chart-line'
            };
            
            if (iconMap[categoryName]) {
                return iconMap[categoryName];
            }
            
            for (const [key, icon] of Object.entries(iconMap)) {
                if (categoryName.includes(key) || key.includes(categoryName)) {
                    return icon;
                }
            }
            
            return 'fas fa-globe';
        }

        function prepareCategoriesData() {
            const categoriesData = [];
            
            categoriesData.push({
                name: "All Site",
                count: allSites.length,
                icon: "fas fa-globe"
            });
            
            const categoryCounts = {};
            allSites.forEach(site => {
                if (site.category && site.category !== "All Site") {
                    categoryCounts[site.category] = (categoryCounts[site.category] || 0) + 1;
                }
            });
            
            Object.entries(categoryCounts).forEach(([category, count]) => {
                if (category !== "All Site") {
                    categoriesData.push({
                        name: category,
                        count: count,
                        icon: getCategoryIcon(category)
                    });
                }
            });
            
            return categoriesData;
        }

        function toggleDropdown() {
            isDropdownOpen = !isDropdownOpen;
            
            if (isDropdownOpen) {
                dropdownContent.classList.add('open');
                dropdownArrow.classList.add('open');
                categorySearch.focus();
            } else {
                dropdownContent.classList.remove('open');
                dropdownArrow.classList.remove('open');
            }
        }

        function renderCategories(categories) {
            categoryList.innerHTML = '';
            
            const uniqueCategories = [];
            const seenCategories = new Set();
            
            categories.forEach(category => {
                if (!seenCategories.has(category.name)) {
                    seenCategories.add(category.name);
                    uniqueCategories.push(category);
                }
            });
            
            uniqueCategories.forEach(category => {
                const isActive = category.name === selectedSiteType;
                const icon = getCategoryIcon(category.name);
                
                const item = document.createElement('div');
                item.className = `category-item ${isActive ? 'active' : ''}`;
                item.innerHTML = `
                    <div class="category-name">
                        <div class="category-icon">
                            <i class="${icon}"></i>
                        </div>
                        <span>${category.name}</span>
                    </div>
                    <div class="category-count">${category.count}</div>
                `;
                
                item.addEventListener('click', () => {
                    selectCategory(category.name);
                    toggleDropdown();
                });
                
                categoryList.appendChild(item);
            });
        }

        function selectCategory(categoryName) {
            selectedSiteType = categoryName;
            
            const icon = getCategoryIcon(categoryName);
            selectedValue.innerHTML = `
                <i class="${icon}"></i>
                <span>${categoryName}</span>
            `;
            
            selectedCategory.classList.add('show');
            
            filterSitesByCategory(categoryName);
            
            const categoriesData = prepareCategoriesData();
            renderCategories(categoriesData);
            
            updateSelectedTypeInURL(categoryName);
        }

        function filterSitesByCategory(categoryName) {
            let filteredSites;
            
            if (categoryName === "All Site") {
                filteredSites = allSites;
            } else {
                filteredSites = allSites.filter(site => 
                    site.category && site.category.toLowerCase() === categoryName.toLowerCase()
                );
            }
            
            renderSites(filteredSites);
            
            filteredCount.textContent = filteredSites.length;
            totalCountElement.textContent = allSites.length;
        }

        function renderSites(sites) {
            sitesContainer.innerHTML = '';
            
            if (sites.length === 0) {
                const noSitesMessage = document.createElement('div');
                noSitesMessage.className = 'no-sites-message';
                noSitesMessage.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h3>No Sites Available</h3>
                    <p>No sites found for "${selectedSiteType}"</p>
                `;
                sitesContainer.appendChild(noSitesMessage);
                return;
            }
            
            sites.forEach(site => {
                const siteItem = document.createElement('div');
                siteItem.className = 'site-item';
                siteItem.setAttribute('data-category', site.category);
                
                let domain = site.url;
                try {
                    const url = new URL(site.url);
                    domain = url.hostname.replace('www.', '');
                } catch (e) {
                    // If URL parsing fails, use the original URL
                }
                
                const firstLetter = site.name.charAt(0).toUpperCase();
                
                // Format market percentage as integer without decimals
                const marketPercentage = parseInt(site.market_percentage);
                
                siteItem.innerHTML = `
                    <div class="site-item-header">
                        <div class="site-logo">
                            <img src="{{ asset('storage/logos') }}/${site.logo}" 
                                 alt="${site.name} Logo" 
                                 onerror="handleLogoError(this, '${firstLetter}')">
                        </div>
                        <div class="site-info">
                            <div class="site-name-full">${site.name} 
                                <span class="site-name-version">(${site.category})</span>
                            </div>
                            <div class="site-domain">${domain}</div>
                            <div class="site-price">Market Rate:- ${marketPercentage}%</div>
                        </div>
                    </div>
                    <div class="button-row">
                        <a href="${site.url}" target="_blank" class="visit-btn">Visit Website</a>
                        <a href="https://walive.link/rustampanel" target="_blank" class="get-id-btn-site">
                            <i class="fas fa-id-card"></i> Get Panel
                        </a>
                    </div>
                `;
                
                sitesContainer.appendChild(siteItem);
            });
        }

        function updateSelectedTypeInURL(typeName) {
            const url = new URL(window.location);
            if (typeName === "All Site") {
                url.searchParams.delete('type');
            } else {
                url.searchParams.set('type', typeName);
            }
            window.history.replaceState({}, '', url);
        }

        function handleLogoError(img, firstLetter) {
            const parent = img.parentElement;
            img.style.display = 'none';
            parent.innerHTML = firstLetter;
            parent.style.display = 'flex';
            parent.style.alignItems = 'center';
            parent.style.justifyContent = 'center';
            parent.style.fontSize = '24px';
            parent.style.fontWeight = '700';
            parent.style.color = 'white';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const typeFromURL = urlParams.get('type');
            
            const categoriesData = prepareCategoriesData();
            
            let validCategory = "All Site";
            if (typeFromURL) {
                if (typeFromURL === "All Site") {
                    validCategory = "All Site";
                } else {
                    const exists = categoriesData.find(t => t.name === typeFromURL);
                    if (exists) {
                        validCategory = typeFromURL;
                    }
                }
            }
            
            selectedSiteType = validCategory;
            
            renderCategories(categoriesData);
            filterSitesByCategory(selectedSiteType);
            selectCategory(selectedSiteType);
            
            dropdownHeader.addEventListener('click', toggleDropdown);
            
            categorySearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                if (searchTerm === '') {
                    renderCategories(categoriesData);
                    return;
                }
                
                const filteredTypes = categoriesData.filter(type => 
                    type.name.toLowerCase().includes(searchTerm)
                );
                
                renderCategories(filteredTypes);
            });
            
            clearFilter.addEventListener('click', function() {
                selectCategory("All Site");
            });
            
            document.addEventListener('click', function(event) {
                if (!dropdownHeader.contains(event.target) && 
                    !dropdownContent.contains(event.target) && 
                    isDropdownOpen) {
                    toggleDropdown();
                }
            });
            
            const actionBtns = document.querySelectorAll('.get-id-btn, .visit-btn, .get-id-btn-site, .rr-telegram-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (!this.href || this.href === '#') {
                        e.preventDefault();
                    }
                    
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
            
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                    
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
            
            sitesContainer.addEventListener('click', function(e) {
                const siteItem = e.target.closest('.site-item');
                if (siteItem && !e.target.classList.contains('visit-btn') && 
                    !e.target.classList.contains('get-id-btn-site') &&
                    !e.target.closest('.visit-btn') && 
                    !e.target.closest('.get-id-btn-site')) {
                    siteItem.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        siteItem.style.transform = '';
                    }, 150);
                }
            });
            
            function resetMarquee() {
                const marquee = document.querySelector('.marquee-wrapper');
                marquee.style.animation = 'none';
                setTimeout(() => {
                    marquee.style.animation = 'marquee 20s linear infinite';
                }, 10);
            }
            
            window.addEventListener('resize', resetMarquee);
            window.addEventListener('orientationchange', resetMarquee);
            
            // Pause slider on hover
            const slider = document.querySelector('.image-slider');
            slider.addEventListener('mouseenter', () => {
                swiper.autoplay.stop();
            });
            
            slider.addEventListener('mouseleave', () => {
                swiper.autoplay.start();
            });
        });
    </script>
</body>
</html>