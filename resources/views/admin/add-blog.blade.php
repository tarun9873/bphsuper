@extends('admin.header')




@section('content')

@include('admin.sidebar')

<div class="add-blog-page">
    <div class="container">
       

        <!-- Success Message with Animation -->
        @if(session('success'))
            <div class="alert alert-success slide-in">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger slide-in">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-content">
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        <!-- Blog Form -->
        <div class="blog-form-card">
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                
                <div class="form-tabs">
                    <button type="button" class="tab-btn active" data-tab="content">
                        <i class="fas fa-edit"></i> Content
                    </button>
                    <button type="button" class="tab-btn" data-tab="seo">
                        <i class="fas fa-chart-line"></i> SEO
                    </button>
                    <button type="button" class="tab-btn" data-tab="preview">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                </div>

                <!-- Content Tab -->
                <div class="tab-content active" id="content-tab">
                    <!-- Title -->
                    <div class="form-group">
                        <label>Blog Title <span class="required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="Enter an engaging title...">
                        <div class="input-footer">
                            <small><i class="fas fa-info-circle"></i> Use a clear, descriptive title</small>
                            <small class="char-counter" id="titleCounter">0/100 characters</small>
                        </div>
                    </div>

                    <!-- Slug Preview -->
                    <div class="form-group">
                        <label>URL Slug</label>
                        <div class="slug-preview">
                            <span>{{ url('/blog') }}/</span>
                            <span id="slugPreview">your-blog-title</span>
                        </div>
                        <small><i class="fas fa-info-circle"></i> Auto-generated from title</small>
                    </div>

                    <!-- Featured Image -->
                    <div class="form-group">
                        <label>Featured Image</label>
                        <div class="image-upload-box">
                            <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <div class="image-preview" id="imagePreview">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click or drag image here</p>
                                <span>JPG, PNG, WebP (Max 5MB)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group">
                        <label>Content <span class="required">*</span></label>
                        <textarea name="description" id="editor" required>{{ old('description') }}</textarea>
                        <small><i class="fas fa-info-circle"></i> Write your blog content here. Use the editor toolbar for formatting.</small>
                    </div>
                </div>

                <!-- SEO Tab -->
                <div class="tab-content" id="seo-tab">
                    <div class="seo-tip">
                        <i class="fas fa-lightbulb"></i>
                        <p>Optimize your blog for search engines. Good SEO helps people find your content!</p>
                    </div>

                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="SEO Title (recommended: 50-60 characters)">
                        <div class="input-footer">
                            <small><i class="fas fa-info-circle"></i> This appears in search results as the title</small>
                            <small class="char-counter" id="metaTitleCount">0/60 characters</small>
                        </div>
                        <div class="seo-preview" id="metaTitlePreview">
                            <span>Google Preview:</span>
                            <p id="titlePreviewText">Your blog title will appear here</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Brief summary for search results (recommended: 150-160 characters)">{{ old('meta_description') }}</textarea>
                        <div class="input-footer">
                            <small><i class="fas fa-info-circle"></i> This appears below the title in search results</small>
                            <small class="char-counter" id="metaDescCount">0/160 characters</small>
                        </div>
                        <div class="seo-preview">
                            <span>Google Preview:</span>
                            <p id="descPreviewText">Your meta description will appear here. This is what users see in search results.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                        <small><i class="fas fa-info-circle"></i> Separate keywords with commas</small>
                    </div>

                    <div class="form-group">
                        <label>Focus Keyphrase</label>
                        <input type="text" name="focus_keyphrase" id="focusKeyphrase" class="form-control" placeholder="Main keyword for this blog">
                        <small><i class="fas fa-info-circle"></i> Helps optimize your content for specific keywords</small>
                    </div>
                </div>

                <!-- Preview Tab -->
                <div class="tab-content" id="preview-tab">
                    <div class="preview-card">
                        <h4>Live Preview</h4>
                        <div id="livePreview">
                            <div class="preview-image">
                                <i class="fas fa-image"></i>
                                <span>Featured Image Preview</span>
                            </div>
                            <h2 id="previewTitle">Your Blog Title</h2>
                            <div class="preview-meta">
                                <span><i class="far fa-calendar"></i> {{ date('M d, Y') }}</span>
                                <span><i class="far fa-clock"></i> Estimated read time</span>
                            </div>
                            <div id="previewContent">
                                <p>Your blog content will appear here...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-reset" onclick="resetForm()">
                        <i class="fas fa-undo-alt"></i> Reset
                    </button>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Publish Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<style>
    .add-blog-page {
        margin-left: 260px;
        padding: 30px;
        background: linear-gradient(135deg, #f5f7fa 0%, #f8fafc 100%);
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        font-size: 13px;
    }

    .breadcrumb a {
        color: #3b82f6;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb span {
        color: #64748b;
    }

    .breadcrumb i {
        font-size: 10px;
        color: #94a3b8;
    }

    .header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .header-left p {
        color: #64748b;
        font-size: 14px;
    }

    .btn-list {
        background: white;
        color: #475569;
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-list:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
        transform: translateY(-1px);
    }

    /* Alerts */
    .alert {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 16px 20px;
        border-radius: 16px;
        margin-bottom: 24px;
        animation: slideIn 0.4s ease;
        position: relative;
    }

    .slide-in {
        animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #10b981;
        color: #065f46;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-left: 4px solid #dc2626;
        color: #991b1b;
    }

    .alert-icon i {
        font-size: 22px;
    }

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        margin-bottom: 5px;
    }

    .alert-content ul {
        margin: 5px 0 0 20px;
    }

    .alert-content li {
        margin: 3px 0;
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: inherit;
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .alert-close:hover {
        opacity: 1;
    }

    /* Form Card */
    .blog-form-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    /* Form Tabs */
    .form-tabs {
        display: flex;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 0 30px;
    }

    .tab-btn {
        padding: 16px 24px;
        background: none;
        border: none;
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .tab-btn i {
        margin-right: 8px;
    }

    .tab-btn:hover {
        color: #3b82f6;
    }

    .tab-btn.active {
        color: #3b82f6;
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: #3b82f6;
    }

    .tab-content {
        display: none;
        padding: 30px;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 28px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
    }

    .required {
        color: #dc2626;
        margin-left: 4px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    .input-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 6px;
        font-size: 12px;
    }

    .char-counter {
        color: #94a3b8;
    }

    /* Slug Preview */
    .slug-preview {
        background: #f1f5f9;
        padding: 10px 16px;
        border-radius: 10px;
        font-family: monospace;
        font-size: 13px;
        color: #475569;
    }

    .slug-preview span:first-child {
        color: #64748b;
    }

    .slug-preview span:last-child {
        color: #3b82f6;
        font-weight: 500;
    }

    /* Image Upload */
    .image-upload-box {
        position: relative;
    }

    .image-upload-box input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .image-preview {
        border: 2px dashed #e2e8f0;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        background: #fafcff;
        transition: all 0.3s;
        cursor: pointer;
    }

    .image-preview:hover {
        border-color: #3b82f6;
        background: #f8fafc;
    }

    .image-preview i {
        font-size: 48px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    .image-preview p {
        color: #475569;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .image-preview span {
        font-size: 12px;
        color: #94a3b8;
    }

    /* SEO Section */
    .seo-tip {
        background: #fefce8;
        border-left: 4px solid #eab308;
        padding: 12px 16px;
        border-radius: 12px;
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
    }

    .seo-tip i {
        font-size: 20px;
        color: #eab308;
    }

    .seo-tip p {
        font-size: 13px;
        color: #854d0e;
        margin: 0;
    }

    .seo-preview {
        background: #f8fafc;
        padding: 12px 16px;
        border-radius: 12px;
        margin-top: 12px;
    }

    .seo-preview span {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .seo-preview p {
        margin: 8px 0 0;
        font-size: 13px;
    }

    #titlePreviewText {
        font-size: 16px;
        font-weight: 500;
        color: #0f172a;
    }

    #descPreviewText {
        color: #475569;
        line-height: 1.4;
    }

    /* Preview Tab */
    .preview-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
    }

    .preview-card h4 {
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        margin: 0;
        font-size: 16px;
    }

    #livePreview {
        padding: 24px;
    }

    .preview-image {
        height: 200px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .preview-image i {
        font-size: 48px;
        color: #94a3b8;
        margin-bottom: 10px;
    }

    .preview-image span {
        font-size: 13px;
        color: #64748b;
    }

    #previewTitle {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .preview-meta {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #64748b;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        padding: 24px 30px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .btn-reset {
        padding: 12px 28px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-reset:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .btn-submit {
        padding: 12px 32px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59,130,246,0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .add-blog-page {
            margin-left: 0;
            padding: 20px;
        }
        
        .form-tabs {
            flex-wrap: wrap;
        }
        
        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 12px;
        }
        
        .tab-content {
            padding: 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-reset, .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // CKEditor
    let editor;
    CKEDITOR.replace('editor', {
        height: 400,
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] }
        ],
        on: {
            instanceReady: function(ev) {
                editor = ev.editor;
                updatePreview();
                editor.on('change', function() {
                    updatePreview();
                });
            }
        }
    });

    // Title counter and slug generator
    const titleInput = document.getElementById('title');
    const titleCounter = document.getElementById('titleCounter');
    const slugPreview = document.getElementById('slugPreview');
    const previewTitle = document.getElementById('previewTitle');

    titleInput.addEventListener('input', function() {
        const count = this.value.length;
        titleCounter.textContent = `${count}/100 characters`;
        titleCounter.style.color = count > 100 ? '#dc2626' : count > 80 ? '#eab308' : '#94a3b8';
        
        // Generate slug
        let slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugPreview.textContent = slug || 'your-blog-title';
        
        // Update preview
        previewTitle.textContent = this.value || 'Your Blog Title';
        document.getElementById('titlePreviewText').textContent = this.value || 'Your blog title will appear here';
    });

    // Image Preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                imagePreview.innerHTML = `<img src="${event.target.result}" style="max-height: 150px; border-radius: 8px;">`;
                document.querySelector('.preview-image').innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px;">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Meta Title Counter
    const metaTitle = document.getElementById('meta_title');
    const metaTitleCount = document.getElementById('metaTitleCount');
    metaTitle.addEventListener('input', function() {
        const count = this.value.length;
        metaTitleCount.textContent = `${count}/60 characters`;
        metaTitleCount.style.color = count > 60 ? '#dc2626' : count > 50 ? '#eab308' : '#94a3b8';
        document.getElementById('titlePreviewText').textContent = this.value || (titleInput.value || 'Your blog title will appear here');
    });

    // Meta Description Counter
    const metaDesc = document.getElementById('meta_description');
    const metaDescCount = document.getElementById('metaDescCount');
    metaDesc.addEventListener('input', function() {
        const count = this.value.length;
        metaDescCount.textContent = `${count}/160 characters`;
        metaDescCount.style.color = count > 160 ? '#dc2626' : count > 150 ? '#eab308' : '#94a3b8';
        document.getElementById('descPreviewText').textContent = this.value || 'Your meta description will appear here. This is what users see in search results.';
    });

    // Update content preview
    function updatePreview() {
        if (editor) {
            const content = editor.getData();
            document.getElementById('previewContent').innerHTML = content;
        }
    }

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(`${tabId}-tab`).classList.add('active');
            
            if (tabId === 'preview') {
                updatePreview();
            }
        });
    });

    // Reset form
    function resetForm() {
        if (confirm('Reset all form fields? This cannot be undone.')) {
            document.getElementById('blogForm').reset();
            if (editor) editor.setData('');
            imagePreview.innerHTML = `
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Click or drag image here</p>
                <span>JPG, PNG, WebP (Max 5MB)</span>
            `;
            titleCounter.textContent = '0/100 characters';
            metaTitleCount.textContent = '0/60 characters';
            metaDescCount.textContent = '0/160 characters';
            slugPreview.textContent = 'your-blog-title';
            previewTitle.textContent = 'Your Blog Title';
            document.getElementById('titlePreviewText').textContent = 'Your blog title will appear here';
            document.getElementById('descPreviewText').textContent = 'Your meta description will appear here. This is what users see in search results.';
        }
    }
</script>

@endsection