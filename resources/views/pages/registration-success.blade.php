@extends('layouts.app')

@section('title', 'Registrasi Berhasil - HIPMI Jawa Barat')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

    * {
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    .success-container {
        max-width: 700px;
        margin: 60px auto;
        padding: 20px;
    }

    .success-card {
        background: white;
        border-radius: 15px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        text-align: center;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: #10b981;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon svg {
        width: 60px;
        height: 60px;
        stroke: white;
        stroke-width: 3;
    }

    .success-card h1 {
        font-size: 2rem;
        color: #0a2540;
        margin: 0 0 1rem 0;
        font-weight: 700;
    }

    .success-card > p {
        color: #6b7280;
        font-size: 1.125rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .credentials-section {
        background: #667eea;
        border-radius: 12px;
        padding: 2rem;
        margin: 2rem 0;
        text-align: left;
        color: white;
    }

    .credentials-section h3 {
        font-size: 1.25rem;
        margin: 0 0 1.5rem 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .credential-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 1.25rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .credential-item:last-of-type {
        margin-bottom: 0;
    }

    .credential-label {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .credential-value {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background: white;
        padding: 1rem;
        border-radius: 8px;
        color: #0a2540;
    }

    .credential-text {
        font-family: 'Courier New', monospace;
        font-size: 1.125rem;
        font-weight: 700;
        word-break: break-all;
        flex: 1;
    }

    .btn-copy-small {
        background: #2563eb;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .btn-copy-small:hover {
        background: #1e40af;
    }

    .copy-success {
        background: #10b981 !important;
    }

    .download-section {
        margin: 2rem 0;
        padding: 1.5rem;
        background: #f0fdf4;
        border: 2px solid #86efac;
        border-radius: 12px;
    }

    .download-section h4 {
        color: #166534;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .download-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-download {
        background: #16a34a;
        color: white;
        border: none;
        padding: 0.875rem 1.75rem;
        border-radius: 10px;
        cursor: pointer;
        font-size: 0.9375rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-download:hover {
        background: #15803d;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    }

    .important-notes {
        background: #fee2e2;
        border: 2px solid #fca5a5;
        border-radius: 10px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        text-align: left;
    }

    .important-notes h4 {
        color: #dc2626;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
    }

    .important-notes ul {
        margin: 0;
        padding-left: 1.5rem;
        color: #991b1b;
    }

    .important-notes li {
        margin-bottom: 0.5rem;
        line-height: 1.5;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.875rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
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
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .info-box {
        background: #e0e7ff;
        border: 2px solid #818cf8;
        border-radius: 10px;
        padding: 1.25rem;
        margin: 2rem 0;
        color: #3730a3;
        font-size: 0.9375rem;
        line-height: 1.6;
        text-align: left;
    }

    @media (max-width: 640px) {
        .success-container {
            padding: 15px;
            margin: 30px auto;
        }

        .success-card {
            padding: 2rem 1.5rem;
        }

        .success-card h1 {
            font-size: 1.5rem;
        }

        .credential-value {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-copy-small {
            width: 100%;
        }

        .download-buttons {
            flex-direction: column;
        }

        .btn-download {
            width: 100%;
            justify-content: center;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    #printContent {
        display: none;
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </div>

        <h1>Registrasi Berhasil!</h1>
        <p>Selamat datang di HIPMI Jawa Barat. Akun Anda telah berhasil dibuat dan sedang dalam proses verifikasi oleh admin.</p>

        <div class="credentials-section">
            <h3>
                <span>🔐</span>
                <span>Kredensial Login Anda</span>
            </h3>
            
            <div class="credential-item">
                <div class="credential-label">Email Login</div>
                <div class="credential-value">
                    <span class="credential-text" id="emailText">{{ session('user_email') }}</span>
                    <button class="btn-copy-small" onclick="copyText('emailText', this)">Copy</button>
                </div>
            </div>

            <div class="credential-item">
                <div class="credential-label">Password</div>
                <div class="credential-value">
                    <span class="credential-text" id="passwordText">{{ session('generated_password') }}</span>
                    <button class="btn-copy-small" onclick="copyText('passwordText', this)">Copy</button>
                </div>
            </div>
        </div>

        <div class="download-section">
            <h4>
                <span>💾</span>
                <span>Download Kredensial Anda</span>
            </h4>
            <p style="color: #166534; margin-bottom: 1rem; font-size: 0.9375rem;">
                Simpan kredensial Anda dalam format yang mudah diakses
            </p>
            <div class="download-buttons">
                <button class="btn-download" onclick="downloadAsPDF()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Download PDF
                </button>
                <button class="btn-download" onclick="downloadAsTXT()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Download TXT
                </button>
            </div>
        </div>

        <div class="important-notes">
            <h4>📌 Catatan Penting</h4>
            <ul>
                <li><strong>Simpan kredensial ini di tempat yang aman</strong> (notes, password manager, dll)</li>
                <li>Gunakan email dan password ini untuk <strong>login</strong> setelah akun Anda disetujui admin</li>
                <li>Anda dapat <strong>mengubah password</strong> kapan saja setelah login</li>
                <li><strong>Jangan bagikan</strong> kredensial Anda kepada siapapun</li>
                <li>Status verifikasi akan dikirim ke email Anda</li>
            </ul>
        </div>

        <div class="info-box">
            <strong>📧 Notifikasi Email</strong><br>
            Konfirmasi pendaftaran telah dikirim ke <strong>{{ session('user_email') }}</strong>. 
            Anda akan menerima email lagi setelah akun Anda diverifikasi oleh admin.
        </div>

        <div class="action-buttons">
            <a href="{{ route('profile-anggota') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Lihat Profile Saya
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<div id="printContent">
    <div style="font-family: 'Montserrat', Arial, sans-serif; padding: 40px; max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #0a2540; margin: 0 0 10px 0;">HIPMI Jawa Barat</h1>
            <h2 style="color: #667eea; margin: 0; font-size: 1.5rem;">Kredensial Login Anggota</h2>
        </div>
        
        <div style="background: #f9fafb; padding: 20px; border-radius: 10px; margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px 0; color: #6b7280; font-weight: 600;">Email Login:</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white; border-radius: 6px; font-family: 'Courier New', monospace; font-size: 14px; word-break: break-all;">
                        {{ session('user_email') }}
                    </td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                    <td style="padding: 10px 0; color: #6b7280; font-weight: 600;">Password:</td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: white; border-radius: 6px; font-family: 'Courier New', monospace; font-size: 14px; font-weight: bold;">
                        {{ session('generated_password') }}
                    </td>
                </tr>
            </table>
        </div>

        <div style="background: #fef3c7; padding: 20px; border-radius: 10px; border: 2px solid #fbbf24; margin: 20px 0;">
            <h3 style="color: #92400e; margin: 0 0 10px 0; font-size: 1rem;">⚠️ Peringatan Keamanan</h3>
            <ul style="margin: 0; padding-left: 20px; color: #92400e; line-height: 1.8;">
                <li>Simpan dokumen ini di tempat yang aman</li>
                <li>Jangan bagikan kredensial kepada siapapun</li>
                <li>Ganti password setelah login pertama kali</li>
                <li>Hubungi admin jika lupa password</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">
            <p style="margin: 5px 0;">Dokumen ini digenerate otomatis pada:</p>
            <p style="margin: 5px 0; font-weight: 600;">{{ now()->format('d F Y, H:i') }} WIB</p>
            <p style="margin: 15px 0 5px 0;">Website: www.hipmijawabarat.com</p>
            <p style="margin: 5px 0;">Email: info@hipmijawabarat.com</p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    let credentialsSaved = false;
    let emailCopied = false;
    let passwordCopied = false;

    function copyText(elementId, button) {
        const text = document.getElementById(elementId).textContent;
        const originalText = button.textContent;
        
        if (elementId === 'emailText') emailCopied = true;
        if (elementId === 'passwordText') passwordCopied = true;
        
        if (emailCopied && passwordCopied) credentialsSaved = true;
        
        navigator.clipboard.writeText(text).then(() => {
            button.classList.add('copy-success');
            button.textContent = '✓ Copied!';
            
            setTimeout(() => {
                button.classList.remove('copy-success');
                button.textContent = originalText;
            }, 2000);
        }).catch(err => {
            alert('Gagal menyalin. Silakan copy manual.');
        });
    }

    function downloadAsPDF() {
        credentialsSaved = true;
        const element = document.getElementById('printContent');
        const opt = {
            margin: 10,
            filename: 'HIPMI_Kredensial_Login.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    }

    function downloadAsTXT() {
        credentialsSaved = true;
        const email = document.getElementById('emailText').textContent;
        const password = document.getElementById('passwordText').textContent;
        const date = new Date().toLocaleString('id-ID', { 
            dateStyle: 'full', 
            timeStyle: 'short',
            timeZone: 'Asia/Jakarta'
        });
        
        const content = `
═══════════════════════════════════════════════════════
        HIPMI JAWA BARAT - KREDENSIAL LOGIN
═══════════════════════════════════════════════════════

Email Login    : ${email}
Password       : ${password}

═══════════════════════════════════════════════════════
                PERINGATAN KEAMANAN
═══════════════════════════════════════════════════════

⚠️ PENTING:
• Simpan file ini di tempat yang aman
• JANGAN bagikan kredensial kepada siapapun
• Ganti password setelah login pertama kali
• Hubungi admin jika lupa password

═══════════════════════════════════════════════════════

📅 Dokumen digenerate pada: ${date}
🌐 Website: www.hipmijawabarat.com
📧 Email: info@hipmijawabarat.com

═══════════════════════════════════════════════════════
        Terima kasih telah bergabung dengan HIPMI!
═══════════════════════════════════════════════════════
`.trim();

        const blob = new Blob([content], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'HIPMI_Kredensial_Login.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }

    window.addEventListener('beforeunload', function (e) {
        if (!credentialsSaved) {
            e.preventDefault();
            e.returnValue = 'Kredensial belum di-download atau di-copy! Apakah Anda yakin ingin meninggalkan halaman ini?';
        }
    });
</script>
@endsection