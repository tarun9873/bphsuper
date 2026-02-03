@extends('admin.header')

@section('title', 'Admin Dashboard')

@section('content')
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="lg:ml-64 transition-all duration-300">
        <!-- Top Bar - Mobile Responsive -->
        <header class="sticky top-0 z-30 glass shadow-sm">
            <div class="px-4 lg:px-6 py-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
                    <!-- Breadcrumb -->
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('admin') }}" class="text-gray-600 hover:text-primary-600 transition-colors">Dashboard</a>
                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                        <span class="font-medium text-gray-800">Site Management</span>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Search - Hidden on Mobile -->
                        <div class="relative hidden md:block">
                            <input type="text" id="siteSearch" placeholder="Search sites..." class="pl-10 pr-4 py-2 w-64 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area - Mobile Responsive -->
        <main class="p-4 lg:p-6">
            <!-- Welcome Banner - Mobile Responsive -->
            <div class="mb-6 lg:mb-8 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-4 lg:p-6 text-white shadow-lg animate-fade-in">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-xl lg:text-2xl font-bold mb-2">Welcome back, {{ Auth::guard('admin')->user()->name }}! 👋</h1>
                        <p class="text-primary-100 text-sm lg:text-base">You have {{ $sites->count() }} sites to manage.</p>
                    </div>
                    <button onclick="openModal()" class="px-4 lg:px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add New Site</span>
                    </button>
                </div>
            </div>
{{-- FLASH MESSAGES --}}
@if(session()->has('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

            <!-- Stats Cards - Mobile Responsive -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <div class="bg-white rounded-xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2 lg:p-3 rounded-lg bg-primary-50">
                            <i class="fas fa-globe text-primary-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-xs lg:text-sm font-medium mb-2">Total Sites</h3>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $sites->count() }}</p>
                </div>

                <div class="bg-white rounded-xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2 lg:p-3 rounded-lg bg-green-50">
                            <i class="fas fa-chart-line text-success text-lg lg:text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-xs lg:text-sm font-medium mb-2">Avg. Market %</h3>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-800">
                        @php
                            $avgPercentage = $sites->avg('market_percentage');
                            echo $avgPercentage ? number_format($avgPercentage, 1) : '0.0';
                        @endphp%
                    </p>
                </div>

                <div class="bg-white rounded-xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2 lg:p-3 rounded-lg bg-purple-50">
                            <i class="fas fa-tags text-secondary-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-xs lg:text-sm font-medium mb-2">Categories</h3>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $sites->pluck('category')->unique()->count() }}</p>
                </div>
            </div>

            <!-- Sites Table - Mobile Responsive -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden animate-slide-up">
                <!-- Table Header - Mobile Responsive -->
                <div class="px-4 lg:px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-lg lg:text-xl font-bold text-gray-800">Managed Sites</h2>
                        <p class="text-gray-500 text-xs lg:text-sm mt-1">All websites in your directory</p>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        @if($sites->count() > 0)
                        <div class="relative">
                            <select id="categoryFilter" class="appearance-none bg-gray-50 border border-gray-200 rounded-lg pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="">All Categories</option>
                                @foreach($sites->pluck('category')->unique() as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        @endif
                    </div>
                </div>

                @if($sites->count() > 0)
                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
<thead class="bg-gray-50">
<tr>

    <!-- DRAG COLUMN -->
    <th class="py-4 px-3"></th>

    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase">Site</th>
    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase">Category</th>
    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase">
        Min / Max %
    </th>
    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>

</tr>
</thead>

<tbody id="sortableSites" class="divide-y divide-gray-100">

@foreach($sites as $site)
<tr data-id="{{ $site->id }}"
    data-category="{{ $site->category }}"
    class="hover:bg-gray-50 site-row">


    <!-- DRAG HANDLE -->
    <td class="py-4 px-3 text-gray-400 drag-handle">
        <i class="fas fa-grip-vertical"></i>
    </td>

    <!-- SITE -->
    <td class="py-4 px-6">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-lg overflow-hidden mr-4 border">
                <img src="{{ asset('storage/logos/' . $site->logo) }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($site->name) }}'"
                     class="w-full h-full object-cover">
            </div>
            <div>
                <p class="font-semibold">{{ $site->name }}</p>
                <a href="{{ $site->url }}" target="_blank" class="text-sm text-blue-500">
                    {{ Str::limit($site->url, 25) }}
                </a>
            </div>
        </div>
    </td>

    <!-- CATEGORY -->
    <td class="py-4 px-6">{{ $site->category }}</td>

    <!-- MIN MAX -->
    <td class="py-4 px-6">
        Min: {{ $site->min_percentage ?? 0 }}% <br>
        Max: {{ $site->market_percentage ?? 0 }}%
    </td>

    <!-- STATUS -->
    <td class="py-4 px-6">
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
            Active
        </span>
    </td>

    <!-- ACTIONS -->
    <td class="py-4 px-6">
        <a href="{{ route('sites.edit',$site->id) }}" class="text-blue-500 mr-2">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('sites.delete',$site->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="text-red-500 mr-2">
                <i class="fas fa-trash"></i>
            </button>
        </form>

        <a href="{{ $site->url }}" target="_blank" class="text-gray-500">
            <i class="fas fa-external-link-alt"></i>
        </a>
    </td>

</tr>
@endforeach

</tbody>
</table>

                    </div>


                    <!-- Mobile Cards - Enhanced -->
                  <div class="lg:hidden" id="mobileSortableSites">

                        @foreach($sites as $site)
                       <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-300 site-card"
     data-id="{{ $site->id }}"
     data-category="{{ $site->category }}">
<div class="flex justify-end mb-2 drag-handle text-gray-400">
    <i class="fas fa-grip-vertical"></i>
</div>
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden mr-3 border border-gray-200">
                                        <img src="{{ asset('storage/logos/' . $site->logo) }}" 
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($site->name) }}&background=667eea&color=fff'"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">{{ $site->name }}</p>
                                        <span class="text-xs text-gray-500">{{ $site->category }}</span>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Min: {{ $site->min_percentage }}% | Max: {{ $site->market_percentage }}%

                                </span>
                            </div>
                            
                            <div class="mb-3">
                                <a href="{{ $site->url }}" target="_blank" class="text-xs text-primary-500 hover:text-primary-600 break-all">
                                    {{ Str::limit($site->url, 35) }}
                                </a>
                            </div>
                            
                            <div class="mb-3">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Market Percentage</span>
                                    <span>{{ $site->market_percentage }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-400 to-green-500 rounded-full" 
                                         style="width: {{ min($site->market_percentage, 100) }}%"></div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-circle text-xs mr-1"></i> Active
                                </span>
                                
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('sites.edit', $site->id) }}" class="text-primary-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sites.delete', $site->id) }}" method="POST" 
                                          onsubmit="return confirm('Delete this site?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ $site->url }}" target="_blank" class="text-gray-500">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State - Mobile Responsive -->
                    <div class="text-center py-8 lg:py-12">
                        <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-4 lg:mb-6 rounded-full bg-gradient-to-r from-primary-100 to-secondary-100 flex items-center justify-center">
                            <i class="fas fa-globe text-xl lg:text-2xl text-primary-500"></i>
                        </div>
                        <h3 class="text-lg lg:text-xl font-bold text-gray-800 mb-2">No websites yet</h3>
                        <p class="text-gray-500 text-sm lg:text-base mb-6 px-4 lg:px-0">Get started by adding your first website to the directory</p>
                        <button onclick="openModal()" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300">
                            <i class="fas fa-plus mr-2"></i> Add Your First Site
                        </button>
                    </div>
                @endif

                <!-- Table Footer - Mobile Responsive -->
                @if($sites->count() > 0)
                <div class="px-4 lg:px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between">
                    <p class="text-gray-500 text-sm mb-3 sm:mb-0">
                        Showing <span class="font-semibold" id="showingCount">{{ $sites->count() }}</span> of <span class="font-semibold">{{ $sites->count() }}</span> sites
                    </p>
                </div>
                @endif
            </div>
        </main>

        @include('admin.footer')
    </div>

    <!-- Add Site Modal - Mobile Responsive -->
    <div id="addModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeModal()"></div>

            <!-- Modal Content -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 lg:px-6 pt-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-900">Add New Site</h3>
                            <p class="text-gray-500 text-xs lg:text-sm mt-1">Enter website details to add to directory</p>
                        </div>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times text-lg lg:text-xl"></i>
                        </button>
                    </div>
                </div>

                <form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data" id="addSiteForm">
                    @csrf
                    <div class="px-4 lg:px-6 py-4">
                        <div class="space-y-4 lg:space-y-6">
                            <!-- Site Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Site Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-globe text-gray-400"></i>
                                    </div>
                                    <input type="text" name="name" required
                                           class="pl-10 pr-4 py-2 lg:py-3 w-full border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                           placeholder="Enter site name">
                                </div>
                            </div>

                            <!-- URL -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Website URL <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-link text-gray-400"></i>
                                    </div>
                                    <input type="url" name="url" required
                                           class="pl-10 pr-4 py-2 lg:py-3 w-full border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                           placeholder="https://example.com">
                                </div>
                            </div>

                            <!-- Logo Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Logo <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 flex justify-center px-4 lg:px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-primary-500 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-cloud-upload-alt text-2xl lg:text-3xl text-gray-400 mx-auto"></i>
                                        <div class="flex flex-col sm:flex-row text-sm text-gray-600 items-center justify-center">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input type="file" name="logo" accept="image/*" required class="sr-only" onchange="previewLogo(event)">
                                            </label>
                                            <p class="sm:pl-1 mt-1 sm:mt-0">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                    </div>
                                </div>
                                <div id="logoPreview" class="mt-4 hidden">
                                    <img class="mx-auto h-20 lg:h-24 w-20 lg:w-24 rounded-lg object-cover border border-gray-200">
                                </div>
                            </div>

                           <!-- Max Percentage -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Max Percentage
    </label>
    <input type="number" name="market_percentage"
           class="w-full border rounded-lg px-4 py-2"
           min="0" max="100" step="0.01">
