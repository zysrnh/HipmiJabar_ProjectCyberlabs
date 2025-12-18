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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

    .tabs-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
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

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9375rem;
        transition: all 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
                <span class="status-badge {{ $anggota->status }}">
                    @if($anggota->status === 'pending')
                        Menunggu Verifikasi
                    @elseif($anggota->status === 'approved')
                        Terverifikasi
                    @else
                        Ditolak
                    @endif
                </span>
            </div>
            <div class="profile-actions">
                <button class="btn btn-primary" onclick="openModal()">Ganti Password</button>
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
            <button class="btn-copy" onclick="copyPassword()">Copy</button>
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
        </div>

        <div class="tabs-content">
            <!-- Tab Data Pribadi -->
            <div class="tab-panel active" id="tab-pribadi">
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
        </div>
    </div>
</div>

<!-- Modal Ganti Password -->
<div id="changePasswordModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Ganti Password</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
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

<script>
    function copyPassword() {
        const passwordText = document.getElementById('passwordText').textContent;
        navigator.clipboard.writeText(passwordText).then(() => {
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = 'Copied!';
            setTimeout(() => {
                btn.textContent = originalText;
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

    function openModal() {
        document.getElementById('changePasswordModal').classList.add('show');
    }

    function closeModal() {
        document.getElementById('changePasswordModal').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('changePasswordModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection