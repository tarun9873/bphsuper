<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Site | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .back-btn {
            position: fixed;
            top: 30px;
            left: 30px;
            background: white;
            color: #667eea;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 100;
        }
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .edit-card {
            background: white;
            border-radius: 25px;
            padding: 50px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }
        .edit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .edit-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .edit-header h2 {
            font-size: 2.2rem;
            color: #2d3748;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .edit-header p {
            color: #718096;
            font-size: 15px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #4a5568;
            font-weight: 600;
            font-size: 15px;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            color: #2d3748;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .logo-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .logo-preview {
            width: 150px;
            height: 150px;
            border: 3px dashed #cbd5e0;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 10px;
            background: #f8fafc;
        }
        .logo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }
        .btn-submit {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 18px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }
        .btn-cancel {
            flex: 1;
            background: #e2e8f0;
            color: #4a5568;
            padding: 18px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }
        .btn-cancel:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        .percentage-input-group {
            position: relative;
        }
        .percentage-symbol {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-weight: 600;
            font-size: 18px;
        }
        .percentage-input-group input {
            padding-right: 45px;
        }
        .category-container {
            position: relative;
        }
        .category-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23718096'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 45px;
        }
        .category-select option {
            padding: 10px;
        }
        .current-logo {
            font-size: 14px;
            color: #718096;
            text-align: center;
        }
        @media (max-width: 640px) {
            .edit-card {
                padding: 30px;
            }
            .back-btn {
                top: 20px;
                left: 20px;
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('admin') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
    
    <div class="edit-card">
        <div class="edit-header">
            <h2>Edit Site</h2>
            <p>Update the website details below</p>
        </div>
        
        <!-- FIXED FORM: Simple POST method without @method('PUT') -->
        <form action="{{ route('sites.update', $site->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
            <!-- No needed since we're using POST in routes -->
            
            <div class="logo-preview-container">
                <div class="logo-preview">
                    <img src="{{ asset('storage/logos/' . $site->logo) }}" 
                         id="logoPreview"
                         onerror="this.src='https://via.placeholder.com/150/667eea/ffffff?text=LOGO'">
                </div>
                <div class="current-logo">Current Logo</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Site Name *</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $site->name) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Website URL *</label>
                <input type="url" name="url" class="form-input" value="{{ old('url', $site->url) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Change Logo (Optional)</label>
                <input type="file" name="logo" class="form-input" accept="image/*" 
                       onchange="previewLogo(event)">
                <small style="color: #718096; font-size: 13px; margin-top: 5px; display: block;">
                    Leave empty to keep current logo
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Market Percentage *</label>
                <div class="percentage-input-group">
                    <input type="number" 
                           name="market_percentage" 
                           class="form-input" 
                           value="{{ old('market_percentage', $site->market_percentage) }}" 
                           placeholder="Enter market percentage" 
                           min="0" 
                           max="100" 
                           step="0.01" 
                           required>
                    <span class="percentage-symbol">%</span>
                </div>
                <small style="color: #718096; font-size: 13px; margin-top: 5px; display: block;">
                    Enter percentage value (e.g., 5.5, 10, 15.25)
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Category *</label>
                <div class="category-container">
                    <select name="category" class="form-input category-select" id="categorySelect" required>
                        <option value="">Select Category</option>
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category }}" 
                                        {{ old('category', $site->category) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ $site->category }}" selected>{{ $site->category }}</option>
                        @endif
                    </select>
                    <input type="text" 
                           name="new_category" 
                           class="form-input mt-2" 
                           id="newCategoryInput" 
                           placeholder="Or enter new category"
                           value="{{ old('new_category') }}"
                           style="display: none;">
                    <button type="button" 
                            class="text-sm text-blue-600 hover:text-blue-800 mt-1 flex items-center gap-1" 
                            onclick="toggleNewCategory()" id="toggleCategoryBtn">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                </div>
            </div>
            
            <!-- Display validation errors -->
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                Please fix the following errors:
                            </p>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="form-actions">
                <a href="{{ route('admin') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i> Update Site
                </button>
            </div>
        </form>
    </div>

    <script>
        // Logo Preview
        function previewLogo(event) {
            const input = event.target;
            const preview = document.getElementById('logoPreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Toggle between select and input for category
        function toggleNewCategory() {
            const select = document.getElementById('categorySelect');
            const input = document.getElementById('newCategoryInput');
            const button = document.getElementById('toggleCategoryBtn');
            
            if (input.style.display === 'none') {
                // Show input, hide select
                select.style.display = 'none';
                input.style.display = 'block';
                input.required = true;
                select.required = false;
                button.innerHTML = '<i class="fas fa-list"></i> Choose Existing Category';
            } else {
                // Show select, hide input
                select.style.display = 'block';
                input.style.display = 'none';
                input.required = false;
                select.required = true;
                button.innerHTML = '<i class="fas fa-plus"></i> Add New Category';
            }
        }
        
        // Form submission handler
        document.getElementById('editForm').addEventListener('submit', function(e) {
            console.log('Form submitting...');
            
            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            submitBtn.disabled = true;
            
            // Log form data for debugging
            const formData = new FormData(this);
            console.log('Form Data:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }
        });
        
        // Format market percentage on blur
        document.querySelector('input[name="market_percentage"]').addEventListener('blur', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                // Format to 2 decimal places
                this.value = value.toFixed(2);
            }
        });
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Format market percentage to 2 decimal places
            const marketPercentageInput = document.querySelector('input[name="market_percentage"]');
            if (marketPercentageInput.value) {
                let value = parseFloat(marketPercentageInput.value);
                if (!isNaN(value)) {
                    marketPercentageInput.value = value.toFixed(2);
                }
            }
            
            // Check if we should show new category input (if returning with errors)
            const newCategoryInput = document.getElementById('newCategoryInput');
            if (newCategoryInput.value) {
                toggleNewCategory();
            }
        });
    </script>
</body>
</html>