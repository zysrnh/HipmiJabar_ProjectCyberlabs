@extends('layouts.app')

@section('title', 'Profile Anggota - HIPMI Jawa Barat')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

    * {
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    .profile-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 20px;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 20px;
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

    .profile-header {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f3f4f6;
    }

    .profile-info h1 {
        font-size: 1.75rem;
        color: #0a2540;
        margin: 0 0 0.5rem 0;
        font-weight: 700;
    }

    .profile-subtitle {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .profile-actions {
        margin-left: auto;
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
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

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
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

    .password-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .password-card h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #0a2540;
        margin: 0 0 1rem 0;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .password-display {
        background: #f9fafb;
        padding: 1rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .password-text {
        font-family: 'Courier New', monospace;
        font-size: 1rem;
        font-weight: 600;
        color: #0a2540;
        word-break: break-all;
    }

    .btn-copy {
        background: #2563eb;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-copy:hover {
        background: #1e40af;
    }

    .password-note {
        background: #fef3c7;
        padding: 0.875rem;
        border-radius: 6px;
        color: #92400e;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    /* Admin Account Specific Styles */
    .admin-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
        background: #dbeafe;
        color: #1e40af;
        border: 2px solid #3b82f6;
    }

    .admin-info-card {
        background: #eff6ff;
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid #3b82f6;
        margin-bottom: 1.5rem;
    }

    .admin-info-card h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e40af;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .admin-info-card p {
        margin: 0;
        color: #1e3a8a;
        font-size: 0.875rem;
        line-height: 1.6;
    }

    .credential-box {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }

    .credential-box h5 {
        margin: 0 0 1rem 0;
        font-size: 0.875rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .credential-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        background: #f9fafb;
        border-radius: 6px;
        margin-bottom: 0.75rem;
    }

    .credential-item:last-child {
        margin-bottom: 0;
    }

    .credential-label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 600;
    }

    .credential-value {
        font-family: 'Courier New', monospace;
        font-size: 0.9375rem;
        color: #0a2540;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tabs-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .tabs-header {
        display: flex;
        border-bottom: 2px solid #f3f4f6;
        background: #f9fafb;
        overflow-x: auto;
    }

    .tab-button {
        flex: 1;
        min-width: fit-content;
        padding: 1rem 1.5rem;
        background: transparent;
        border: none;
        font-size: 0.9375rem;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s;
        border-bottom: 3px solid transparent;
        white-space: nowrap;
    }

    .tab-button:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .tab-button.active {
        color: #2563eb;
        background: white;
        border-bottom-color: #2563eb;
    }

    .tabs-content {
        padding: 2rem;
    }

    .tab-panel {
        display: none;
        animation: fadeIn 0.3s ease-in;
    }

    .tab-panel.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .field-group {
        margin-bottom: 0;
    }

    .field-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.5rem;
    }

    .field-value {
        font-size: 0.9375rem;
        color: #0a2540;
        font-weight: 500;
        word-wrap: break-word;
        line-height: 1.5;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .image-preview {
        width: 100%;
        max-width: 400px;
        height: 280px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        margin-top: 0.5rem;
        display: block;
        object-fit: cover;
    }

    .file-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.5rem 0;
        transition: all 0.2s;
    }

    .file-link:hover {
        color: #1e40af;
    }

    .rejection-box {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        color: #dc2626;
        padding: 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .rejection-box h3 {
        margin: 0 0 0.75rem 0;
        font-size: 1rem;
        font-weight: 700;
    }

    .rejection-box p {
        margin: 0;
        line-height: 1.6;
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
        overflow-y: auto;
        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        max-width: 700px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #0a2540;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #9ca3af;
        line-height: 1;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9375rem;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .image-upload-area {
        margin-top: 1.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .upload-box {
        position: relative;
        width: 180px;
        height: 180px;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        overflow: hidden;
        background: #f9fafb;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .upload-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-placeholder {
        text-align: center;
        color: #9ca3af;
        font-size: 0.875rem;
        padding: 1rem;
    }

    .upload-placeholder svg {
        width: 40px;
        height: 40px;
        margin: 0 auto 0.5rem;
        stroke: currentColor;
    }

    .delete-image-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #ef4444;
        color: white;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
        z-index: 10;
        transition: all 0.2s;
    }

    .delete-image-btn:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 15px;
        }

        .profile-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-actions {
            margin-left: 0;
            width: 100%;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .tabs-content {
            padding: 1.25rem;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .modal-content {
            padding: 1.5rem;
        }

        .upload-box {
            width: 150px;
            height: 150px;
        }
    }
</style>

<div class="profile-container">
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

    @if($errors->any())
    <div class="alert alert-error">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 0.5rem 0 0 0; padding-left: 1.25rem;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('generated_password'))
    <div class="alert alert-warning">
        <strong>Penting!</strong> Password Anda telah berhasil di-generate. Silakan simpan password di tempat aman.
    </div>
    @endif

    <div class="profile-header">
        <div class="profile-header-content">
            <img src="{{ $anggota->photo_url }}" alt="Foto" class="profile-photo">
            <div class="profile-info">
                <h1>{{ $anggota->nama_usaha }}</h1>
                <p class="profile-subtitle">{{ $anggota->jabatan_usaha }} - {{ $anggota->nama_usaha_perusahaan }}</p>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <span class="status-badge {{ $anggota->status }}">
                        @if($anggota->status === 'pending')
                        Menunggu Verifikasi
                        @elseif($anggota->status === 'approved')
                        Terverifikasi
                        @else
                        Ditolak
                        @endif
                    </span>
                    @if($anggota->admin)
                    <span class="admin-badge">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                        Admin {{ strtoupper($anggota->admin->category) }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn btn-primary" onclick="openModal('changePasswordModal')">Ganti Password</button>
                <form action="{{ route('anggota.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    @if($anggota->initial_password)
    <div class="password-card">
        <h3>Password Akun Anda</h3>
        <div class="password-note">
            Password ini di-generate otomatis saat Anda mendaftar. Simpan di tempat aman dan segera ganti jika diperlukan.
        </div>
        <div class="password-display">
            <span class="password-text" id="passwordText">{{ $anggota->initial_password }}</span>
            <button class="btn-copy" onclick="copyPassword('passwordText')">Copy</button>
        </div>
    </div>
    @endif

    @if($anggota->status === 'rejected' && $anggota->rejection_reason)
    <div class="rejection-box">
        <h3>Alasan Penolakan</h3>
        <p>{{ $anggota->rejection_reason }}</p>
    </div>
    @endif

    <div class="tabs-container">
        <div class="tabs-header">
            <button class="tab-button active" onclick="switchTab('pribadi')">Data Pribadi</button>
            <button class="tab-button" onclick="switchTab('perusahaan')">Profil Perusahaan</button>
            <button class="tab-button" onclick="switchTab('organisasi')">Informasi Organisasi</button>
            @if($anggota->status === 'approved')
            <button class="tab-button" onclick="switchTab('detail-buku')">Detail Buku Anggota</button>
            @endif
            @if($anggota->admin)
            <button class="tab-button" onclick="switchTab('admin-account')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 0.25rem;">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                Admin Account
            </button>
            @endif
        </div>

        <div class="tabs-content">
            <!-- Tab Data Pribadi -->
            <div class="tab-panel active" id="tab-pribadi">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="margin: 0;">Informasi Pribadi</h3>
                    <button class="btn btn-primary" onclick="openModal('editProfileModal')">Edit Data Pribadi</button>
                </div>
                <div class="detail-grid">
                    <div class="field-group">
                        <div class="field-label">Nama Lengkap</div>
                        <div class="field-value">{{ $anggota->nama_usaha }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Jenis Kelamin</div>
                        <div class="field-value">{{ $anggota->jenis_kelamin }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Tempat, Tanggal Lahir</div>
                        <div class="field-value">{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir->format('d M Y') }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Agama</div>
                        <div class="field-value">{{ $anggota->agama }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Email</div>
                        <div class="field-value">{{ $anggota->email }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Nomor Telepon</div>
                        <div class="field-value">{{ $anggota->nomor_telepon }}</div>
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
                </div>

                <div class="images-grid">
                    <div class="field-group">
                        <div class="field-label">Foto KTP</div>
                        <img src="{{ $anggota->foto_ktp_url }}" alt="Foto KTP" class="image-preview">
                    </div>
                    <div class="field-group">
                        <div class="field-label">Foto Diri</div>
                        <img src="{{ $anggota->foto_diri_url }}" alt="Foto Diri" class="image-preview">
                    </div>
                </div>
            </div>

            <!-- Tab Profil Perusahaan -->
            <div class="tab-panel" id="tab-perusahaan">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="margin: 0;">Informasi Perusahaan</h3>
                    <button class="btn btn-primary" onclick="openModal('editCompanyModal')">Edit Data Perusahaan</button>
                </div>
                <div class="detail-grid">
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
                        <div class="field-label">Brand Usaha</div>
                        <div class="field-value">{{ $anggota->brand_usaha }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Bidang Usaha</div>
                        <div class="field-value">{{ $anggota->bidang_usaha }}</div>
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
                        <div class="field-label">Alamat Kantor</div>
                        <div class="field-value">{{ $anggota->alamat_kantor }}</div>
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
                </div>

                <div class="images-grid">
                    <div class="field-group">
                        <div class="field-label">Logo Perusahaan</div>
                        <img src="{{ $anggota->logo_perusahaan_url }}" alt="Logo" class="image-preview">
                    </div>
                </div>
            </div>

            <!-- Tab Informasi Organisasi -->
            <div class="tab-panel" id="tab-organisasi">
                <div class="detail-grid">
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

            <!-- Tab Detail Buku Anggota -->
            @if($anggota->status === 'approved')
            <div class="tab-panel" id="tab-detail-buku">
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="margin: 0 0 0.5rem 0;">Gambar Detail Buku Anggota</h3>
                    <!-- ... rest of content ... -->
                </div>
            </div>
            @endif

            <form action="{{ route('profile-anggota.upload-detail-images') }}" method="POST" enctype="multipart/form-data" id="detailImagesForm">
                @csrf

                <div class="form-group">
                    <label>Deskripsi (Opsional)</label>
                    <textarea name="deskripsi_detail" placeholder="Tulis deskripsi tentang perusahaan atau usaha Anda...">{{ $anggota->deskripsi_detail }}</textarea>
                </div>

                <div class="form-group">
                    <label>Upload Gambar</label>
                    <div class="image-upload-area">
                        <!-- Image 1 -->
                        <div class="upload-box" onclick="document.getElementById('detail_image_1').click()">
                            @if($anggota->detail_image_1)
                            <img src="{{ $anggota->detail_image_1_url }}" alt="Detail 1" id="preview1">
                            <button type="button" class="delete-image-btn" onclick="event.stopPropagation(); confirmDeleteImage('detail_image_1')">&times;</button>
                            @else
                            <div class="upload-placeholder" id="placeholder1">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                                <div>Gambar 1</div>
                            </div>
                            @endif
                        </div>
                        <input type="file" id="detail_image_1" name="detail_image_1" accept="image/*" style="display: none;" onchange="previewImage(this, 'preview1', 'placeholder1')">

                        <!-- Image 2 -->
                        <div class="upload-box" onclick="document.getElementById('detail_image_2').click()">
                            @if($anggota->detail_image_2)
                            <img src="{{ $anggota->detail_image_2_url }}" alt="Detail 2" id="preview2">
                            <button type="button" class="delete-image-btn" onclick="event.stopPropagation(); confirmDeleteImage('detail_image_2')">&times;</button>
                            @else
                            <div class="upload-placeholder" id="placeholder2">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                                <div>Gambar 2</div>
                            </div>
                            @endif
                        </div>
                        <input type="file" id="detail_image_2" name="detail_image_2" accept="image/*" style="display: none;" onchange="previewImage(this, 'preview2', 'placeholder2')">

                        <!-- Image 3 -->
                        <div class="upload-box" onclick="document.getElementById('detail_image_3').click()">
                            @if($anggota->detail_image_3)
                            <img src="{{ $anggota->detail_image_3_url }}" alt="Detail 3" id="preview3">
                            <button type="button" class="delete-image-btn" onclick="event.stopPropagation(); confirmDeleteImage('detail_image_3')">&times;</button>
                            @else
                            <div class="upload-placeholder" id="placeholder3">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                                <div>Gambar 3</div>
                            </div>
                            @endif
                        </div>
                        <input type="file" id="detail_image_3" name="detail_image_3" accept="image/*" style="display: none;" onchange="previewImage(this, 'preview3', 'placeholder3')">
                    </div>
                </div>

                <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 1rem;">
                    Simpan Gambar & Deskripsi
                </button>
            </form>
        </div>

        <!-- Tab Admin Account -->
        @if($anggota->admin)
        <div class="tab-panel" id="tab-admin-account">
            <div class="admin-info-card">
                <h4>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                    Status Admin Anda
                </h4>
                <p>Anda telah dipromosikan sebagai admin {{ strtoupper($anggota->admin->category) }}. Gunakan kredensial di bawah untuk login ke dashboard admin.</p>
            </div>

            <div class="credential-box">
                <h5>Informasi Admin</h5>

                <div class="credential-item">
                    <span class="credential-label">Kategori Admin</span>
                    <span class="credential-value">
                        {{ $anggota->admin->category === 'bpc' ? 'BPC (Admin Kabupaten/Kota)' : 'BPD (Admin Provinsi)' }}
                    </span>
                </div>

                @if($anggota->admin->category === 'bpc' && $anggota->admin->domisili)
                <div class="credential-item">
                    <span class="credential-label">Domisili</span>
                    <span class="credential-value">{{ $anggota->admin->domisili }}</span>
                </div>
                @endif

                <div class="credential-item">
                    <span class="credential-label">Nama Admin</span>
                    <span class="credential-value">{{ $anggota->admin->name }}</span>
                </div>
            </div>

            <div class="credential-box">
                <h5>Kredensial Login Admin</h5>

                <div class="credential-item">
                    <span class="credential-label">Username</span>
                    <span class="credential-value">
                        {{ $anggota->admin->username }}
                        <button class="btn-copy" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem;" onclick="copyToClipboard('{{ $anggota->admin->username }}', this)">Copy</button>
                    </span>
                </div>

                <div class="credential-item">
                    <span class="credential-label">Email</span>
                    <span class="credential-value">
                        {{ $anggota->admin->email }}
                        <button class="btn-copy" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem;" onclick="copyToClipboard('{{ $anggota->admin->email }}', this)">Copy</button>
                    </span>
                </div>
                <button class="btn btn-primary" onclick="openModal('changeAdminPasswordModal')" style="width: 100%; margin-top: 0.75rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Ganti Password Admin
                </button>
            </div>

            <div style="background: #eff6ff; padding: 1.25rem; border-radius: 10px; border: 2px solid #93c5fd; margin-top: 1.5rem;">
                <h5 style="margin: 0 0 0.75rem 0; font-size: 0.9375rem; font-weight: 700; color: #1e40af;">
                    📌 Cara Login ke Dashboard Admin
                </h5>
                <ol style="margin: 0; padding-left: 1.25rem; color: #1e3a8a; font-size: 0.875rem; line-height: 1.6;">
                    <li><strong>Hubungi admin pusat</strong> untuk mendapatkan password awal Anda</li>
                    <li>Buka halaman login admin</li>
                    <li>Masukkan <strong>username</strong> atau <strong>email</strong> admin Anda</li>
                    <li>Masukkan <strong>password awal</strong> yang diberikan oleh admin pusat</li>
                    <li>Klik tombol <strong>Login</strong></li>
                    <li style="color: #d97706; font-weight: 600;">⚠️ Setelah login pertama kali, segera ubah password Anda untuk keamanan</li>
                </ol>

                <div style="background: #fef3c7; padding: 0.875rem; border-radius: 8px; margin-top: 1rem; border-left: 4px solid #f59e0b;">
                    <p style="margin: 0; font-size: 0.8125rem; color: #92400e; line-height: 1.5;">
                        <strong>💡 Catatan:</strong> Password awal bersifat sementara dan hanya digunakan untuk login pertama kali. Demi keamanan akun Anda, pastikan untuk menggantinya segera setelah berhasil login.
                    </p>
                </div>

                <a href="{{ route('admin.login') }}" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Login ke Dashboard Admin
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
</div>

<!-- Modal Ganti Password -->
<div id="changePasswordModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Ganti Password Anggota</h3>
            <button class="modal-close" onclick="closeModal('changePasswordModal')">&times;</button>
        </div>
        <form action="{{ route('profile-anggota.change-password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="new_password" required minlength="6">
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Ganti Password</button>
        </form>
    </div>
</div>

<!-- Modal Ganti Password Admin -->
@if($anggota->admin)
<div id="changeAdminPasswordModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Ganti Password Admin</h3>
            <button class="modal-close" onclick="closeModal('changeAdminPasswordModal')">&times;</button>
        </div>
        <form action="{{ route('profile-anggota.change-admin-password') }}" method="POST">
            @csrf
            @if(!$anggota->admin->initial_password)
            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="current_admin_password" required>
                <small style="display: block; margin-top: 0.5rem; color: #6b7280; font-size: 0.75rem;">
                    Masukkan password admin yang sedang digunakan
                </small>
            </div>
            @else
            <div style="background: #fef3c7; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #fbbf24;">
                <p style="margin: 0; font-size: 0.875rem; color: #92400e; line-height: 1.5;">
                    <strong>ℹ️ Info:</strong> Ini adalah perubahan password admin pertama kali. Anda tidak perlu memasukkan password lama.
                </p>
            </div>
            @endif
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="new_admin_password" required minlength="8">
                <small style="display: block; margin-top: 0.5rem; color: #6b7280; font-size: 0.75rem;">
                    Minimal 8 karakter
                </small>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="new_admin_password_confirmation" required minlength="8">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Ganti Password Admin</button>
        </form>
    </div>
</div>
@endif

<!-- Modal Edit Profile -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Data Pribadi</h3>
            <button class="modal-close" onclick="closeModal('editProfileModal')">&times;</button>
        </div>
        <form action="{{ route('profile-anggota.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_usaha" value="{{ $anggota->nama_usaha }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="Laki-laki" {{ $anggota->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $anggota->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ $anggota->tempat_lahir }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir->format('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" value="{{ $anggota->agama }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $anggota->email }}" required>
            </div>
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ $anggota->nomor_telepon }}" required>
            </div>
            <div class="form-group">
                <label>Domisili</label>
                <input type="text" name="domisili" value="{{ $anggota->domisili }}" required>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_domisili" required>{{ $anggota->alamat_domisili }}</textarea>
            </div>
            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ $anggota->kode_pos }}" required>
            </div>
            <div class="form-group">
                <label>Update Foto Diri (Opsional)</label>
                <input type="file" name="foto_diri" accept="image/*">
                <small style="display: block; margin-top: 0.5rem; color: #6b7280;">Kosongkan jika tidak ingin mengubah foto</small>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editProfileModal')" style="flex: 1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Company -->
<div id="editCompanyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Data Perusahaan</h3>
            <button class="modal-close" onclick="closeModal('editCompanyModal')">&times;</button>
        </div>
        <form action="{{ route('profile-anggota.update-company') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" name="nama_usaha_perusahaan" value="{{ $anggota->nama_usaha_perusahaan }}" required>
            </div>
            <div class="form-group">
                <label>Legalitas Usaha</label>
                <select name="legalitas_usaha" required>
                    <option value="PT" {{ $anggota->legalitas_usaha === 'PT' ? 'selected' : '' }}>PT</option>
                    <option value="CV" {{ $anggota->legalitas_usaha === 'CV' ? 'selected' : '' }}>CV</option>
                    <option value="PT Perorangan" {{ $anggota->legalitas_usaha === 'PT Perorangan' ? 'selected' : '' }}>PT Perorangan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan_usaha" value="{{ $anggota->jabatan_usaha }}" required>
            </div>
            <div class="form-group">
                <label>Brand Usaha</label>
                <input type="text" name="brand_usaha" value="{{ $anggota->brand_usaha }}" required>
            </div>
            <div class="form-group">
                <label>Bidang Usaha</label>
                <input type="text" name="bidang_usaha" value="{{ $anggota->bidang_usaha }}" required>
            </div>
            <div class="form-group">
                <label>Jumlah Karyawan</label>
                <input type="number" name="jumlah_karyawan" value="{{ $anggota->jumlah_karyawan }}" required min="0">
            </div>
            <div class="form-group">
                <label>Usia Perusahaan</label>
                <input type="text" name="usia_perusahaan" value="{{ $anggota->usia_perusahaan }}" required>
            </div>
            <div class="form-group">
                <label>Omset Per Tahun</label>
                <input type="text" name="omset_perusahaan" value="{{ $anggota->omset_perusahaan }}" required>
            </div>
            <div class="form-group">
                <label>NPWP Perusahaan</label>
                <input type="text" name="npwp_perusahaan" value="{{ $anggota->npwp_perusahaan }}" required>
            </div>
            <div class="form-group">
                <label>No. Nota Pendirian</label>
                <input type="text" name="no_nota_pendirian" value="{{ $anggota->no_nota_pendirian }}" required>
            </div>
            <div class="form-group">
                <label>Alamat Kantor</label>
                <textarea name="alamat_kantor" required>{{ $anggota->alamat_kantor }}</textarea>
            </div>
            <div class="form-group">
                <label>Update Logo Perusahaan (Opsional)</label>
                <input type="file" name="logo_perusahaan" accept="image/*">
                <small style="display: block; margin-top: 0.5rem; color: #6b7280;">Kosongkan jika tidak ingin mengubah logo</small>
            </div>
            <div class="form-group">
                <label>Update Profile Perusahaan PDF (Opsional)</label>
                <input type="file" name="profile_perusahaan" accept=".pdf">
                <small style="display: block; margin-top: 0.5rem; color: #6b7280;">Kosongkan jika tidak ingin mengubah PDF</small>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editCompanyModal')" style="flex: 1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function copyPassword(elementId) {
        const passwordText = document.getElementById(elementId).textContent;
        navigator.clipboard.writeText(passwordText).then(() => {
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = 'Copied!';
            setTimeout(() => {
                btn.textContent = originalText;
            }, 2000);
        });
    }

    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            setTimeout(() => {
                button.textContent = originalText;
            }, 2000);
        });
    }

    function switchTab(tabName) {
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.remove('active');
        });

        event.target.classList.add('active');
        document.getElementById('tab-' + tabName).classList.add('active');
    }

    function openModal(modalId) {
        document.getElementById(modalId).classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    }

    function previewImage(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const uploadBox = input.previousElementSibling;
                const placeholder = document.getElementById(placeholderId);

                if (placeholder) {
                    placeholder.style.display = 'none';
                }

                let img = document.getElementById(previewId);
                if (!img) {
                    img = document.createElement('img');
                    img.id = previewId;
                    img.alt = 'Preview';
                    uploadBox.appendChild(img);
                }
                img.src = e.target.result;
                img.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function confirmDeleteImage(imageField) {
        if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
            deleteImage(imageField);
        }
    }

    function deleteImage(imageField) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("profile-anggota.delete-detail-image") }}';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';

        const imageInput = document.createElement('input');
        imageInput.type = 'hidden';
        imageInput.name = 'image_field';
        imageInput.value = imageField;

        form.appendChild(csrfToken);
        form.appendChild(imageInput);
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection