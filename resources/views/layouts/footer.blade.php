<!-- Add this CSS in the head section or before closing </head> tag -->

<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <a href="{{route('front')}}" class="nav-item active">
        <i class="fas fa-home nav-icon"></i>
        <span>Home</span>
    </a>

    <a href="https://walive.link/rustampanel" class="nav-item">
        <i class="fas fa-id-card nav-icon"></i>
        <span>Get Panels</span>
    </a>

    <a href="{{route('allpanel')}}"  class="nav-item">
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

<!-- POPUP OVERLAY -->
<div id="welcomePopup" class="popup-overlay">
  <div class="popup-box">
    <span class="popup-close" onclick="closePopup()">×</span>
    <img src="/img/BPH-SUPER.png" class="popup-logo">
    <h2>WELCOME TO BPH SUPER PANEL !</h2>
    <p class="tagline">Asia's Best Gaming Platform Provider</p>
    <p class="desc">
      Site Development Available Your Domain & Your Logo Contact Fast <br>
      Start your journey with us today!
    </p>
    <h4>Join our social media to stay updated</h4>
    <div class="popup-social">
      <a href="https://t.me/bphpanel"><i class="fab fa-telegram"></i></a>
      <a href="https://www.instagram.com/bphsuper"><i class="fab fa-instagram"></i></a>
      <a href="https://walive.link/rustampanelsupport"><i class="fab fa-whatsapp"></i></a>
    </div>
  </div>
</div>

<script>
/* Show after 5 seconds */
setTimeout(function(){
  document.getElementById("welcomePopup").style.display="flex";
},4000);

/* Close */
function closePopup(){
  document.getElementById("welcomePopup").style.display="none";
}
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
// Initialize Swiper
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
        769: { slidesPerView: 1, spaceBetween: 0 },
        320: { slidesPerView: 1, spaceBetween: 0 }
    }
});

// Dropdown functionality - WITHOUT $sites variable
document.addEventListener('DOMContentLoaded', function() {
    const dropdownHeader = document.getElementById('dropdownHeader');
    const dropdownContent = document.getElementById('dropdownContent');
    const dropdownArrow = document.getElementById('dropdownArrow');
    const categoryList = document.getElementById('categoryList');
    const categorySearch = document.getElementById('categorySearch');
    const filteredCount = document.getElementById('filteredCount');
    const totalCountElement = document.getElementById('totalCount');
    
    let selectedSiteType = "All Site";
    let isDropdownOpen = false;

    // DOM se saare sites count karo
    const allSiteItems = document.querySelectorAll('.site-list .site-item');
    const totalSites = allSiteItems.length;
    
    if(totalCountElement) {
        totalCountElement.textContent = totalSites;
    }

    // DOM se unique categories nikaalo
    function getCategoriesFromDOM() {
        const categories = new Set();
        const categoryCounts = {};
        
        allSiteItems.forEach(item => {
            const category = item.getAttribute('data-category');
            if (category) {
                categories.add(category);
                categoryCounts[category] = (categoryCounts[category] || 0) + 1;
            }
        });
        
        return { categories: Array.from(categories), categoryCounts };
    }

    // Category icon mapping
    function getCategoryIcon(categoryName) {
        const iconMap = {
            'All Site': 'fas fa-globe',
            '9wicket': 'fas fa-star',
            'AB Exch': 'fas fa-exchange-alt',
            'Asia': 'fas fa-flag',
            'D247': 'fas fa-bolt',
            'Diamond': 'fas fa-gem',
            'Dream 555': 'fas fa-cloud',
            'Exch247': 'fas fa-chart-line'
        };
        return iconMap[categoryName] || 'fas fa-globe';
    }

    // Categories data prepare karo DOM se
    function prepareCategoriesData() {
        const { categories, categoryCounts } = getCategoriesFromDOM();
        const categoriesData = [{ 
            name: "All Site", 
            count: totalSites, 
            icon: "fas fa-globe" 
        }];
        
        categories.forEach(category => {
            categoriesData.push({ 
                name: category, 
                count: categoryCounts[category], 
                icon: getCategoryIcon(category) 
            });
        });
        
        return categoriesData;
    }

    // Toggle dropdown
    function toggleDropdown() {
        isDropdownOpen = !isDropdownOpen;
        dropdownContent.classList.toggle('open', isDropdownOpen);
        dropdownArrow.classList.toggle('open', isDropdownOpen);
    }

    // Render categories
    function renderCategories(categories) {
        categoryList.innerHTML = '';
        
        categories.forEach(category => {
            const item = document.createElement('div');
            item.className = `category-item ${category.name === selectedSiteType ? 'active' : ''}`;
            item.innerHTML = `
                <div class="category-name">
                    <i class="${category.icon}"></i>
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

    // Select category
    function selectCategory(categoryName) {
        selectedSiteType = categoryName;
        filterSitesByCategory(categoryName);
        renderCategories(prepareCategoriesData());
    }

    // Filter sites by category
    function filterSitesByCategory(categoryName) {
        const siteItems = document.querySelectorAll('.site-list .site-item');
        let visibleCount = 0;
        
        siteItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            
            if (categoryName === "All Site" || itemCategory === categoryName) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        if (filteredCount) {
            filteredCount.textContent = visibleCount;
        }
    }

    // Initialize
    const categoriesData = prepareCategoriesData();
    
    // URL se category check
    const urlParams = new URLSearchParams(window.location.search);
    const typeFromURL = urlParams.get('type');
    
    if (typeFromURL && typeFromURL !== "All Site") {
        const exists = categoriesData.find(c => c.name === typeFromURL);
        if (exists) selectedSiteType = typeFromURL;
    }
    
    renderCategories(categoriesData);
    filterSitesByCategory(selectedSiteType);
    
    // Event Listeners
    dropdownHeader.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleDropdown();
    });
    
    categorySearch.addEventListener('click', (e) => e.stopPropagation());
    
    categorySearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        if (searchTerm === '') {
            renderCategories(categoriesData);
        } else {
            const filtered = categoriesData.filter(c => c.name.toLowerCase().includes(searchTerm));
            renderCategories(filtered);
        }
    });
    
    document.addEventListener('click', (event) => {
        if (isDropdownOpen && 
            !dropdownHeader.contains(event.target) && 
            !dropdownContent.contains(event.target)) {
            toggleDropdown();
        }
    });
    
    categorySearch.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') e.preventDefault();
    });
});
</script>

<!-- Security Scripts -->
<script>
(function(){
    document.addEventListener('contextmenu', e => e.preventDefault());
    
    document.addEventListener('keydown', function(e){
        if (e.ctrlKey && (e.key === 'u' || e.key === 's' || e.key === 'c' || e.key === 'a' || e.key === 'v')) {
            e.preventDefault();
        }
        if (e.keyCode === 123) e.preventDefault();
        if (e.ctrlKey && e.shiftKey && (e.key === 'i' || e.key === 'j' || e.key === 'c')) e.preventDefault();
    });
    
    document.querySelectorAll("img").forEach(img => {
        img.setAttribute("draggable", "false");
        img.addEventListener("contextmenu", e => e.preventDefault());
    });
})();
</script>

</body>
</html>