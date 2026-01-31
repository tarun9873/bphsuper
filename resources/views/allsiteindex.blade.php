
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
                                        {{-- FIXED: Show market rate as "80%" instead of "80.00 %" --}}
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