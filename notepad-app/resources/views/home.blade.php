@extends('layouts.app')

@section('title', 'My Notes')

@section('content')
<div class="container">
    <!-- Header -->
    <div style="margin-bottom: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 20px;">
            <h1 style="font-size: 34px; font-weight: 800; background: linear-gradient(135deg, #e2e8f0, #94a3b8); -webkit-background-clip: text; background-clip: text; color: transparent; letter-spacing: -0.5px;">
                minimal
            </h1>
            <span style="background: #1e293b; padding: 6px 14px; border-radius: 30px; font-size: 13px; color: #94a3b8;">
                {{ $notes->count() }} {{ Str::plural('note', $notes->count()) }}
            </span>
        </div>
        
        <!-- Search Bar -->
        <div style="position: relative;">
            <i class="fas fa-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 16px;"></i>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Search notes..." 
                   style="width: 100%; background: #1e293b; border: 1px solid #334155; border-radius: 30px; padding: 14px 16px 14px 46px; font-size: 16px; color: #f1f5f9; font-family: 'Inter', sans-serif; outline: none; transition: all 0.2s;">
        </div>
    </div>
    
    <!-- Notes Grid -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
        @forelse($notes as $note)
        <div class="note-card" data-share-id="{{ $note->share_id }}" style="background: #1e293b; border-radius: 20px; padding: 20px; cursor: pointer; transition: all 0.25s; border: 1px solid #334155; animation: fadeInUp 0.3s ease-out;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                <h3 style="font-size: 18px; font-weight: 700; color: #f1f5f9; letter-spacing: -0.3px;">{{ $note->title }}</h3>
                <button class="delete-note" data-share-id="{{ $note->share_id }}" style="background: none; border: none; color: #64748b; cursor: pointer; padding: 4px; transition: color 0.2s;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <p style="color: #9ca3af; font-size: 14px; line-height: 1.5; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ Str::limit($note->content, 100) ?: 'Empty note' }}
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: #5b6e8c;">
                <span><i class="far fa-clock" style="margin-right: 6px;"></i>{{ $note->updated_at->diffForHumans() }}</span>
                <span style="background: #0f172a; padding: 4px 8px; border-radius: 20px; font-size: 10px;">
                    <i class="fas fa-link"></i> shareable
                </span>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 60px 20px; background: rgba(30, 41, 59, 0.3); border-radius: 40px; margin-top: 40px;">
            <i class="fas fa-sticky-note" style="font-size: 80px; color: #334155; margin-bottom: 20px; display: block;"></i>
            <h3 style="font-size: 22px; font-weight: 600; margin-bottom: 8px;">No notes yet</h3>
            <p style="color: #7e8aa2;">Tap the + button to create your first note</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Floating Action Button -->
<button id="newNoteBtn" style="position: fixed; bottom: 24px; right: 24px; width: 60px; height: 60px; border-radius: 30px; background: #3b82f6; border: none; color: white; font-size: 28px; cursor: pointer; box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4); transition: all 0.2s; z-index: 100;">
    <i class="fas fa-plus"></i>
</button>

@push('styles')
<style>
    .note-card:hover {
        transform: translateY(-4px);
        background: #263445;
        border-color: #3b82f6;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }
    
    .note-card:active {
        transform: scale(0.98);
    }
    
    .delete-note:hover {
        color: #ef4444 !important;
    }
    
    #newNoteBtn:hover {
        transform: scale(1.05);
        background: #2563eb;
        box-shadow: 0 12px 28px rgba(59, 130, 246, 0.5);
    }
    
    #newNoteBtn:active {
        transform: scale(0.94);
    }
    
    #searchInput:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        background: #0f172a;
    }
    
    @media (min-width: 640px) {
        .container > div:last-child {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 1024px) {
        .container > div:last-child {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Navigate to note
    document.querySelectorAll('.note-card').forEach(card => {
        card.addEventListener('click', (e) => {
            if (!e.target.closest('.delete-note')) {
                const shareId = card.dataset.shareId;
                window.location.href = `/note/${shareId}`;
            }
        });
    });
    
    // Delete note
    document.querySelectorAll('.delete-note').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.stopPropagation();
            const shareId = btn.dataset.shareId;
            
            if (confirm('Delete this note permanently?')) {
                try {
                    const response = await fetch(`/note/${shareId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    
                    if (response.ok) {
                        showToast('Note deleted', 1500);
                        setTimeout(() => window.location.reload(), 500);
                    }
                } catch (error) {
                    showToast('Error deleting note', 2000, 'error');
                }
            }
        });
    });
    
    // New note
    document.getElementById('newNoteBtn').addEventListener('click', () => {
        window.location.href = '/new';
    });
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>
@endpush
@endsection