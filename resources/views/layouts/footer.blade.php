  <nav class="bottom-nav">
            <a href="{{route('front')}}" class="nav-item active">
                <i class="fas fa-home nav-icon"></i>
                <span>Home</span>
            </a>

            <a href="https://walive.link/rustampanel" class="nav-item">
                <i class="fas fa-id-card nav-icon"></i>
                <span>Get Panels</span>
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


    <!-- POPUP OVERLAY -->
<div id="welcomePopup" class="popup-overlay">
  <div class="popup-box">

    <!-- CLOSE BUTTON -->
    <span class="popup-close" onclick="closePopup()">×</span>

    <!-- LOGO -->
    <img src="/img/BPH-SUPER.png" class="popup-logo">

    <h2>WELCOME TO BPH SUPER PANEL !</h2>
    <p class="tagline">Asia's Best Gaming Platform Provider</p>

    <p class="desc">
      Site Development Available Your Domain & Your Logo Contact Fast <br>
      Start your journey with us today!
    </p>

    <h4>Join our social media to stay updated</h4>

    <div class="popup-social">
      <a href="#"><i class="fab fa-telegram"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      {{-- <a href="#"><i class="fab fa-linkedin"></i></a> --}}
      <a href="https://walive.link/rustampanelsupport"><i class="fab fa-whatsapp"></i></a>
    </div>

  </div>
</div>



<script>
/* Show after 5 seconds */
setTimeout(function(){
  document.getElementById("welcomePopup").style.display="flex";
},3000);

/* Close */
function closePopup(){
  document.getElementById("welcomePopup").style.display="none";
}
</script>

    <!-- Swiper JS for Image Slider -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
    // Initialize Swiper Image Slider with 2 images per slide
    const swiper = new Swiper('.swiper', {
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'slide',
        speed: 800,
        breakpoints: {
            769: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 0,
            }
        }
    });

    const allSites = {!! json_encode($sites) !!};
    
    const dropdownHeader = document.getElementById('dropdownHeader');
    const dropdownContent = document.getElementById('dropdownContent');
    const dropdownArrow = document.getElementById('dropdownArrow');
    const categoryList = document.getElementById('categoryList');
    const categorySearch = document.getElementById('categorySearch');
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
            // REMOVED: categorySearch.focus(); - Yeh line hi search box me focus kara rahi thi
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
            } catch (e) {}

            const firstLetter = site.name.charAt(0).toUpperCase();

            const maxPercent = Number(site.market_percentage);
            const minPercent = Number(site.min_percentage);

            let percentText = '';

            if (minPercent > 0 && maxPercent > 0) {
                percentText = `Min : Sharing ${minPercent}% | Max : Sharing ${maxPercent}%`;
            }
            else if (minPercent > 0) {
                percentText = `Minimum Sharing ${minPercent}%`;
            }
            else if (maxPercent > 0) {
                percentText = `Markate Rate ${maxPercent}%`;
            }

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
                        <div class="site-price">${percentText}</div>
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
        
        // Dropdown open/close functionality
        dropdownHeader.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });
        
        // Search functionality - only when user types
        categorySearch.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent dropdown from closing
        });
        
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
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (isDropdownOpen && 
                !dropdownHeader.contains(event.target) && 
                !dropdownContent.contains(event.target)) {
                toggleDropdown();
            }
        });
        
        // Prevent Enter key from submitting form
        categorySearch.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
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
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
                
                const href = this.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
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
        
        const slider = document.querySelector('.image-slider');
        slider.addEventListener('mouseenter', () => {
            swiper.autoplay.stop();
        });
        
        slider.addEventListener('mouseleave', () => {
            swiper.autoplay.start();
        });
    });
</script>


<script>
(function(){

/* Disable Right Click */
document.addEventListener('contextmenu', e => e.preventDefault());

/* Disable Keys */
document.addEventListener('keydown', function(e){

    if (e.ctrlKey && (
        e.key === 'u' || 
        e.key === 's' || 
        e.key === 'c' || 
        e.key === 'a' || 
        e.key === 'v'
    )) {
        e.preventDefault();
    }

    if (e.keyCode === 123) { // F12
        e.preventDefault();
    }

    if (e.ctrlKey && e.shiftKey && (
        e.key === 'i' || 
        e.key === 'j' || 
        e.key === 'c'
    )) {
        e.preventDefault();
    }
});

/* Inspect Open Detect */
setInterval(function(){
    if(window.outerWidth - window.innerWidth > 200 ||
       window.outerHeight - window.innerHeight > 200){

        document.body.innerHTML = `
            <div style="background:#000;height:100vh;
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-size:22px;font-weight:bold;">
            ACCESS DENIED
            </div>
        `;
    }
},1000);

/* Disable Image Save */
document.querySelectorAll("img").forEach(img=>{
    img.setAttribute("draggable","false");
    img.addEventListener("contextmenu", e=>e.preventDefault());
});

})();
</script>

<script>
document.querySelectorAll("img").forEach(img => {
    img.setAttribute("draggable", "false");
    img.addEventListener("contextmenu", e => e.preventDefault());
});
</script>

</body>
</html>