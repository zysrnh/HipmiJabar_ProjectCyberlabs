{{-- resources/views/admin/info-admin.blade.php --}}
@extends('admin.layouts.admin-layout')

@section('title', 'Info Admin')
@section('page-title', 'Info Admin')

@php
    $activeMenu = 'info-admin';
@endphp

@push('styles')
<style>
    .page-header {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0a2540;
        margin-bottom: 0.5rem;
    }

    .page-desc {
        color: #6b7280;
        font-size: 0.9375rem;
    }

    .btn-primary {
        background: #0a2540;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-primary:hover {
        background: #ffd700;
        color: #0a2540;
    }

    .btn-primary svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .admin-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0a2540;
    }

    .search-box {
        position: relative;
    }

    .search-input {
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.875rem;
        width: 300px;
        font-family: 'Montserrat', sans-serif;
    }

    .search-input:focus {
        outline: none;
        border-color: #ffd700;
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        stroke: #6b7280;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead {
        background: #f9fafb;
    }

    .admin-table th {
        padding: 1rem 2rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-table td {
        padding: 1.25rem 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .admin-table tbody tr {
        transition: background 0.2s;
    }

    .admin-table tbody tr:hover {
        background: #f9fafb;
    }

    .admin-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .admin-avatar-table {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #ffd700;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0a2540;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .admin-details {
        flex: 1;
        min-width: 0;
    }

    .admin-name-table {
        font-weight: 600;
        color: #0a2540;
        font-size: 0.9375rem;
        margin-bottom: 0.25rem;
    }

    .admin-email-table {
        font-size: 0.8125rem;
        color: #6b7280;
    }

    .badge {
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .badge-bpc {
        background: #ffd700;
        color: #0a2540;
    }

    .badge-bpd {
        background: #3b82f6;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        padding: 0.5rem 0.875rem;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #374151;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .btn-edit:hover {
        background: #e5e7eb;
    }

    .btn-delete {
        padding: 0.5rem 0.875rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #dc2626;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .btn-delete:hover {
        background: #fee2e2;
    }

    .pagination {
        padding: 1.5rem 2rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination-info {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .pagination-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.5rem 1rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .pagination-btn:hover:not(:disabled) {
        background: #f3f4f6;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-btn.active {
        background: #0a2540;
        color: white;
        border-color: #0a2540;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .page-desc {
            font-size: 0.875rem;
        }

        .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .table-header {
            flex-direction: column;
            gap: 1rem;
            padding: 1.25rem;
            align-items: flex-start;
        }

        .table-title {
            font-size: 1rem;
        }

        .search-box {
            width: 100%;
        }

        .search-input {
            width: 100%;
        }

        .admin-table-container {
            overflow-x: auto;
        }

        .admin-table {
            min-width: 700px;
        }

        .admin-table th,
        .admin-table td {
            padding: 0.875rem 1rem;
        }

        .admin-table th {
            font-size: 0.6875rem;
        }

        .admin-avatar-table {
            width: 40px;
            height: 40px;
            font-size: 0.875rem;
        }

        .admin-name-table {
            font-size: 0.875rem;
        }

        .admin-email-table {
            font-size: 0.75rem;
        }

        .badge {
            padding: 0.3rem 0.65rem;
            font-size: 0.6875rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.375rem;
        }

        .btn-edit,
        .btn-delete {
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            width: 100%;
        }

        .pagination {
            flex-direction: column;
            gap: 1rem;
            padding: 1.25rem;
            align-items: flex-start;
        }

        .pagination-info {
            font-size: 0.8125rem;
        }

        .pagination-buttons {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Manajemen Admin</h1>
        <p class="page-desc">Kelola seluruh akun administrator HIPMI Jawa Barat</p>
    </div>
    <a href="{{ route('admin.create-admin') }}" class="btn-primary">
        <svg viewBox="0 0 24 24">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Admin Baru
    </a>
</div>

<div class="admin-table-container">
    <div class="table-header">
        <h3 class="table-title">Daftar Admin ({{ $admins->total() }})</h3>
        <div class="search-box">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" class="search-input" placeholder="Cari admin...">
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Admin</th>
                <th>Username</th>
                <th>Kategori</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $adminItem)
            <tr>
                <td>
                    <div class="admin-cell">
                        <div class="admin-avatar-table">{{ strtoupper(substr($adminItem->name, 0, 2)) }}</div>
                        <div class="admin-details">
                            <div class="admin-name-table">{{ $adminItem->name }}</div>
                            <div class="admin-email-table">{{ $adminItem->email }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $adminItem->username }}</td>
                <td>
                    <span class="badge badge-{{ $adminItem->category }}">
                        {{ strtoupper($adminItem->category) }}
                    </span>
                </td>
                <td>{{ $adminItem->created_at->format('d M Y') }}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <div class="pagination-info">
            Menampilkan {{ $admins->firstItem() }} - {{ $admins->lastItem() }} dari {{ $admins->total() }} admin
        </div>
        <div class="pagination-buttons">
            <button class="pagination-btn" {{ $admins->onFirstPage() ? 'disabled' : '' }}>
                Previous
            </button>
            
            @foreach($admins->getUrlRange(1, $admins->lastPage()) as $page => $url)
                <button class="pagination-btn {{ $page == $admins->currentPage() ? 'active' : '' }}">
                    {{ $page }}
                </button>
            @endforeach
            
            <button class="pagination-btn" {{ !$admins->hasMorePages() ? 'disabled' : '' }}>
                Next
            </button>
        </div>
    </div>
</div>
@endsection