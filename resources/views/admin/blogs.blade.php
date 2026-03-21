@extends('admin.header')

@section('title', 'All Blogs')

@section('content')

@include('admin.sidebar')

<div class="all-blogs-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <div class="breadcrumb">
                    <a href="{{ route('admin') }}">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Blogs</span>
                </div>
                <h1><i class="fas fa-blog"></i> All Blogs</h1>
                <p>Manage all your blog posts</p>
            </div>
            <div class="header-right">
                <div class="stats-badge">
                    <span class="stats-number">{{ $blogs->count() }}</span>
                    <span class="stats-label">Total Blogs</span>
                </div>
                <a href="{{ route('admin.blogs.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Add New Blog
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        <!-- Search & Filter -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchBlogs" placeholder="Search by title, slug..." class="search-input">
            </div>
        </div>

        <!-- Blogs Table -->
        <div class="table-responsive">
            <table class="blogs-table">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-image">Image</th>
                        <th class="col-title">Title</th>
                        <th class="col-slug">Slug</th>
                        <th class="col-date">Date</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="blogsTableBody">
                    @forelse($blogs as $blog)
                        <tr class="blog-row" data-title="{{ strtolower($blog->title) }}" data-slug="{{ strtolower($blog->slug) }}">
                            <td class="col-id">{{ $loop->iteration }}</td>
                            
                            <td class="col-image">
                                @if($blog->image)
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
            @else
                                    <div class="no-image-icon">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            
                            <td class="col-title">
                                <div class="blog-title-info">
                                    <strong>{{ $blog->title }}</strong>
                                    <small class="blog-excerpt">{{ Str::limit(strip_tags($blog->description), 80) }}</small>
                                </div>
                            </td>
                            
                            <td class="col-slug">
                                <code class="slug-text">{{ $blog->slug }}</code>
                            </td>
                            
                            <td class="col-date">
                                <span class="date-badge">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $blog->created_at->format('M d, Y') }}
                                </span>
                            </td>
                            
                            <td class="col-actions">
                                <div class="action-buttons">
                                    <a href="{{ route('blog.detail', $blog->slug) }}" target="_blank" class="btn-view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('blog.delete', $blog->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete "{{ $blog->title }}"? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-blog"></i>
                                    <h3>No Blogs Found</h3>
                                    <p>Click "Add New Blog" to create your first blog post</p>
                                    <a href="{{ route('admin.blogs.create') }}" class="btn-create">
                                        <i class="fas fa-plus"></i> Create First Blog
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Results Count -->
        @if($blogs->count() > 0)
            <div class="results-footer">
                <span id="visibleCount">{{ $blogs->count() }}</span> blogs displayed
            </div>
        @endif

        <!-- Pagination -->
        @if(method_exists($blogs, 'links') && $blogs->hasPages())
            <div class="pagination-wrapper">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .all-blogs-page {
        margin-left: 260px;
        padding: 30px;
        background: #f5f7fb;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 13px;
    }

    .breadcrumb a {
        color: #3b82f6;
        text-decoration: none;
    }

    .breadcrumb i {
        font-size: 10px;
        color: #94a3b8;
    }

    .breadcrumb span {
        color: #64748b;
    }

    .header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .header-left p {
        color: #64748b;
        font-size: 14px;
    }

    .stats-badge {
        background: white;
        padding: 10px 20px;
        border-radius: 12px;
        text-align: center;
        display: inline-block;
        margin-right: 15px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
    }

    .stats-number {
        font-size: 24px;
        font-weight: 700;
        color: #3b82f6;
        display: block;
        line-height: 1;
    }

    .stats-label {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
    }

    .btn-add {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.3);
        color: white;
    }

    /* Alerts */
    .alert {
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #dc2626;
    }

    .close-alert {
        margin-left: auto;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: inherit;
        opacity: 0.6;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Filter Bar */
    .filter-bar {
        margin-bottom: 24px;
    }

    .search-box {
        position: relative;
        max-width: 350px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px 12px 42px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        background: white;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    /* Table */
    .table-responsive {
        background: white;
        border-radius: 20px;
        overflow-x: auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
    }

    .blogs-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .blogs-table th {
        text-align: left;
        padding: 16px 20px;
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 13px;
        border-bottom: 1px solid #e2e8f0;
    }

    .blogs-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .blog-row:hover {
        background: #fafcff;
    }

    /* Columns */
    .col-id {
        width: 60px;
        font-weight: 500;
        color: #64748b;
    }

    .col-image {
        width: 80px;
    }

    .blog-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 12px;
    }

    .no-image-icon {
        width: 60px;
        height: 60px;
        background: #f1f5f9;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 24px;
    }

    .blog-title-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .blog-title-info strong {
        color: #0f172a;
        font-size: 15px;
    }

    .blog-excerpt {
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
        max-width: 300px;
    }

    .slug-text {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-family: monospace;
        color: #3b82f6;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #64748b;
        background: #f1f5f9;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .date-badge i {
        font-size: 11px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-view, .btn-edit, .btn-delete {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-view {
        background: #e6f7e6;
        color: #2e7d32;
    }

    .btn-view:hover {
        background: #c8e6c9;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #fff3e0;
        color: #ed6c02;
    }

    .btn-edit:hover {
        background: #ffe0b2;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #ffebee;
        color: #d32f2f;
    }

    .btn-delete:hover {
        background: #ffcdd2;
        transform: translateY(-2px);
    }

    .delete-form {
        display: inline;
    }

    /* Empty State */
    .empty-row td {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
    }

    .empty-state i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 20px;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 20px;
    }

    .btn-create {
        background: #3b82f6;
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-create:hover {
        background: #2563eb;
        color: white;
    }

    /* Results Footer */
    .results-footer {
        text-align: center;
        padding: 20px;
        color: #64748b;
        font-size: 13px;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper nav {
        display: inline-flex;
        gap: 8px;
    }

    .pagination-wrapper .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        flex-wrap: wrap;
    }

    .pagination-wrapper .page-item {
        margin: 0;
    }

    .pagination-wrapper .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s;
    }

    .pagination-wrapper .page-link:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .pagination-wrapper .active .page-link {
        background: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .all-blogs-page {
            margin-left: 0;
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-badge {
            margin-right: 0;
        }

        .blog-title-info strong {
            font-size: 14px;
        }

        .blog-excerpt {
            display: none;
        }

        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }

        .btn-view, .btn-edit, .btn-delete {
            width: 30px;
            height: 30px;
        }
    }
</style>

<script>
    // Live search functionality
    const searchInput = document.getElementById('searchBlogs');
    const tableRows = document.querySelectorAll('.blog-row');
    const visibleCountSpan = document.getElementById('visibleCount');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            tableRows.forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const slug = row.getAttribute('data-slug') || '';
                
                if (searchTerm === '' || title.includes(searchTerm) || slug.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            if (visibleCountSpan) {
                visibleCountSpan.textContent = visibleCount;
            }
        });
    }
</script>

@endsection