@extends('admin.header')

@section('title', 'Manage Categories')

@section('content')

@include('admin.sidebar')

<!-- Main Content -->
<div class="lg:ml-64 transition-all duration-300">

    <!-- Top Header -->
    <header class="sticky top-0 z-30 bg-white shadow-sm border-b">
        <div class="px-4 sm:px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Category Management</h1>
                <p class="text-sm text-gray-600 mt-1">Organize and manage your site categories</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <!-- Quick Stats -->
                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full">
                        <i class="fas fa-layer-group mr-1"></i> {{ count($categories) }} Categories
                    </span>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="p-4 sm:p-6">

        <!-- Alerts -->
        <div class="mb-6">
            @if(session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 animate-fade-in-down" role="alert">
                    <i class="fas fa-check-circle mr-2 text-lg"></i>
                    <div>
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 hover:bg-green-200 transition-colors" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 animate-fade-in-down" role="alert">
                    <i class="fas fa-exclamation-circle mr-2 text-lg"></i>
                    <div>
                        <span class="font-medium">Error!</span> {{ session('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 hover:bg-red-200 transition-colors" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">All Categories</h2>
                        <p class="text-sm text-gray-600 mt-1">Click on category names to edit or delete</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="categorySearch" 
                                   placeholder="Search categories..." 
                                   class="pl-10 pr-4 py-2 border rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile View (Cards) -->
            <div class="block sm:hidden">
                <div class="p-4 space-y-4" id="mobileCategories">
                    @foreach($categories as $cat)
                    <div class="bg-gray-50 rounded-lg p-4 shadow-sm border category-card">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-tag mr-1"></i> Category
                                </span>
                                <h3 class="text-lg font-semibold text-gray-800 mt-2">{{ $cat }}</h3>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="openRenameModal('{{ $cat }}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Rename">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete('{{ $cat }}')" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Desktop View (Table) -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-tag mr-2"></i> Category Name
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-edit mr-2"></i> Rename
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-trash mr-2"></i> Delete
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $index => $cat)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 category-row" data-category="{{ strtolower($cat) }}">
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-folder text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $cat }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('category.update') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="old_category" value="{{ $cat }}">
                                    <div class="relative flex-1">
                                        <input type="text" 
                                               name="new_category" 
                                               placeholder="Enter new name"
                                               required
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow">
                                    </div>
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow">
                                        <i class="fas fa-save mr-2"></i> Update
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('category.delete') }}" method="POST" 
                                      onsubmit="return confirmDelete('{{ $cat }}')">
                                    @csrf
                                    <input type="hidden" name="category" value="{{ $cat }}">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-50 to-red-100 text-red-700 border border-red-200 rounded-lg hover:from-red-100 hover:to-red-200 hover:text-red-800 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if(count($categories) === 0)
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-folder-open text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No categories yet</h3>
                <p class="text-gray-500 mb-6">Start by adding your first category from the sites page.</p>
                <a href="{{ route('admin') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Add Site with Category
                </a>
            </div>
            @endif
        </div>

        <!-- Info Card -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-6 mb-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">How Categories Work</h3>
                    <ul class="text-gray-600 space-y-1">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Categories help organize your betting sites</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Renaming a category updates it for all sites in that category</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-2"></i>
                            <span>You can only delete empty categories</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </main>

    @include('admin.footer')

</div>

<!-- Modal for Mobile Rename -->
<div id="renameModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Rename Category</h3>
            <form id="renameForm" action="{{ route('category.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="old_category" id="modalOldCategory">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Name</label>
                    <input type="text" 
                           name="new_category" 
                           id="modalNewCategory"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" 
                            onclick="closeRenameModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .category-card {
        transition: all 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    // Search functionality
    document.getElementById('categorySearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        // Desktop rows
        document.querySelectorAll('.category-row').forEach(row => {
            const category = row.getAttribute('data-category');
            if (category.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Mobile cards
        document.querySelectorAll('.category-card').forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Mobile modal functions
    function openRenameModal(category) {
        document.getElementById('modalOldCategory').value = category;
        document.getElementById('modalNewCategory').value = category;
        document.getElementById('renameModal').classList.remove('hidden');
    }
    
    function closeRenameModal() {
        document.getElementById('renameModal').classList.add('hidden');
    }
    
    // Enhanced delete confirmation
    function confirmDelete(category) {
        if (confirm(`Are you sure you want to delete the category "${category}"?`)) {
            return true;
        }
        return false;
    }
    
    // Close modal on background click
    document.getElementById('renameModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRenameModal();
        }
    });
</script>

@endsection