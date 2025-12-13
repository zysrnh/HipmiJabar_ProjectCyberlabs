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
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .table-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0a2540;
    }

    .btn-primary {
        background: #ffd700;
        color: #0a2540;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background: #e6c200;
        transform: translateY(-1px);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #f9fafb;
        padding: 0.875rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .data-table tr:hover {
        background: #f9fafb;
    }

    .katalog-logo {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-edit {
        background: #dbeafe;
        color: #1e40af;
    }

    .btn-edit:hover {
        background: #bfdbfe;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-delete:hover {
        background: #fecaca;
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #059669;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
        gap: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6b7280;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        stroke: #d1d5db;
    }
</style>
@endpush

@section('content')
<div class="katalog-table-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-header">
        <h3>Daftar E-Katalog Perusahaan</h3>
        <a href="{{ route('admin.katalog.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2">
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
                    <th>Nama Perusahaan</th>
                    <th>Bidang</th>
                    <th>Kontak</th>
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
                        <div style="font-weight: 600; color: #111827;">{{ $katalog->company_name }}</div>
                    </td>
                    <td>{{ $katalog->business_field }}</td>
                    <td>
                        <div>{{ $katalog->phone }}</div>
                        <div style="font-size: 0.75rem; color: #6b7280;">{{ $katalog->email }}</div>
                    </td>
                    <td>
                        <span class="status-badge {{ $katalog->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $katalog->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.katalog.edit', $katalog) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.katalog.destroy', $katalog) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $katalogs->links() }}
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <line x1="9" y1="9" x2="15" y2="9"/>
                <line x1="9" y1="15" x2="15" y2="15"/>
            </svg>
            <h3>Belum ada data katalog</h3>
            <p>Klik tombol "Tambah Katalog" untuk menambahkan data pertama</p>
        </div>
    @endif
</div>
@endsection