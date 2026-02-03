@extends('layouts.app')



@section('content')



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

            <main id="allpanel" class="content">

<!-- ===== FILTER DROPDOWN ===== -->


<!-- ===== SITE LIST ===== -->
<section class="site-list">

<div class="results-info">
    <i class="fas fa-info-circle"></i>
    Showing <span id="filteredCount">{{ $sites->count() }}</span>
    of <span id="totalCount">{{ $sites->count() }}</span> sites
</div>

<div class="site-items-container" id="sitesContainer">

@if($sites->count() > 0)

@foreach($sites as $site)

<div class="site-item">

    <div class="site-item-header">

        <div class="site-logo">
            <img src="{{ asset('storage/logos/'.$site->logo) }}"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($site->name) }}'">
        </div>

        <div class="site-info">

            <div class="site-name-full">
                {{ $site->name }}
                <span class="site-name-version">({{ $site->category }})</span>
            </div>

            <div class="site-domain">
                {{ str_replace(['http://','https://','www.'],'',$site->url) }}
            </div>

            <div class="site-price">
                Min {{ $site->min_percentage ?? 0 }}% -
                Max {{ $site->market_percentage ?? 0 }}%
            </div>

        </div>

    </div>

    <div class="button-row">
        <a href="{{ $site->url }}" target="_blank" class="visit-btn">
            Visit Website
        </a>

        <a href="https://walive.link/rustampanel"
           target="_blank"
           class="get-id-btn-site">
           Get Panel
        </a>
    </div>

</div>

@endforeach

@else

<div class="no-sites-message">
    <h3>No Sites Found</h3>
</div>

@endif

</div>

</section>

</main>
        </div>

      

@endsection
