@extends('admin.layouts.admin-layout')

@section('title', 'Kelola E-Katalog')
@section('page-title', 'E-Katalog')

@php
    $activeMenu = 'katalog';
@endphp

@push('styles')
<style>
    .katalog-table-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-header h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0a2540;
        letter-spacing: -0.025em;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        transition: width 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .stat-card.active {
        background: white;
        border-color: currentColor;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .stat-card.active::before {
        width: 100%;
        opacity: 0.05;
    }

    .stat-card.all { color: #3b82f6; }
    .stat-card.all::before { background: #3b82f6; }

    .stat-card.pending { color: #f59e0b; }
    .stat-card.pending::before { background: #f59e0b; }

    .stat-card.approved { color: #10b981; }
    .stat-card.approved::before { background: #10b981; }

    .stat-card.rejected { color: #ef4444; }
    .stat-card.rejected::before { background: #ef4444; }

    .stat-label {
        font-size: 0.75rem;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: #0a2540;
        letter-spacing: -0.05em;
        line-height: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #ffd700 0%, #f5c400 100%);
        color: #0a2540;
        padding: 0.75rem 1.75rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        letter-spacing: 0.025em;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
    }

    .btn-primary svg {
        transition: transform 0.2s ease;
    }

    .btn-primary:hover svg {
        transform: rotate(90deg);
    }

    /* Table Styles */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background: #f8fafc;
        padding: 1rem 0.875rem;
        text-align: left;
        font-weight: 700;
        font-size: 0.75rem;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }
    
    .data-table th:nth-child(1) { width: 80px; } /* Logo */
    .data-table th:nth-child(2) { width: 180px; } /* Perusahaan */
    .data-table th:nth-child(3) { width: 140px; } /* Bidang Usaha */
    .data-table th:nth-child(4) { width: 160px; } /* Kontak */
    .data-table th:nth-child(5) { width: 180px; } /* Dibuat Oleh */
    .data-table th:nth-child(6) { width: 120px; } /* Bidang */
    .data-table th:nth-child(7) { width: 110px; } /* Status */
    .data-table th:nth-child(8) { width: auto; } /* Aksi */

    .data-table th:first-child {
        border-top-left-radius: 10px;
    }

    .data-table th:last-child {
        border-top-right-radius: 10px;
    }

    .data-table td {
        padding: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.8125rem;
        color: #334155;
        vertical-align: middle;
    }

    .data-table tbody tr {
        transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: #f8fafc;
    }

    .katalog-logo {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #f1f5f9;
    }

    /* Status & Source Badges */
    .status-badge {
        padding: 0.3125rem 0.75rem;
        border-radius: 6px;
        font-size: 0.6875rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        letter-spacing: 0.025em;
        text-transform: uppercase;
    }

    .status-pending { 
        background: #fef3c7; 
        color: #92400e;
        border: 1px solid #fde68a;
    }
    
    .status-approved { 
        background: #d1fae5; 
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .status-rejected { 
        background: #fee2e2; 
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .source-badge {
        padding: 0.1875rem 0.5rem;
        border-radius: 5px;
        font-size: 0.625rem;
        font-weight: 700;
        display: inline-block;
        margin-top: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .source-admin { 
        background: #dbeafe; 
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }
    
    .source-anggota { 
        background: #fef3c7; 
        color: #92400e;
        border: 1px solid #fde68a;
    }

    /* Creator Info */
    .creator-info {
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .creator-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6875rem;
        font-weight: 700;
        flex-shrink: 0;
        border: 2px solid;
    }

    .creator-avatar.anggota {
        background: #f3f4f6;
        color: #6b7280;
        border-color: #e5e7eb;
    }

    .creator-avatar.admin {
        background: linear-gradient(135deg, #ffd700 0%, #f5c400 100%);
        color: #0a2540;
        border-color: #ffd700;
    }

    .creator-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .creator-details {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .creator-name {
        font-weight: 700;
        color: #0f172a;
        font-size: 0.8125rem;
        line-height: 1.2;
    }

    .creator-meta {
        color: #64748b;
        font-size: 0.6875rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        line-height: 1.2;
    }

    .creator-meta .separator {
        color: #cbd5e1;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.125rem 0.375rem;
        background: #f1f5f9;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 600;
        color: #475569;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.375rem;
        flex-wrap: wrap;
    }

    .btn-edit, .btn-delete, .btn-approve, .btn-reject, .btn-view {
        padding: 0.4375rem 0.875rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 0.6875rem;
        font-weight: 700;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .btn-edit { 
        background: #dbeafe; 
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }
    .btn-edit:hover { 
        background: #bfdbfe;
        transform: translateY(-1px);
    }

    .btn-delete { 
        background: #fee2e2; 
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .btn-delete:hover { 
        background: #fecaca;
        transform: translateY(-1px);
    }

    .btn-approve { 
        background: #d1fae5; 
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    .btn-approve:hover { 
        background: #a7f3d0;
        transform: translateY(-1px);
    }

    .btn-reject { 
        background: #fee2e2; 
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .btn-reject:hover { 
        background: #fecaca;
        transform: translateY(-1px);
    }

    .btn-view { 
        background: #e0e7ff; 
        color: #3730a3;
        border: 1px solid #c7d2fe;
    }
    .btn-view:hover { 
        background: #c7d2fe;
        transform: translateY(-1px);
    }

    /* Alert */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        stroke: #cbd5e1;
        stroke-width: 1.5;
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #94a3b8;
        font-size: 0.9375rem;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
    }

    .modal-close {
        background: #f1f5f9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 1.25rem;
        cursor: pointer;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 0.625rem;
        font-size: 0.875rem;
        color: #334155;
    }

    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        resize: vertical;
        min-height: 120px;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #ffd700;
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    }

    .modal-actions {
        display: flex;
        gap: 0.75rem;
    }

    .modal-actions button {
        flex: 1;
        padding: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="katalog-table-container">
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <a href="{{ route('admin.katalog.index', ['status' => 'all']) }}" style="text-decoration: none;">
            <div class="stat-card all {{ $status === 'all' ? 'active' : '' }}">
                <div class="stat-label">Total Katalog</div>
                <div class="stat-value">{{ $stats['total'] }}</div>
            </div>
        </a>
        <a href="{{ route('admin.katalog.index', ['status' => 'pending']) }}" style="text-decoration: none;">
            <div class="stat-card pending {{ $status === 'pending' ? 'active' : '' }}">
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
            </div>
        </a>
        <a href="{{ route('admin.katalog.index', ['status' => 'approved']) }}" style="text-decoration: none;">
            <div class="stat-card approved {{ $status === 'approved' ? 'active' : '' }}">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $stats['approved'] }}</div>
            </div>
        </a>
        <a href="{{ route('admin.katalog.index', ['status' => 'rejected']) }}" style="text-decoration: none;">
            <div class="stat-card rejected {{ $status === 'rejected' ? 'active' : '' }}">
                <div class="stat-label">Ditolak</div>
                <div class="stat-value">{{ $stats['rejected'] }}</div>
            </div>
        </a>
    </div>

    <div class="table-header">
        <h3>Daftar E-Katalog Perusahaan</h3>
        <a href="{{ route('admin.katalog.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Katalog
        </a>
    </div>

    @if($katalogs->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Perusahaan</th>
                    <th>Bidang Usaha</th>
                    <th>Kontak</th>
                    <th>Dibuat Oleh</th>
                    <th>Bidang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($katalogs as $katalog)
                <tr>
                    <td>
                        <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}" class="katalog-logo">
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; font-size: 0.8125rem;">
                            {{ $katalog->company_name }}
                        </div>
                        @if($katalog->isSubmittedByAnggota())
                            <span class="source-badge source-anggota">Anggota</span>
                        @else
                            <span class="source-badge source-admin">Admin</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight: 600; color: #475569; font-size: 0.8125rem;">
                            {{ $katalog->business_field }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #334155; margin-bottom: 0.1875rem; font-size: 0.8125rem;">
                            {{ $katalog->phone }}
                        </div>
                        <div style="font-size: 0.6875rem; color: #64748b;">
                            {{ $katalog->email }}
                        </div>
                    </td>
                    <td>
                        @if($katalog->isSubmittedByAnggota() && $katalog->anggota)
                            {{-- Katalog dari Anggota --}}
                            <div class="creator-info">
                                <div class="creator-avatar anggota">
                                    {{ strtoupper(substr($katalog->anggota->nama_usaha, 0, 2)) }}
                                </div>
                                <div class="creator-details">
                                    <div class="creator-name">{{ $katalog->anggota->nama_usaha }}</div>
                                    <div class="creator-meta">{{ $katalog->anggota->domisili }}</div>
                                </div>
                            </div>
                        @elseif($katalog->admin)
                            {{-- Katalog dari Admin --}}
                            <div class="creator-info">
                                <div class="creator-avatar admin">
                                    @if($katalog->admin->photo_url)
                                        <img src="{{ $katalog->admin->photo_url }}" alt="{{ $katalog->admin->username }}">
                                    @else
                                        {{ $katalog->admin->initials }}
                                    @endif
                                </div>
                                <div class="creator-details">
                                    <div class="creator-name">{{ $katalog->admin->username }}</div>
                                    <div class="creator-meta">
                                        @if($katalog->admin->isSuperAdmin())
                                            <span class="role-badge">Super Admin</span>
                                        @elseif($katalog->admin->isBPD())
                                            <span class="role-badge">BPD</span>
                                        @elseif($katalog->admin->isBPC())
                                            <span class="role-badge">BPC</span>
                                        @endif
                                        
                                        @if($katalog->admin->domisili)
                                            <span class="separator">•</span>
                                            {{ $katalog->admin->domisili }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Fallback --}}
                            <div class="creator-info">
                                <div class="creator-avatar" style="background: #e2e8f0; color: #64748b; border-color: #cbd5e1;">
                                    A
                                </div>
                                <div class="creator-details">
                                    <div class="creator-name" style="color: #94a3b8;">Admin</div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($katalog->admin && $katalog->admin->bidang)
                            <div style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 1px solid #fbbf24; border-radius: 6px; font-weight: 700; color: #78350f; font-size: 0.75rem;">
                                {{ $katalog->admin->bidang_name }}
                            </div>
                        @else
                            <span style="color: #cbd5e1; font-size: 0.75rem;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $katalog->status }}">
                            @if($katalog->status === 'pending')
                                Pending
                            @elseif($katalog->status === 'approved')
                                Approved
                            @else
                                Rejected
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            @if($katalog->status === 'pending')
                                {{-- Tombol Approve/Reject hanya untuk katalog pending dari anggota --}}
                                @if($katalog->isSubmittedByAnggota())
                                    <form action="{{ route('admin.katalog.approve', $katalog) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-approve" onclick="return confirm('Setujui katalog ini?')">
                                            Approve
                                        </button>
                                    </form>

                                    <button type="button" class="btn-reject" onclick="openRejectModal({{ $katalog->id }})">
                                        Reject
                                    </button>
                                @endif
                            @endif

                            {{-- Tombol Lihat - untuk semua katalog --}}
                            <a href="{{ route('e-katalog.detail', $katalog) }}" target="_blank" class="btn-view">Lihat</a>

                            @php
                                $currentAdmin = Auth::guard('admin')->user();
                                $canManage = false;
                                
                                // Super Admin bisa manage semua
                                if ($currentAdmin->isSuperAdmin()) {
                                    $canManage = true;
                                }
                                // Katalog dari anggota tidak bisa diedit
                                elseif (!$katalog->isSubmittedByAnggota()) {
                                    // Admin BPD hanya bisa manage katalog dari bidangnya sendiri
                                    if ($currentAdmin->isBPD()) {
                                        if ($katalog->admin && $katalog->admin->bidang === $currentAdmin->bidang) {
                                            $canManage = true;
                                        }
                                    }
                                    // BPC bisa manage katalog yang dia buat sendiri
                                    elseif ($currentAdmin->isBPC()) {
                                        if ($katalog->approved_by === $currentAdmin->id) {
                                            $canManage = true;
                                        }
                                    }
                                }
                            @endphp

                            {{-- Tombol Edit - hanya jika punya permission --}}
                            @if($canManage)
                                <a href="{{ route('admin.katalog.edit', $katalog) }}" class="btn-edit">Edit</a>
                            @endif

                            {{-- Tombol Hapus --}}
                            @if($katalog->isSubmittedByAnggota())
                                {{-- Katalog anggota: hanya bisa dihapus jika belum approved --}}
                                @if($katalog->status !== 'approved')
                                    <form action="{{ route('admin.katalog.destroy', $katalog) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                @endif
                            @else
                                {{-- Katalog admin: hanya bisa dihapus jika punya permission --}}
                                @if($canManage)
                                    <form action="{{ route('admin.katalog.destroy', $katalog) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $katalogs->appends(['status' => $status])->links() }}
        </div>
    @else
        <div class="empty-state">
            <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <line x1="9" y1="9" x2="15" y2="9"/>
                <line x1="9" y1="15" x2="15" y2="15"/>
            </svg>
            <h3>Belum ada data katalog</h3>
            <p>Klik tombol "Tambah Katalog" untuk menambahkan data pertama</p>
        </div>
    @endif
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tolak Katalog</h3>
            <button class="modal-close" onclick="closeRejectModal()">&times;</button>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="form-group">
                <label>Alasan Penolakan</label>
                <textarea name="alasan_penolakan" required placeholder="Jelaskan alasan penolakan katalog ini..."></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" onclick="closeRejectModal()" class="btn-edit">Batal</button>
                <button type="submit" class="btn-reject">Tolak Katalog</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(katalogId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/katalog/${katalogId}/reject`;
    modal.classList.add('show');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.remove('show');
}

window.onclick = function(event) {
    const modal = document.getElementById('rejectModal');
    if (event.target === modal) {
        closeRejectModal();
    }
}
</script>
@endsection