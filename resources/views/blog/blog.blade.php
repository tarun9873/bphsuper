@extends('layouts.app') {{-- Tera frontend layout --}}

@section('title', 'All Blogs')

@section('content')

<div class="all-blogs-page">
    <div class="container">
        

        <!-- Search Bar -->
        {{-- <div class="search-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchBlog" placeholder="Search blogs by title..." class="search-input">
            </div>
        </div> --}}

        <!-- Blogs Grid -->
       <div class="blog-image">
    @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
    @else
        <div class="no-image">
            <i class="fas fa-image"></i>
        </div>
    @endif
</div>

                        <!-- Blog Content -->
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                <span><i class="far fa-clock"></i> {{ ceil(str_word_count(strip_tags($blog->description)) / 200) }} min read</span>
                            </div>
                            
                            <h2 class="blog-title">
                                <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                            </h2>
                            
                            <p class="blog-excerpt">
                                {{ Str::limit(strip_tags($blog->description), 120) }}
                            </p>
                            
                            <a href="{{ route('blog.detail', $blog->slug) }}" class="read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(method_exists($blogs, 'links'))
                <div class="pagination">
                    {{ $blogs->links() }}
                </div>
            @endif

            <div class="results-count">
                Showing {{ $blogs->count() }} blogs
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-blog"></i>
                <h3>No Blogs Found</h3>
                <p>Check back soon for new articles!</p>
            </div>
        @endif
    </div>
</div>

<style>
    .all-blogs-page {
       
        padding: 40px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero */
    .blog-hero {
        text-align: center;
        margin-bottom: 50px;
    }

    .blog-hero h1 {
        font-size: 42px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .blog-hero p {
        font-size: 18px;
        color: #64748b;
    }

    /* Search */
    .search-section {
        max-width: 500px;
        margin: 0 auto 40px;
    }

    .search-box {
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        font-size: 16px;
        transition: all 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
    }

    /* Blogs Grid */
    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    /* Blog Card */
    .blog-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }

    /* Blog Image */
    .blog-image {
        height: 220px;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .blog-card:hover .blog-image img {
        transform: scale(1.05);
    }

    .no-image {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        font-size: 48px;
        color: #64748b;
    }

    /* Blog Content */
    .blog-content {
        padding: 24px;
    }

    .blog-meta {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #64748b;
        margin-bottom: 12px;
    }

    .blog-meta i {
        margin-right: 5px;
    }

    .blog-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 12px;
    }

    .blog-title a {
        color: #0f172a;
        text-decoration: none;
        transition: color 0.2s;
    }

    .blog-title a:hover {
        color: #3b82f6;
    }

    .blog-excerpt {
        color: #475569;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        transition: gap 0.2s;
    }

    .read-more:hover {
        gap: 12px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .pagination nav {
        display: flex;
        gap: 8px;
    }

    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
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
        transition: all 0.2s;
    }

    .pagination .page-link:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    .pagination .active .page-link {
        background: #3b82f6;
        color: white;
    }

    .results-count {
        text-align: center;
        color: #64748b;
        font-size: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #64748b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .blogs-grid {
            grid-template-columns: 1fr;
        }
        
        .blog-hero h1 {
            font-size: 32px;
        }
        
        .blog-image {
            height: 200px;
        }
    }
</style>

<script>
    // Live Search
    const searchInput = document.getElementById('searchBlog');
    const blogCards = document.querySelectorAll('.blog-card');
    const blogsGrid = document.getElementById('blogsGrid');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            let visible = 0;
            
            blogCards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                if (term === '' || title.includes(term)) {
                    card.style.display = 'block';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // No results message
            if (visible === 0 && term !== '') {
                let noResult = document.getElementById('noResultMsg');
                if (!noResult) {
                    noResult = document.createElement('div');
                    noResult.id = 'noResultMsg';
                    noResult.className = 'empty-state';
                    noResult.innerHTML = `
                        <i class="fas fa-search"></i>
                        <h3>No blogs found</h3>
                        <p>Try searching with different keywords</p>
                    `;
                    blogsGrid.parentNode.insertBefore(noResult, blogsGrid.nextSibling);
                }
                blogsGrid.style.display = 'none';
                noResult.style.display = 'block';
            } else {
                const noResult = document.getElementById('noResultMsg');
                if (noResult) noResult.remove();
                blogsGrid.style.display = 'grid';
            }
        });
    }
</script>

@endsection