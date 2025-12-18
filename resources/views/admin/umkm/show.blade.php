@extends('admin.layouts.admin-layout')

@section('title', 'Detail UMKM')
@section('page-title', 'Detail UMKM')

@section('content')
<div class="admin-container">
    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('admin.umkm.index') }}" class="btn-back">
            <svg viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Daftar UMKM
        </a>
    </div>

    {{-- Status Badge --}}
    <div class="status-banner status-{{ $umkm->status }}">
        <div class="status-icon">
            @if($umkm->status === 'pending')
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
            @elseif($umkm->status === 'approved')
            <svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            @else
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="15" y1="9" x2="9" y2="15" />
                <line x1="9" y1="9" x2="15" y2="15" />
            </svg>
            @endif
        </div>
        <div>
            <div class="status-title">
                @if($umkm->status === 'pending')
                Menunggu Verifikasi
                @elseif($umkm->status === 'approved')
                UMKM Disetujui
                @else
                UMKM Ditolak
                @endif
            </div>
            <div class="status-subtitle">
                Didaftarkan pada {{ $umkm->created_at->format('d F Y, H:i') }} WIB
            </div>
        </div>

        {{-- Action Buttons --}}
        @if($umkm->status === 'pending')
        <div class="status-actions">
            <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-approve" onclick="return confirm('Setujui UMKM ini?')">
                    <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Setujui
                </button>
            </form>
            <button type="button" class="btn-reject" onclick="showRejectModal()">
                <svg viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                Tolak
            </button>
        </div>
        @endif
    </div>

    {{-- Main Content Grid --}}
    <div class="detail-grid">
        {{-- Left Column --}}
        <div class="detail-column">
            {{-- Data Usaha --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg>
                    <h3>Data Usaha</h3>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Usaha / Brand</div>
                        <div class="detail-value">{{ $umkm->nama_usaha }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Bidang Usaha</div>
                        <div class="detail-value">
                            <span class="badge badge-info">{{ $umkm->bidang_usaha }}</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status Legalitas</div>
                        <div class="detail-value">{{ $umkm->status_legalitas }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Legalitas</div>
                        <div class="detail-value">{{ $umkm->jenis_legalitas ?? '-' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tahun Berdiri</div>
                        <div class="detail-value">{{ $umkm->tahun_berdiri }}</div>
                    </div>
                </div>
            </div>

            {{-- Data Pribadi --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <h3>Data Pribadi Pemilik</h3>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $umkm->nama_lengkap }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-value">{{ $umkm->jenis_kelamin }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Lahir</div>
                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($umkm->tanggal_lahir)->format('d F Y') }}
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">No HP / WhatsApp</div>
                        <div class="detail-value">
                            <a href="https://wa.me/{{ $umkm->nomor_hp }}" target="_blank"
                                class="link-primary">{{ $umkm->nomor_hp }}</a>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">
                            <a href="mailto:{{ $umkm->email }}" class="link-primary">{{ $umkm->email }}</a>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Alamat Domisili</div>
                        <div class="detail-value">{{ $umkm->alamat_domisili }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="detail-column">
            {{-- Data Lainnya --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <svg viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                    </svg>
                    <h3>Informasi Tambahan</h3>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Platform Digital</div>
                        <div class="detail-value">{{ $umkm->platform_digital }}</div>
                    </div>

                    @if($umkm->platform_digital === 'Ya' && $umkm->platform)
                    <div class="detail-item">
                        <div class="detail-label">Platform yang Digunakan</div>
                        <div class="detail-value">
                            <div class="badges-container">
                                @foreach($umkm->platform as $platform)
                                <span class="badge badge-primary">{{ $platform }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="detail-item">
                        <div class="detail-label">Pendapatan per Bulan</div>
                        <div class="detail-value">
                            <span class="badge badge-success">{{ $umkm->pendapatan }}</span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Sudah Menerima Pembiayaan</div>
                        <div class="detail-value">{{ $umkm->pembiayaan ?? 'Tidak' }}</div>
                    </div>

                    @if($umkm->pembiayaan === 'Ya')
                    <div class="detail-item">
                        <div class="detail-label">Sumber Pembiayaan</div>
                        <div class="detail-value">{{ $umkm->sumber_pembiayaan ?? '-' }}</div>
                    </div>
                    @endif

                    <div class="detail-item">
                        <div class="detail-label">Tujuan Program</div>
                        <div class="detail-value">{{ $umkm->tujuan }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Pelatihan yang Dibutuhkan</div>
                        <div class="detail-value">{{ $umkm->pelatihan }}</div>
                    </div>
                </div>
            </div>

            {{-- Rejection Reason if rejected --}}
            @if($umkm->status === 'rejected' && $umkm->rejection_reason)
            <div class="detail-card rejection-card">
                <div class="detail-card-header">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <h3>Alasan Penolakan</h3>
                </div>
                <div class="detail-card-body">
                    <p>{{ $umkm->rejection_reason }}</p>
                </div>
            </div>
            @endif

            {{-- Verification Info --}}
            @if($umkm->verified_at)
            <div class="detail-card">
                <div class="detail-card-header">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <h3>Informasi Verifikasi</h3>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Verifikasi</div>
                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($umkm->verified_at)->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Reject Modal --}}
<div class="modal" id="rejectModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tolak UMKM</h3>
            <button type="button" class="modal-close" onclick="hideRejectModal()">
                <svg viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Alasan Penolakan <span class="required">*</span></label>
                    <textarea name="rejection_reason" class="form-control" rows="4"
                        placeholder="Masukkan alasan penolakan..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="hideRejectModal()">Batal</button>
                <button type="submit" class="btn-danger">Tolak UMKM</button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .admin-container {
        padding: 2rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: #f3f4f6;
        color: #374151;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-back:hover {
        background: #e5e7eb;
    }

    .status-banner {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-left: 4px solid;
    }

    .status-banner.status-pending {
        border-left-color: #f59e0b;
        background: #fffbeb;
    }

    .status-banner.status-approved {
        border-left-color: #10b981;
        background: #f0fdf4;
    }

    .status-banner.status-rejected {
        border-left-color: #ef4444;
        background: #fef2f2;
    }

    .status-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .status-pending .status-icon {
        background: #fef3c7;
    }

    .status-approved .status-icon {
        background: #d1fae5;
    }

    .status-rejected .status-icon {
        background: #fee2e2;
    }

    .status-icon svg {
        width: 24px;
        height: 24px;
        stroke-width: 2;
        fill: none;
    }

    .status-pending .status-icon svg {
        stroke: #f59e0b;
    }

    .status-approved .status-icon svg {
        stroke: #10b981;
    }

    .status-rejected .status-icon svg {
        stroke: #ef4444;
    }

    .status-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0a2540;
        margin-bottom: 0.25rem;
    }

    .status-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .status-actions {
        margin-left: auto;
        display: flex;
        gap: 0.75rem;
    }

    .btn-approve,
    .btn-reject {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-approve {
        background: #10b981;
        color: white;
    }

    .btn-reject {
        background: #ef4444;
        color: white;
    }

    .btn-approve svg,
    .btn-reject svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .detail-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .detail-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .rejection-card {
        border: 2px solid #fecaca;
        background: #fef2f2;
    }

    .detail-card-header {
        padding: 1.25rem 1.5rem;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-card-header svg {
        width: 20px;
        height: 20px;
        stroke: #0a2540;
        fill: none;
        stroke-width: 2;
    }

    .detail-card-header h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #0a2540;
    }

    .detail-card-body {
        padding: 1.5rem;
    }

    .detail-item {
        margin-bottom: 1.25rem;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 0.9375rem;
        color: #0a2540;
        font-weight: 500;
    }

    .badges-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .badge {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-primary {
        background: #e0e7ff;
        color: #3730a3;
    }

    .link-primary {
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
    }

    .link-primary:hover {
        text-decoration: underline;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0a2540;
    }

    .modal-close {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #f3f4f6;
        border-radius: 6px;
        cursor: pointer;
    }

    .modal-close svg {
        width: 18px;
        height: 18px;
        stroke: #374151;
        fill: none;
        stroke-width: 2;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0a2540;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.875rem;
    }

    .btn-secondary,
    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .required {
        color: #ef4444;
    }

    @media (max-width: 1024px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function showRejectModal() {
        document.getElementById('rejectModal').classList.add('active');
    }

    function hideRejectModal() {
        document.getElementById('rejectModal').classList.remove('active');
    }

    document.getElementById('rejectModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            hideRejectModal();
        }
    });
</script>
@endpush
@endsection