</div>

<!-- Min Percentage -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Min Percentage
    </label>
    <input type="number" name="min_percentage"
           class="w-full border rounded-lg px-4 py-2"
           min="0" max="100" step="0.01">
</div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                @if($sites->count() > 0)
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    @foreach($sites->pluck('category')->unique()->take(4) as $category)
                                    <button type="button" onclick="selectCategory('{{ $category }}')" 
                                            class="category-btn px-3 py-2 text-xs lg:text-sm border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        {{ $category }}
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                                <select name="category" required 
                                        class="w-full border border-gray-200 rounded-lg px-4 py-2 lg:py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                    <option value="">Select Category</option>
                                    @foreach($sites->pluck('category')->unique() as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-3">
                                    <input type="text" name="new_category" 
                                           class="w-full border border-gray-200 rounded-lg px-4 py-2 lg:py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                           placeholder="Or enter new category">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions - Mobile Responsive -->
                    <div class="bg-gray-50 px-4 lg:px-6 py-4 rounded-b-2xl">
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                            <button type="button" onclick="closeModal()"
                                    class="px-6 py-3 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-300">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <i class="fas fa-plus mr-2"></i> Add Site
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal Functions
        function openModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.getElementById('addModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Logo Preview
        function previewLogo(event) {
            const input = event.target;
            const preview = document.getElementById('logoPreview');
            const img = preview.querySelector('img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Select Category
        function selectCategory(category) {
            const select = document.querySelector('select[name="category"]');
            const buttons = document.querySelectorAll('.category-btn');
            
            // Remove active class from all buttons
            buttons.forEach(btn => {
                btn.classList.remove('bg-primary-500', 'text-white', 'border-primary-500');
                btn.classList.add('border-gray-200', 'hover:bg-gray-50');
            });
            
            // Add active class to clicked button
            event.target.classList.add('bg-primary-500', 'text-white', 'border-primary-500');
            event.target.classList.remove('border-gray-200', 'hover:bg-gray-50');
            
            // Set select value
            select.value = category;
        }

        // Search Sites
        document.getElementById('siteSearch').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.site-row, .site-card');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const siteName = row.querySelector('.font-semibold').textContent.toLowerCase();
                const siteUrl = row.querySelector('a[target="_blank"]').textContent.toLowerCase();
                
                if (siteName.includes(searchTerm) || siteUrl.includes(searchTerm) || searchTerm === '') {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update showing count
            document.getElementById('showingCount').textContent = visibleCount;
        });

        // Filter by Category
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            const rows = document.querySelectorAll('.site-row, .site-card');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const category = row.getAttribute('data-category');
                
                if (selectedCategory === '' || category === selectedCategory) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update showing count
            document.getElementById('showingCount').textContent = visibleCount;
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Format percentage input
        document.querySelector('input[name="market_percentage"]')?.addEventListener('blur', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = value.toFixed(2);
            }
        });

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 5000);
    </script>




<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
.drag-handle{
    cursor: grab;
    touch-action: none;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ======================
       DESKTOP SORTABLE
    ====================== */
    const desktopTable = document.getElementById("sortableSites");

    if (desktopTable) {
        new Sortable(desktopTable, {
            animation: 150,
            handle: ".drag-handle",
            ghostClass: "bg-yellow-100",

            onEnd: function () {

                let order = [];

                document.querySelectorAll('#sortableSites tr').forEach((row, index) => {
                    order.push({
                        id: row.dataset.id,
                        position: index + 1
                    });
                });

                saveOrder(order);
            }
        });
    }

    /* ======================
       MOBILE SORTABLE
    ====================== */
    const mobileList = document.getElementById("mobileSortableSites");

    if (mobileList) {
        new Sortable(mobileList, {
            animation: 150,
            handle: ".drag-handle",
            ghostClass: "bg-yellow-100",

            onEnd: function () {

                let order = [];

                document.querySelectorAll('#mobileSortableSites [data-id]').forEach((card, index) => {
                    order.push({
                        id: card.dataset.id,
                        position: index + 1
                    });
                });

                saveOrder(order);
            }
        });
    }

    /* ======================
       SAVE ORDER AJAX
    ====================== */
    function saveOrder(order) {
        fetch("{{ route('sites.reorder') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ order: order })
        });
    }

});
</script>



@endsection