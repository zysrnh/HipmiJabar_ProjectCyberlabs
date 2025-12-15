@extends('admin.layouts.admin-layout')

@section('title', 'Kelola Anggota')
@section('page-title', 'Kelola Anggota')


@push('styles')
    <style>
        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start;
            gap: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .stat-title {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 20px;
            height: 20px;
            stroke-width: 2;
        }

        .stat-icon.total {
            background: #dbeafe;
            color: #1e40af;
        }

        .stat-icon.pending {
            background: #fef3c7;
            color: #d97706;
        }

        .stat-icon.approved {
            background: #d1fae5;
            color: #059669;
        }

        .stat-icon.rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #0a2540;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .filter-tab:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .filter-tab.active {
            background: #0a2540;
            color: white;
            border-color: #0a2540;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .table th {
            padding: 1rem;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .btn-icon svg {
            width: 16px;
            height: 16px;
            stroke: #6b7280;
            fill: none;
            stroke-width: 2;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 1.5rem;
            gap: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state svg {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            stroke: #d1d5db;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>Kelola Anggota</h1>
        <p>Kelola dan verifikasi pendaftaran anggota baru HIPMI Jawa Barat</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Statistics --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Pendaftar</span>
                <div class="stat-icon total">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Menunggu Verifikasi</span>
                <div class="stat-icon pending">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $stats['pending'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Disetujui</span>
                <div class="stat-icon approved">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $stats['approved'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Ditolak</span>
                <div class="stat-icon rejected">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $stats['rejected'] }}</div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="filter-tabs">
        <a href="{{ route('admin.anggota.index', ['status' => 'all']) }}"
            class="filter-tab {{ $status === 'all' ? 'active' : '' }}">
            Semua ({{ $stats['total'] }})
        </a>
        <a href="{{ route('admin.anggota.index', ['status' => 'pending']) }}"
            class="filter-tab {{ $status === 'pending' ? 'active' : '' }}">
            Pending ({{ $stats['pending'] }})
        </a>
        <a href="{{ route('admin.anggota.index', ['status' => 'approved']) }}"
            class="filter-tab {{ $status === 'approved' ? 'active' : '' }}">
            Disetujui ({{ $stats['approved'] }})
        </a>
        <a href="{{ route('admin.anggota.index', ['status' => 'rejected']) }}"
            class="filter-tab {{ $status === 'rejected' ? 'active' : '' }}">
            Ditolak ({{ $stats['rejected'] }})
        </a>
    </div>

    {{-- Table --}}
    <div class="table-container">
        @if($anggota->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Perusahaan</th>
                        <th>Domisili</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $index => $item)
                        <tr>
                            <td>{{ $anggota->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $item->nama_usaha }}</strong>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nama_usaha_perusahaan }}</td>
                            <td>{{ $item->domisili }}</td>
                            <td>
                                <span class="status-badge {{ $item->status }}">
                                    @if($item->status === 'pending')
                                        <svg viewBox="0 0 8 8" width="8" height="8" fill="currentColor">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Menunggu
                                    @elseif($item->status === 'approved')
                                        <svg viewBox="0 0 8 8" width="8" height="8" fill="currentColor">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Disetujui
                                    @else
                                        <svg viewBox="0 0 8 8" width="8" height="8" fill="currentColor">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Ditolak
                                    @endif
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.anggota.show', $item) }}" class="btn-icon" title="Lihat Detail">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="pagination">
                {{ $anggota->links() }}
            </div>
        @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <h3>Tidak ada data</h3>
                <p>Belum ada pendaftar untuk kategori ini.</p>
            </div>
        @endif
    </div>
@endsection