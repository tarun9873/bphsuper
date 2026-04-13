@extends('layouts.app')

@section('title', $note->title)

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px; min-height: 100vh; display: flex; flex-direction: column;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; gap: 12px; flex-wrap: wrap;">
        <button id="backBtn" style="background: #1e293b; border: none; width: 44px; height: 44px; border-radius: 30px; color: #cbd5e1; cursor: pointer; transition: all 0.2s;">
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <div id="saveIndicator" style="background: #0f172a; padding: 8px 20px; border-radius: 30px; font-size: 13px; color: #9ca3af; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-check-circle" style="color: #22c55e; font-size: 12px;"></i>
            <span id="saveStatus">Saved</span>
        </div>
        
        <button id="shareBtn" style="background: #1e293b; border: none; width: 44px; height: 44px; border-radius: 30px; color: #94a3b8; cursor: pointer; transition: all 0.2s;">
            <i class="fas fa-share-alt"></i>
        </button>
    </div>
    
    <!-- Editor -->
    <input type="text" 
           id="noteTitle" 
           value="{{ $note->title }}" 
           placeholder="Title" 
           style="width: 100%; background: transparent; border: none; font-size: 34px; font-weight: 700; color: #f1f5f9; padding: 12px 0; font-family: 'Inter', sans-serif; outline: none; letter-spacing: -0.5px;">
    
    <textarea id="noteContent" 
              placeholder="Start writing your note..." 
              style="width: 100%; background: transparent; border: none; font-size: 17px; line-height: 1.6; color: #cbd5e6; font-family: 'Inter', sans-serif; resize: vertical; outline: none; min-height: 60vh; padding: 16px 0;">{{ $note->content }}</textarea>
</div>

@push('styles')
<style>
    #backBtn:hover, #shareBtn:hover {
        background: #334155;
        color: white;
        transform: scale(1.05);
    }
    
    #backBtn:active, #shareBtn:active {
        transform: scale(0.95);
    }
    
    #noteTitle:focus, #noteContent:focus {
        background: rgba(30, 41, 59, 0.3);
        border-radius: 12px;
        padding-left: 12px;
        padding-right: 12px;
    }
</style>
@endpush

@push('scripts')
<script>
    const shareId = '{{ $note->share_id }}';
    let saveTimeout;
    
    const titleInput = document.getElementById('noteTitle');
    const contentInput = document.getElementById('noteContent');
    const saveStatusSpan = document.getElementById('saveStatus');
    const saveIndicator = document.getElementById('saveIndicator');
    
    function autoSave() {
        clearTimeout(saveTimeout);
        
        saveStatusSpan.textContent = 'Saving...';
        saveIndicator.innerHTML = '<div class="loading-spinner"></div><span id="saveStatus">Saving...</span>';
        
        saveTimeout = setTimeout(async () => {
            try {
                const response = await fetch('/save-note', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        share_id: shareId,
                        title: titleInput.value,
                        content: contentInput.value
                    })
                });
                
                const data = await response.json();
                
                if (data.status === 'saved') {
                    saveStatusSpan.textContent = 'Saved';
                    saveIndicator.innerHTML = '<i class="fas fa-check-circle" style="color: #22c55e;"></i><span id="saveStatus">Saved</span>';
                    showToast('Note saved', 1000);
                }
            } catch (error) {
                console.error('Save error:', error);
                saveStatusSpan.textContent = 'Error';
                saveIndicator.innerHTML = '<i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i><span id="saveStatus">Error</span>';
                showToast('Failed to save note', 2000, 'error');
            }
        }, 500);
    }
    
    titleInput.addEventListener('input', autoSave);
    contentInput.addEventListener('input', autoSave);
    
    document.getElementById('backBtn').addEventListener('click', () => {
        clearTimeout(saveTimeout);
        autoSave();
        setTimeout(() => {
            window.location.href = '/';
        }, 100);
    });
    
    document.getElementById('shareBtn').addEventListener('click', async () => {
        const url = `${window.location.origin}/note/${shareId}`;
        try {
            await navigator.clipboard.writeText(url);
            showToast('Link copied to clipboard!', 1500);
            const btn = document.getElementById('shareBtn');
            btn.style.background = '#3b82f6';
            btn.style.color = 'white';
            setTimeout(() => {
                btn.style.background = '#1e293b';
                btn.style.color = '#94a3b8';
            }, 500);
        } catch (err) {
            showToast('Press Ctrl+C to copy link', 2000, 'warning');
        }
    });
    
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            clearTimeout(saveTimeout);
            autoSave();
        }
        if (e.key === 'Escape') {
            document.getElementById('backBtn').click();
        }
    });
</script>
@endpush
@endsection