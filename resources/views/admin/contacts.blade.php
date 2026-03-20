{{-- resources/views/admin/contacts/index.blade.php --}}
@extends('admin.header')

@section('title', 'Contact Data')

@section('content')

@include('admin.sidebar')

<div class="contact-dashboard">
    <div class="dashboard-container">
        {{-- Header Section --}}
        <div class="dashboard-header">
            <div class="header-left">
                <div class="title-section">
                    <span class="title-icon">📩</span>
                    <h1>Contact Leads</h1>
                </div>
                <p class="subtitle">Manage and track all incoming inquiries</p>
            </div>
            <div class="header-right">
                <div class="stats-card">
                    <span class="stats-number">{{ $contacts->count() }}</span>
                    <span class="stats-label">Total Leads</span>
                </div>
                <button class="btn-refresh" onclick="window.location.reload()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 4v6h-6M1 20v-6h6" stroke="currentColor" stroke-linecap="round"/>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15" stroke="currentColor" stroke-linecap="round"/>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        {{-- Search & Filter Bar --}}
        <div class="filter-section">
            <div class="search-wrapper">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" fill="none"/>
                    <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-linecap="round"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Search by name, number, website or message..." class="search-input">
            </div>
            <div class="filter-group">
                <select id="dateFilter" class="filter-select">
                    <option value="all">All Dates</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
        </div>

        {{-- Desktop Table View --}}
        <div class="table-wrapper">
            <table class="contact-table" id="contactTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Website</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($contacts as $contact)
                    <tr class="contact-row" 
                        data-date="{{ $contact->created_at->toDateString() }}" 
                        data-name="{{ strtolower($contact->name) }}" 
                        data-number="{{ $contact->number }}" 
                        data-website="{{ strtolower($contact->website) }}" 
                        data-message="{{ strtolower($contact->message) }}">
                        <td class="col-id">#{{ $contact->id }}</td>
                        <td class="col-name">
                            <div class="user-info">
                                <div class="avatar" style="background-color: {{ '#' . substr(md5($contact->name), 0, 6) }}">
                                    {{ strtoupper(substr($contact->name, 0, 2)) }}
                                </div>
                                <span class="user-name">{{ $contact->name }}</span>
                            </div>
                        </td>
                        <td class="col-number">
                            <a href="tel:{{ $contact->number }}" class="contact-link">
                                {{ $contact->number }}
                            </a>
                        </td>
                      <td>{{ $contact->website }}</td>
                        <td class="col-message">
                            <div class="message-preview" title="{{ $contact->message }}">
                                {{ Str::limit($contact->message, 60) }}
                            </div>
                        </td>
                        <td class="col-date">
                            <span class="date-text">{{ $contact->created_at->format('d M Y') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <p>No contact leads found</p>
                                <span>New inquiries will appear here</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="mobile-cards" id="mobileCards">
            @forelse($contacts as $contact)
            <div class="contact-card" 
                 data-date="{{ $contact->created_at->toDateString() }}" 
                 data-name="{{ strtolower($contact->name) }}" 
                 data-number="{{ $contact->number }}" 
                 data-website="{{ strtolower($contact->website) }}" 
                 data-message="{{ strtolower($contact->message) }}">
                <div class="card-header">
                    <div class="avatar-large" style="background-color: {{ '#' . substr(md5($contact->name), 0, 6) }}">
                        {{ strtoupper(substr($contact->name, 0, 2)) }}
                    </div>
                    <div class="card-info">
                        <h3>{{ $contact->name }}</h3>
                        <span class="card-id">ID #{{ $contact->id }}</span>
                    </div>
                    <div class="card-date">
                        {{ $contact->created_at->format('d M Y') }}
                    </div>
                </div>
                <div class="card-details">
                    <div class="detail-row">
                        <span class="detail-label">Phone</span>
                        <a href="tel:{{ $contact->number }}" class="detail-value">{{ $contact->number }}</a>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Website</span>
                        @if($contact->website)
                            <a href="{{ $contact->website }}" target="_blank" class="detail-value">{{ parse_url($contact->website, PHP_URL_HOST) ?: $contact->website }}</a>
                        @else
                            <span class="detail-value empty">Not provided</span>
                        @endif
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Message</span>
                        <p class="message-text">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-card">
                <div class="empty-icon">📭</div>
                <p>No contact leads found</p>
                <span>New inquiries will appear here</span>
            </div>
            @endforelse
        </div>

        {{-- Results Counter --}}
        <div class="results-footer">
            Showing <span id="resultCount">{{ $contacts->count() }}</span> leads
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .contact-dashboard {
        background: #f8f9fc;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', 'Roboto', sans-serif;
        padding: 28px 32px;
        margin-left: 260px;
    }

    @media (max-width: 768px) {
        .contact-dashboard {
            margin-left: 0;
            padding: 20px;
        }
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header Styles */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .header-left {
        flex: 1;
    }

    .title-section {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .title-icon {
        font-size: 32px;
    }

    .title-section h1 {
        font-size: 28px;
        font-weight: 600;
        color: #1a1f36;
        letter-spacing: -0.3px;
    }

    .subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-left: 44px;
    }

    .header-right {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .stats-card {
        background: white;
        padding: 8px 20px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: baseline;
        gap: 8px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .stats-number {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .stats-label {
        font-size: 13px;
        color: #6b7280;
    }

    .btn-refresh {
        background: white;
        border: 1px solid #e5e7eb;
        padding: 8px 18px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #374151;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-refresh:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        transform: translateY(-1px);
    }

    /* Filter Section */
    .filter-section {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .search-wrapper {
        flex: 1;
        position: relative;
        min-width: 240px;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .search-input {
        width: 100%;
        padding: 11px 16px 11px 42px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        color: #1f2937;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .filter-select {
        padding: 11px 20px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        color: #1f2937;
        font-size: 14px;
        cursor: pointer;
        font-family: inherit;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
    }

    /* Table Styles */
    .table-wrapper {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow-x: auto;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .contact-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .contact-table th {
        text-align: left;
        padding: 16px 20px;
        background: #f9fafb;
        color: #4b5563;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 1px solid #e5e7eb;
    }

    .contact-table td {
        padding: 14px 20px;
        color: #1f2937;
        border-bottom: 1px solid #f3f4f6;
    }

    .contact-row {
        transition: background 0.2s;
    }

    .contact-row:hover {
        background: #fafbff;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 13px;
        color: white;
        text-transform: uppercase;
    }

    .user-name {
        font-weight: 500;
        color: #111827;
    }

    .contact-link {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.2s;
    }

    .contact-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    .website-link {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
    }

    .message-preview {
        max-width: 280px;
        line-height: 1.4;
        color: #4b5563;
    }

    .date-text {
        color: #6b7280;
        font-size: 13px;
    }

    .empty-value {
        color: #9ca3af;
    }

    .empty-row td {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: #6b7280;
    }

    .empty-icon {
        font-size: 48px;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 16px;
        font-weight: 500;
        color: #374151;
    }

    .empty-state span {
        font-size: 13px;
    }

    /* Mobile Cards */
    .mobile-cards {
        display: none;
        gap: 16px;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .contact-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 18px;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .contact-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .avatar-large {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
        color: white;
    }

    .card-info {
        flex: 1;
    }

    .card-info h3 {
        font-size: 17px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
    }

    .card-id {
        font-size: 11px;
        color: #6b7280;
    }

    .card-date {
        font-size: 12px;
        color: #6b7280;
        background: #f3f4f6;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .card-details {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .detail-row {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .detail-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
    }

    .detail-value {
        font-size: 14px;
        color: #1f2937;
        word-break: break-word;
        text-decoration: none;
    }

    .detail-value.empty {
        color: #9ca3af;
    }

    .message-text {
        line-height: 1.5;
        background: #f9fafb;
        padding: 10px 12px;
        border-radius: 10px;
        margin-top: 4px;
        font-size: 13px;
        color: #374151;
    }

    .empty-card {
        text-align: center;
        padding: 48px 20px;
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        color: #6b7280;
    }

    .results-footer {
        text-align: center;
        padding: 16px;
        color: #6b7280;
        font-size: 13px;
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    /* Responsive Breakpoints */
    @media (max-width: 900px) {
        .table-wrapper {
            display: none;
        }
        .mobile-cards {
            display: flex;
        }
        .title-section h1 {
            font-size: 24px;
        }
        .subtitle {
            margin-left: 44px;
            font-size: 12px;
        }
    }

    @media (max-width: 600px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .filter-section {
            flex-direction: column;
        }
        .filter-select {
            width: 100%;
        }
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .card-date {
            align-self: flex-start;
        }
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    // Live search and filtering
    (function() {
        const searchInput = document.getElementById('searchInput');
        const dateFilter = document.getElementById('dateFilter');
        const tableRows = document.querySelectorAll('#tableBody .contact-row');
        const mobileCards = document.querySelectorAll('.contact-card');
        const resultCountSpan = document.getElementById('resultCount');

        function filterItems() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const dateValue = dateFilter.value;
            const today = new Date().toISOString().slice(0,10);
            const weekAgo = new Date();
            weekAgo.setDate(weekAgo.getDate() - 7);
            const monthAgo = new Date();
            monthAgo.setMonth(monthAgo.getMonth() - 1);

            let visibleCount = 0;

            // Filter table rows
            tableRows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const number = row.getAttribute('data-number') || '';
                const website = row.getAttribute('data-website') || '';
                const message = row.getAttribute('data-message') || '';
                const rowDate = row.getAttribute('data-date');
                
                let matchesSearch = true;
                if (searchTerm) {
                    matchesSearch = name.includes(searchTerm) || 
                                   number.includes(searchTerm) || 
                                   website.includes(searchTerm) || 
                                   message.includes(searchTerm);
                }
                
                let matchesDate = true;
                if (dateValue !== 'all' && rowDate) {
                    if (dateValue === 'today') {
                        matchesDate = rowDate === today;
                    } else if (dateValue === 'week') {
                        const rowDateObj = new Date(rowDate);
                        matchesDate = rowDateObj >= weekAgo;
                    } else if (dateValue === 'month') {
                        const rowDateObj = new Date(rowDate);
                        matchesDate = rowDateObj >= monthAgo;
                    }
                }
                
                if (matchesSearch && matchesDate) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Filter mobile cards
            mobileCards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const number = card.getAttribute('data-number') || '';
                const website = card.getAttribute('data-website') || '';
                const message = card.getAttribute('data-message') || '';
                const cardDate = card.getAttribute('data-date');
                
                let matchesSearch = true;
                if (searchTerm) {
                    matchesSearch = name.includes(searchTerm) || 
                                   number.includes(searchTerm) || 
                                   website.includes(searchTerm) || 
                                   message.includes(searchTerm);
                }
                
                let matchesDate = true;
                if (dateValue !== 'all' && cardDate) {
                    if (dateValue === 'today') {
                        matchesDate = cardDate === today;
                    } else if (dateValue === 'week') {
                        const cardDateObj = new Date(cardDate);
                        matchesDate = cardDateObj >= weekAgo;
                    } else if (dateValue === 'month') {
                        const cardDateObj = new Date(cardDate);
                        matchesDate = cardDateObj >= monthAgo;
                    }
                }
                
                if (matchesSearch && matchesDate) {
                    card.style.display = '';
                    if (window.innerWidth <= 900) visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update result count
            if (window.innerWidth > 900) {
                resultCountSpan.innerText = visibleCount;
            } else {
                const visibleCards = document.querySelectorAll('.contact-card[style=""]:not([style*="display: none"])');
                resultCountSpan.innerText = visibleCards.length;
            }
        }
        
        if (searchInput) searchInput.addEventListener('input', filterItems);
        if (dateFilter) dateFilter.addEventListener('change', filterItems);
        window.addEventListener('resize', () => filterItems());
        filterItems();
    })();
</script>

@endsection