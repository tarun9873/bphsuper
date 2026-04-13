<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Minimal Notes - @yield('title', 'Modern Note Taking')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #020617;
            color: #e2e8f0;
            overflow-x: hidden;
        }
        
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #3b82f6;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .toast-message {
            position: fixed;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(12px);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            z-index: 1000;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(59, 130, 246, 0.3);
            white-space: nowrap;
        }
        
        .toast-message.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 16px 80px;
        }
        
        @media (min-width: 768px) {
            .container {
                padding: 30px 24px 80px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @yield('content')
    
    <div id="toast" class="toast-message"></div>
    
    <script>
        window.showToast = function(message, duration = 2000, type = 'success') {
            const toast = document.getElementById('toast');
            if (!toast) return;
            
            toast.textContent = message;
            toast.classList.add('show');
            
            if (type === 'error') {
                toast.style.borderColor = '#ef4444';
            } else if (type === 'warning') {
                toast.style.borderColor = '#f59e0b';
            } else {
                toast.style.borderColor = '#3b82f6';
            }
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, duration);
        };
        
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    
    @stack('scripts')
</body>
</html>