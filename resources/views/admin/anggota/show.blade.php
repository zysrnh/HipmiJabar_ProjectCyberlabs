@extends('admin.layouts.admin-layout')

@section('title', 'Detail Anggota')
@section('page-title', 'Detail Pendaftar Anggota')

@php
    $activeMenu = 'anggota';
    $admin = auth()->guard('admin')->user();
@endphp

@push('styles')
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            padding: 6px 12px;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-download i {
            font-size: 14px;
        }

        .btn-download:hover {
            background: #1e40af;
        }

        .detail-container {
            width: 100%;
        }

        .detail-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .detail-info h2 {
            font-size: 1.5rem;
            color: #0a2540;
            margin-bottom: 0.5rem;
        }

        .detail-meta {
            display: flex;
            gap: 1.5rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .detail-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        .btn svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background: #059669;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background: #dc2626;
        }

        .btn-back {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-back:hover {
            background: #e5e7eb;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #0a2540;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f3f4f6;
        }

        .field-group {
            margin-bottom: 1.25rem;
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            margin-bottom: 0.375rem;
        }

        .field-value {
            font-size: 0.875rem;
            color: #0a2540;
            font-weight: 500;
        }

        .image-preview {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 0.5rem;
        }

        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        .status-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
            margin-bottom: 20px;
        }

        .status-badge-large {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-badge-large.pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-badge-large.approved {
            background: #d1fae5;
            color: #059669;
        }

        .status-badge-large.rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .rejection-reason {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .rejection-reason-title {
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 0.5rem;
        }

        .rejection-reason-text {
            color: #dc2626;
            font-size: 0.875rem;
        }

        /* Modal */
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
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0a2540;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .detail-header {
                padding: 1.5rem;
            }

            .detail-header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-info h2 {
                font-size: 1.25rem;
            }

            .detail-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .detail-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .btn {
                flex: 1;
                min-width: 120px;
                justify-content: center;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .detail-header {
                padding: 1rem;
            }

            .detail-info h2 {
                font-size: 1.125rem;
            }

            .detail-card {
                padding: 1rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="detail-container">
        {{-- Header --}}
        <div class="detail-header">
            <div class="detail-header-content">
                <div class="detail-info">
                    <h2>{{ $anggota->nama_usaha }}</h2>
                    <div class="detail-meta">
                        <span><b>Email :</b> {{ $anggota->email }}</span>
                        <span><b>Phone :</b> {{ $anggota->nomor_telepon }}</span>
                        <span><b>Daftar :</b> {{ $anggota->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="detail-actions">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-back">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>

                    @if($admin->category === 'bpc' && $anggota->status === 'pending')
                        <button onclick="showApproveModal()" class="btn btn-approve">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Setujui
                        </button>
                        <button onclick="showRejectModal()" class="btn btn-reject">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            Tolak
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Status Card --}}
        <div class="status-card">
            <div class="card-title">Status Pendaftaran</div>
            <span class="status-badge-large {{ $anggota->status }}">
                @if($anggota->status === 'pending')
                    ⏳ Menunggu Verifikasi
                @elseif($anggota->status === 'approved')
                    Disetujui
                @else
                    Ditolak
                @endif
            </span>

            @if($anggota->status === 'approved')
    <div style="margin-top: 1rem; color: #059669;">
        Disetujui oleh <strong>{{ $anggota->approvedBy->name ?? 'Admin' }}</strong>
        pada {{ $anggota->approved_at ? $anggota->approved_at->format('d M Y H:i') : '-' }}
    </div>
@endif

@if($anggota->status === 'rejected' && $anggota->rejection_reason)
    <div style="margin-top: 1rem; color: #dc2626;">
        <strong>Alasan Penolakan:</strong><br>
        {{ $anggota->rejection_reason }}
    </div>
@endif
        </div>

        {{-- Detail Grid --}}
        <div class="detail-grid">
            {{-- Data Pribadi --}}
            <div class="detail-card">
                <h3 class="card-title">Data Pribadi</h3>

                <div class="field-group">
                    <div class="field-label">Nama Lengkap</div>
                    <div class="field-value">{{ ucfirst($anggota->nama_usaha) }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Jenis Kelamin</div>
                    <div class="field-value">{{ ucfirst($anggota->jenis_kelamin) }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Tempat, Tanggal Lahir</div>
                    <div class="field-value">{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir->format('d M Y') }}
                    </div>
                </div>

                <div class="field-group">
                    <div class="field-label">Agama</div>
                    <div class="field-value">{{ $anggota->agama }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Domisili</div>
                    <div class="field-value">{{ $anggota->domisili }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Alamat Lengkap</div>
                    <div class="field-value">{{ $anggota->alamat_domisili }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Kode Pos</div>
                    <div class="field-value">{{ $anggota->kode_pos }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Nomor KTP</div>
                    <div class="field-value">{{ $anggota->nomor_ktp }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Foto KTP</div>
                    <img src="{{ $anggota->foto_ktp_url }}" alt="Foto KTP" class="image-preview">
                </div>

                <div class="field-group">
                    <div class="field-label">Foto Diri</div>
                    <img src="{{ $anggota->foto_diri_url }}" alt="Foto Diri" class="image-preview">
                </div>
            </div>

            {{-- Profile Perusahaan --}}
            <div class="detail-card">
                <h3 class="card-title">Profile Perusahaan</h3>

                <div class="field-group">
                    <div class="field-label">Nama Perusahaan</div>
                    <div class="field-value">{{ $anggota->nama_usaha_perusahaan }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Legalitas Usaha</div>
                    <div class="field-value">{{ $anggota->legalitas_usaha }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Jabatan</div>
                    <div class="field-value">{{ $anggota->jabatan_usaha }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Alamat Kantor</div>
                    <div class="field-value">{{ $anggota->alamat_kantor }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Bidang Usaha</div>
                    <div class="field-value">{{ $anggota->bidang_usaha }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Brand</div>
                    <div class="field-value">{{ $anggota->brand_usaha }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Jumlah Karyawan</div>
                    <div class="field-value">{{ $anggota->jumlah_karyawan }} orang</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Usia Perusahaan</div>
                    <div class="field-value">{{ $anggota->usia_perusahaan }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Omset Per Tahun</div>
                    <div class="field-value">{{ $anggota->omset_perusahaan }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">NPWP Perusahaan</div>
                    <div class="field-value">{{ $anggota->npwp_perusahaan }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">No. Nota Pendirian</div>
                    <div class="field-value">{{ $anggota->no_nota_pendirian }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Profile Perusahaan</div>
                    <a href="{{ $anggota->profile_perusahaan_url }}" target="_blank" class="file-link">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                        Lihat PDF
                    </a>
                </div>

                <div class="field-group">
                    <div class="field-label">Logo Perusahaan</div>

                    <img src="{{ $anggota->logo_perusahaan_url }}" alt="Logo" class="image-preview">

                    <a href="{{ $anggota->logo_perusahaan_url }}" download class="btn-download">
                        <i class="fa fa-download"></i> Download Logo
                    </a>
                </div>
            </div>

            {{-- Organisasi --}}
            <div class="detail-card">
                <h3 class="card-title">Informasi Organisasi</h3>

                <div class="field-group">
                    <div class="field-label">SFC HIPMI</div>
                    <div class="field-value">{{ $anggota->sfc_hipmi }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Referensi Anggota HIPMI</div>
                    <div class="field-value">{{ $anggota->referensi_hipmi }}</div>
                </div>

                <div class="field-group">
                    <div class="field-label">Organisasi Lain</div>
                    <div class="field-value">{{ $anggota->organisasi_lain }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Approve Modal --}}
    <div class="modal" id="approveModal">
        <div class="modal-content">
            <h3 class="modal-title">Konfirmasi Persetujuan</h3>
            <p>Apakah Anda yakin ingin menyetujui pendaftaran <strong>{{ $anggota->nama_usaha }}</strong>?</p>
            <form action="{{ route('admin.anggota.approve', $anggota) }}" method="POST">
                @csrf
                <div class="modal-actions">
                    <button type="button" class="btn btn-back" onclick="closeModal('approveModal')">Batal</button>
                    <button type="submit" class="btn btn-approve">Ya, Setujui</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Reject Modal --}}
    <div class="modal" id="rejectModal">
        <div class="modal-content">
            <h3 class="modal-title">Tolak Pendaftaran</h3>
            <form action="{{ route('admin.anggota.reject', $anggota) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Alasan Penolakan <span style="color: #ef4444;">*</span></label>
                    <textarea name="rejection_reason" class="form-control" rows="4"
                        placeholder="Jelaskan alasan penolakan..." required></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-back" onclick="closeModal('rejectModal')">Batal</button>
                    <button type="submit" class="btn btn-reject">Tolak</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showApproveModal() {
            document.getElementById('approveModal').classList.add('active');
        }

        function showRejectModal() {
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        // Close modal on outside click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });
    </script>
@endpush    