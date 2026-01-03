@extends('layouts.app')

@section('title', 'Katalog Saya - HIPMI Jawa Barat')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

    * {
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    .katalog-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-header {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header h1 {
        font-size: 1.75rem;
        color: #0a2540;
        margin: 0 0 0.5rem 0;
        font-weight: 700;
    }

    .page-header p {
        color: #6b7280;
        font-size: 0.9375rem;
        margin: 0;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.9375rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1e40af;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #0a2540;
        margin: 0 0 0.5rem 0;
    }

    .stat-card .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 600;
    }

    .stat-card.pending {
        border-left: 4px solid #f59e0b;
    }

    .stat-card.approved {
        border-left: 4px solid #10b981;
    }

    .stat-card.rejected {
        border-left: 4px solid #ef4444;
    }

    .katalog-list {
        display: grid;
        gap: 1.5rem;
    }

    .katalog-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }

    .katalog-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .katalog-content {
        display: flex;
        gap: 1.5rem;
        align-items: start;
    }

    .katalog-logo {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        flex-shrink: 0;
    }

    .katalog-info {
        flex: 1;
    }

    .katalog-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
        gap: 1rem;
    }

    .katalog-title {
        margin: 0 0 0.25rem 0;
        font-size: 1.125rem;
        font-weight: 700;
        color: #0a2540;
    }

    .katalog-field {
        margin: 0;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #d97706;
    }

    .status-badge.approved {
        background: #d1fae5;
        color: #059669;
    }

    .status-badge.rejected {
        background: #fee2e2;
        color: #dc2626;
    }

    .katalog-description {
        color: #4b5563;
        font-size: 0.875rem;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .rejection-box {
        background: #fee2e2;
        padding: 0.875rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        border-left: 4px solid #ef4444;
    }

    .rejection-box strong {
        color: #991b1b;
        font-size: 0.875rem;
    }

    .rejection-box p {
        margin: 0.25rem 0 0 0;
        color: #991b1b;
        font-size: 0.875rem;
    }

    .katalog-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-size: 0.9375rem;
        font-weight: 500;
    }

    .alert-success {
        background: #d1fae5;
        color: #059669;
        border: 1px solid #6ee7b7;
    }

    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }

    .alert-warning {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fbbf24;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        stroke: #d1d5db;
    }

    .empty-state h3 {
        margin: 0 0 0.5rem 0;
        color: #6b7280;
        font-size: 1.25rem;
    }

    .empty-state p {
        margin: 0 0 1.5rem 0;
        color: #9ca3af;
        font-size: 0.9375rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .katalog-container {
            padding: 15px;
        }

        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .katalog-content {
            flex-direction: column;
        }

        .katalog-logo {
            width: 100%;
            height: 200px;
        }

        .katalog-header {
            flex-direction: column;
        }

        .katalog-actions {
            width: 100%;
        }

        .btn {
            flex: 1;
        }
    }
</style>

<div class="katalog-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    <div class="page-header">
        <div class="page-header-content">
            <div>
                <h1>Katalog Perusahaan Saya</h1>
                <p>Kelola katalog perusahaan yang akan ditampilkan di E-Katalog HIPMI Jawa Barat</p>
            </div>
            @if(Auth::guard('anggota')->user()->status === 'approved')
            <a href="{{ route('profile-anggota.katalog.create') }}" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Katalog
            </a>
            @endif
        </div>
    </div>

    @if(Auth::guard('anggota')->user()->status !== 'approved')
    <div class="alert alert-warning">
        ⚠️ Anda harus terverifikasi terlebih dahulu untuk menambahkan katalog perusahaan.
    </div>
    @endif

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Katalog</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
        <div class="stat-card approved">
            <div class="stat-number">{{ $stats['approved'] }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-number">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <!-- Katalog List -->
    @if($katalogs->count() > 0)
    <div class="katalog-list">
        @foreach($katalogs as $katalog)
        <div class="katalog-card">
            <div class="katalog-content">
                <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}" class="katalog-logo">
                
                <div class="katalog-info">
                    <div class="katalog-header">
                        <div>
                            <h3 class="katalog-title">{{ $katalog->company_name }}</h3>
                            <p class="katalog-field">{{ $katalog->business_field }}</p>
                        </div>
                        <span class="status-badge {{ $katalog->status }}">
                            @if($katalog->status === 'pending')
                                ⏳ Menunggu Verifikasi
                            @elseif($katalog->status === 'approved')
                                ✅ Disetujui
                            @else
                                ❌ Ditolak
                            @endif
                        </span>
                    </div>

                    <div class="katalog-description">
                        {{ Str::limit($katalog->description, 200) }}
                    </div>

                    @if($katalog->status === 'rejected' && $katalog->rejection_reason)
                    <div class="rejection-box">
                        <strong>Alasan Penolakan:</strong>
                        <p>{{ $katalog->rejection_reason }}</p>
                    </div>
                    @endif

                    <div class="katalog-actions">
                        @if($katalog->status === 'approved')
                            <a href="{{ route('e-katalog.detail', $katalog) }}" target="_blank" class="btn btn-primary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Lihat di E-Katalog
                            </a>
                        @endif

                        @if($katalog->canBeEdited())
                            <a href="{{ route('profile-anggota.katalog.edit', $katalog) }}" class="btn btn-success">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('profile-anggota.katalog.destroy', $katalog) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus katalog ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $katalogs->links() }}
    </div>

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
            <line x1="9" y1="9" x2="15" y2="9"/>
            <line x1="9" y1="15" x2="15" y2="15"/>
        </svg>
        <h3>Belum ada katalog</h3>
        <p>Tambahkan katalog perusahaan Anda untuk ditampilkan di E-Katalog HIPMI Jawa Barat</p>
        @if(Auth::guard('anggota')->user()->status === 'approved')
        <a href="{{ route('profile-anggota.katalog.create') }}" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Katalog Pertama
        </a>
        @endif
    </div>
    @endif
</div>
@endsection