@extends('layouts.app')

@section('title', 'Tambah Katalog - HIPMI Jawa Barat')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

    * {
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    .form-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .form-header h1 {
        font-size: 1.75rem;
        color: #0a2540;
        margin: 0 0 0.5rem 0;
        font-weight: 700;
    }

    .form-header p {
        color: #6b7280;
        font-size: 0.9375rem;
        margin: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-group label .required {
        color: #ef4444;
        margin-left: 0.25rem;
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
        min-height: 120px;
        resize: vertical;
    }

    .form-group small {
        display: block;
        margin-top: 0.5rem;
        color: #6b7280;
        font-size: 0.8125rem;
    }

    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.2s;
    }

    .upload-area:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .upload-area.has-file {
        border-style: solid;
        border-color: #10b981;
        background: #ecfdf5;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        stroke: #9ca3af;
    }

    .upload-area.has-file .upload-icon {
        stroke: #10b981;
    }

    .upload-text {
        color: #6b7280;
        font-size: 0.9375rem;
    }

    .upload-text strong {
        color: #2563eb;
    }

    .file-name {
        margin-top: 0.5rem;
        color: #10b981;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .images-upload-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .image-upload-box {
        position: relative;
        aspect-ratio: 1;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #f9fafb;
        overflow: hidden;
        transition: all 0.2s;
    }

    .image-upload-box:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .image-upload-box.has-image {
        border-style: solid;
        border-color: #10b981;
    }

    .image-upload-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-placeholder {
        text-align: center;
        padding: 1rem;
    }

    .image-placeholder svg {
        width: 32px;
        height: 32px;
        margin: 0 auto 0.5rem;
        stroke: #9ca3af;
    }

    .image-placeholder p {
        margin: 0;
        color: #9ca3af;
        font-size: 0.8125rem;
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

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #f3f4f6;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-size: 0.9375rem;
        font-weight: 500;
    }

    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h1>Tambah Katalog Perusahaan</h1>
            <p>Isi informasi perusahaan Anda untuk ditampilkan di E-Katalog HIPMI Jawa Barat</p>
        </div>

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

        <form action="{{ route('profile-anggota.katalog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Perusahaan -->
            <div class="form-group">
                <label>Nama Perusahaan<span class="required">*</span></label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required>
            </div>

            <!-- Bidang Usaha -->
            <div class="form-group">
                <label>Bidang Usaha<span class="required">*</span></label>
                <input type="text" name="business_field" value="{{ old('business_field') }}" required>
                <small>Contoh: Teknologi, F&B, Manufaktur, dll.</small>
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label>Deskripsi Perusahaan<span class="required">*</span></label>
                <textarea name="description" required>{{ old('description') }}</textarea>
                <small>Jelaskan tentang perusahaan Anda, produk/jasa yang ditawarkan, dan keunggulan kompetitif.</small>
            </div>

            <!-- Logo -->
            <div class="form-group">
                <label>Logo Perusahaan<span class="required">*</span></label>
                <div class="upload-area" id="logoUploadArea" onclick="document.getElementById('logo').click()">
                    <svg class="upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <p class="upload-text">
                        <strong>Klik untuk upload</strong> atau drag & drop<br>
                        Format: JPG, PNG (Maks. 2MB)
                    </p>
                    <p class="file-name" id="logoFileName"></p>
                </div>
                <input type="file" id="logo" name="logo" accept="image/*" required style="display: none;" onchange="handleFileSelect(this, 'logoUploadArea', 'logoFileName')">
            </div>

            <!-- Gambar Perusahaan -->
            <div class="form-group">
                <label>Gambar Perusahaan (Opsional)</label>
                <small>Upload hingga 3 gambar tambahan perusahaan Anda</small>
                <div class="images-upload-grid">
                    <div class="image-upload-box" id="imageBox1" onclick="document.getElementById('image1').click()">
                        <div class="image-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Gambar 1</p>
                        </div>
                    </div>
                    <input type="file" id="image1" name="images[]" accept="image/*" style="display: none;" onchange="handleImagePreview(this, 'imageBox1')">

                    <div class="image-upload-box" id="imageBox2" onclick="document.getElementById('image2').click()">
                        <div class="image-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Gambar 2</p>
                        </div>
                    </div>
                    <input type="file" id="image2" name="images[]" accept="image/*" style="display: none;" onchange="handleImagePreview(this, 'imageBox2')">

                    <div class="image-upload-box" id="imageBox3" onclick="document.getElementById('image3').click()">
                        <div class="image-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Gambar 3</p>
                        </div>
                    </div>
                    <input type="file" id="image3" name="images[]" accept="image/*" style="display: none;" onchange="handleImagePreview(this, 'imageBox3')">
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label>Alamat Lengkap<span class="required">*</span></label>
                <textarea name="address" required>{{ old('address') }}</textarea>
            </div>

            <!-- Telepon -->
            <div class="form-group">
                <label>Nomor Telepon<span class="required">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" required>
                <small>Format: 08xxxxxxxxxx atau (021) xxxxxxx</small>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email Perusahaan<span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Google Maps -->
            <div class="form-group">
                <label>Link Google Maps (Opsional)</label>
                <textarea name="map_embed_url" placeholder="Paste link Google Maps atau embed code dari Google Maps">{{ old('map_embed_url') }}</textarea>
                <small>Cara: Buka Google Maps → Klik "Bagikan" → Salin link atau kode embed</small>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('profile-anggota') }}" class="btn btn-secondary" style="flex: 1;">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" style="flex: 2;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Submit Katalog
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handleFileSelect(input, areaId, fileNameId) {
    const area = document.getElementById(areaId);
    const fileName = document.getElementById(fileNameId);
    
    if (input.files && input.files[0]) {
        area.classList.add('has-file');
        fileName.textContent = '✓ ' + input.files[0].name;
    }
}

function handleImagePreview(input, boxId) {
    const box = document.getElementById(boxId);
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            box.classList.add('has-image');
            box.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection