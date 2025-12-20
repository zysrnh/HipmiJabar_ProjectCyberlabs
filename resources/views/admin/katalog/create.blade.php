@extends('admin.layouts.admin-layout')

@section('title', 'Tambah E-Katalog')
@section('page-title', 'Tambah E-Katalog')

@php
    $activeMenu = 'katalog';
@endphp

@push('styles')
<style>
    .form-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        max-width: 900px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-label.required::after {
        content: '*';
        color: #dc2626;
        margin-left: 0.25rem;
    }

    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.2s;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #ffd700;
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-file-input {
        display: block;
        width: 100%;
        padding: 0.625rem;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .form-file-input:hover {
        border-color: #ffd700;
        background: #fffbeb;
    }

    .file-input-wrapper {
        position: relative;
    }

    .file-preview {
        margin-top: 0.75rem;
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .file-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .form-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-checkbox input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .btn-primary {
        background: #ffd700;
        color: #0a2540;
    }

    .btn-primary:hover {
        background: #e6c200;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .form-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    .form-hint {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .map-preview-container {
        margin-top: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        display: none;
    }

    .map-preview-container.show {
        display: block;
    }

    .map-preview-container iframe {
        width: 100%;
        height: 300px;
        border: none;
    }

    .map-preview-placeholder {
        width: 100%;
        height: 300px;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.5rem;
        color: #6b7280;
    }

    .map-preview-placeholder svg {
        width: 48px;
        height: 48px;
        opacity: 0.5;
    }

    .map-helper {
        background: #f3f4f6;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 0.5rem;
    }

    .map-helper-title {
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .map-helper-steps {
        font-size: 0.75rem;
        color: #6b7280;
        line-height: 1.6;
    }

    .map-helper-steps ol {
        margin: 0.5rem 0;
        padding-left: 1.5rem;
    }

    .map-helper-steps li {
        margin-bottom: 0.25rem;
    }

    .format-accepted {
        display: inline-block;
        background: #10b981;
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    .map-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        border-radius: 6px;
    }

    .map-status.success {
        background: #d1fae5;
        color: #065f46;
    }

    .map-status.warning {
        background: #fef3c7;
        color: #92400e;
    }

    .map-status.error {
        background: #fee2e2;
        color: #991b1b;
    }

    .map-status svg {
        width: 16px;
        height: 16px;
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <form action="{{ route('admin.katalog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label required">Nama Perusahaan</label>
            <input type="text" name="company_name" class="form-input" value="{{ old('company_name') }}" required>
            @error('company_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Bidang Perusahaan</label>
            <input type="text" name="business_field" class="form-input" value="{{ old('business_field') }}" required>
            @error('business_field')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Deskripsi Perusahaan</label>
            <textarea name="description" class="form-textarea" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Logo Perusahaan</label>
            <input type="file" name="logo" class="form-file-input" accept="image/*" onchange="previewLogo(event)">
            <div class="form-hint">Format: JPG, PNG, GIF (Max: 2MB)</div>
            <div class="file-preview" id="logoPreview"></div>
            @error('logo')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Galeri (Max 3)</label>
            <input type="file" name="images[]" class="form-file-input" accept="image/*" multiple onchange="previewImages(event)">
            <div class="form-hint">Format: JPG, PNG, GIF (Max: 2MB per file)</div>
            <div class="file-preview" id="imagesPreview"></div>
            @error('images.*')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Alamat</label>
            <textarea name="address" class="form-textarea" rows="3" required>{{ old('address') }}</textarea>
            @error('address')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Nomor Telepon</label>
            <input type="text" name="phone" class="form-input" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">
                Lokasi Google Maps
                <span class="format-accepted">Paste link dari browser!</span>
            </label>
            <input 
                type="text" 
                name="map_embed_url" 
                class="form-input" 
                placeholder="Contoh: https://www.google.com/maps/place/..."
                oninput="handleMapInput(this.value)"
                value="{{ old('map_embed_url') }}">
            <div class="form-hint">
                <strong>✓ Cara termudah:</strong> Buka Google Maps → Cari lokasi → Copy URL dari address bar browser
                <br>
                <strong style="color: #dc2626;">✗ Jangan paste kode iframe/embed</strong> - hanya URL biasa saja!
            </div>
            
            <div id="mapStatus"></div>

            <div class="map-helper">
                <div class="map-helper-title">📍 Langkah mudah:</div>
                <div class="map-helper-steps">
                    <ol>
                        <li>Buka <strong>google.com/maps</strong> di browser</li>
                        <li>Cari dan klik lokasi perusahaan Anda</li>
                        <li><strong>Copy URL dari address bar</strong> (bagian atas browser)</li>
                        <li>Paste di kolom di atas ↑</li>
                    </ol>
                    <div style="margin-top: 0.5rem; padding: 0.5rem; background: #fef3c7; border-radius: 4px; color: #92400e;">
                        <strong>💡 Tips:</strong> URL yang benar dimulai dengan "https://www.google.com/maps/..."
                    </div>
                </div>
            </div>

            <div class="map-preview-container" id="mapPreviewContainer">
                <div class="map-preview-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p>Preview map akan muncul di sini</p>
                </div>
                <iframe id="mapPreviewFrame" src="" allowfullscreen loading="lazy" style="display: none;"></iframe>
            </div>
            
            @error('map_embed_url')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-checkbox">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <span>Aktifkan katalog ini</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('admin.katalog.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewLogo(event) {
        const preview = document.getElementById('logoPreview');
        preview.innerHTML = '';
        
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }

    function previewImages(event) {
        const preview = document.getElementById('imagesPreview');
        preview.innerHTML = '';
        
        const files = event.target.files;
        for (let i = 0; i < Math.min(files.length, 3); i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                preview.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
    }

    let debounceTimer;
    function handleMapInput(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            previewMap(input);
        }, 500);
    }

    function showMapStatus(type, message) {
        const statusDiv = document.getElementById('mapStatus');
        const icons = {
            success: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
            warning: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>',
            error: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>'
        };
        
        statusDiv.innerHTML = `
            <div class="map-status ${type}">
                ${icons[type]}
                <span>${message}</span>
            </div>
        `;
    }

    function previewMap(input) {
        const previewContainer = document.getElementById('mapPreviewContainer');
        const previewFrame = document.getElementById('mapPreviewFrame');
        const placeholder = previewContainer.querySelector('.map-preview-placeholder');
        
        if (!input || input.trim() === '') {
            previewContainer.classList.remove('show');
            previewFrame.style.display = 'none';
            placeholder.style.display = 'flex';
            document.getElementById('mapStatus').innerHTML = '';
            return;
        }

        let embedUrl = extractMapUrl(input);
        
        if (embedUrl === null) {
            // extractMapUrl sudah menampilkan error message jika ada iframe
            if (!input.includes('<iframe')) {
                previewContainer.classList.remove('show');
                showMapStatus('error', '✗ Format link tidak dikenali. Pastikan copy URL dari address bar Google Maps.');
            }
            return;
        }
        
        if (embedUrl) {
            // Cek apakah URL bisa di-preview
            if (embedUrl.includes('output=embed')) {
                previewFrame.src = embedUrl;
                previewFrame.style.display = 'block';
                placeholder.style.display = 'none';
                previewContainer.classList.add('show');
                showMapStatus('success', '✓ Perfect! Link berhasil terdeteksi dan preview ditampilkan.');
                
                // Handle iframe load error
                previewFrame.addEventListener('load', function() {
                    // Check if iframe loaded successfully
                    try {
                        if (previewFrame.contentWindow.location.href === 'about:blank') {
                            throw new Error('Failed to load');
                        }
                    } catch (e) {
                        // Might be blocked by CORS, but that's okay for embed
                    }
                });
            } else if (embedUrl.includes('maps.app.goo.gl') || embedUrl.includes('goo.gl/maps')) {
                // Short URL tidak bisa di-preview
                placeholder.style.display = 'flex';
                previewFrame.style.display = 'none';
                previewContainer.classList.add('show');
                showMapStatus('warning', '⚠ Short link terdeteksi. Link akan tetap tersimpan, tapi gunakan URL lengkap untuk preview yang lebih baik.');
            } else {
                // Format lain, coba preview
                previewFrame.src = `https://www.google.com/maps?q=${encodeURIComponent(embedUrl)}&output=embed`;
                previewFrame.style.display = 'block';
                placeholder.style.display = 'none';
                previewContainer.classList.add('show');
                showMapStatus('success', '✓ Link terdeteksi dan akan diproses.');
            }
        }
    }

    function extractMapUrl(input) {
        // Clean input
        input = input.trim();

        // Tolak jika ada tag HTML/iframe
        if (input.includes('<iframe') || input.includes('<') || input.includes('>')) {
            showMapStatus('error', '✗ Jangan paste kode iframe! Copy URL dari address bar browser saja.');
            return null;
        }

        // Jika sudah format embed yang benar
        if (input.includes('output=embed')) {
            return input;
        }

        // Extract koordinat dari URL biasa (paling umum dan reliable)
        // Format: https://www.google.com/maps/place/.../@-6.9034,107.6189,17z
        // atau: https://www.google.com/maps/@-6.9034,107.6189,17z
        const coordMatch = input.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
        if (coordMatch) {
            const lat = coordMatch[1];
            const lng = coordMatch[2];
            return `https://www.google.com/maps?q=${lat},${lng}&output=embed`;
        }

        // Extract dari URL dengan place_id (sangat reliable)
        // Format: https://www.google.com/maps/place/...?q=place_id:ChIJ...
        const placeIdMatch = input.match(/place_id[=:]([A-Za-z0-9_-]+)/);
        if (placeIdMatch) {
            const placeId = placeIdMatch[1];
            return `https://www.google.com/maps?q=place_id:${placeId}&output=embed`;
        }

        // Extract nama place dari URL
        // Format: https://www.google.com/maps/place/Nama+Tempat/@...
        const placeNameMatch = input.match(/\/place\/([^/@?]+)/);
        if (placeNameMatch) {
            const placeName = decodeURIComponent(placeNameMatch[1].replace(/\+/g, ' '));
            // Jika ada koordinat juga, prioritaskan koordinat
            const coords = input.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
            if (coords) {
                return `https://www.google.com/maps?q=${coords[1]},${coords[2]}&output=embed`;
            }
            return `https://www.google.com/maps?q=${encodeURIComponent(placeName)}&output=embed`;
        }

        // Short URL dari maps.app.goo.gl
        if (input.includes('maps.app.goo.gl') || input.includes('goo.gl/maps')) {
            return input; // Akan di-handle sebagai warning
        }

        // Jika mengandung google.com/maps tapi format tidak dikenali
        if (input.includes('google.com/maps')) {
            return input; // Coba tetap proses
        }

        return null;
    }

    // Preview on page load jika ada old value
    document.addEventListener('DOMContentLoaded', function() {
        const mapInput = document.querySelector('textarea[name="map_embed_url"]');
        if (mapInput && mapInput.value) {
            previewMap(mapInput.value);
        }
    });
</script>
@endpush
@endsection