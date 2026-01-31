<!-- Mobile Menu Toggle -->
<button id="menuToggle" class="lg:hidden fixed top-6 right-6 z-50 w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center text-gray-700 hover:text-primary-600 transition-all duration-300 hover:shadow-xl">
    <i class="fas fa-bars text-lg"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-dark-900 to-dark-800 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 shadow-2xl">
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center shadow-lg">
                <i class="fas fa-cog text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">SiteManager</h2>
                <p class="text-sm text-gray-400">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="p-4">
        <nav class="space-y-1">
            <a href="{{ route('admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin') ? 'bg-gradient-to-r from-primary-500/20 to-primary-500/5 border border-primary-500/30 text-primary-500' : 'text-gray-300 hover:text-white hover:bg-white/5' }} transition-all duration-300 group">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
                @if(request()->routeIs('admin'))
                <span class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                @endif
            </a>
            
            <a href="{{ route('front') }}" target="_blank" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-300 group">
                <i class="fas fa-eye w-5 text-center"></i>
                <span class="font-medium">View Frontend</span>
                <i class="fas fa-external-link-alt ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            
            <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">
                Management
            </div>
            
            <!-- Categories Management Link -->
            <a href="{{route('categories')}}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('categories.*') ? 'bg-gradient-to-r from-primary-500/20 to-primary-500/5 border border-primary-500/30 text-primary-500' : 'text-gray-300 hover:text-white hover:bg-white/5' }} transition-all duration-300 group">
                <i class="fas fa-tags w-5 text-center"></i>
                <span class="font-medium">Manage Categories</span>
                @if(request()->routeIs('categories.*'))
                <span class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                @endif
            </a>
            
            <!-- Sites Management Link -->
            <a href="{{ route('admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin') ? 'bg-gradient-to-r from-primary-500/20 to-primary-500/5 border border-primary-500/30 text-primary-500' : 'text-gray-300 hover:text-white hover:bg-white/5' }} transition-all duration-300 group">
                <i class="fas fa-globe w-5 text-center"></i>
                <span class="font-medium">Manage Sites</span>
                @if(request()->routeIs('admin'))
                <span class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                @endif
            </a>
        </nav>
    </div>

    <!-- User Profile -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center shadow-md">
                <i class="fas fa-user text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate">{{ Auth::guard('admin')->user()->name }}</p>
                <p class="text-xs text-gray-400">Administrator</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 text-gray-400 hover:text-white transition-colors duration-300 tooltip" data-tooltip="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (event) => {
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && !sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    }
</script>