@extends('admin.layouts.admin-layout')

@section('title', 'Edit E-Katalog')
@section('page-title', 'Edit E-Katalog')

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

    .form-input, .form-textarea {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.2s;
    }

    .form-input:focus, .form-textarea:focus {
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

    .current-image {
        margin-top: 0.75rem;
    }

    .current-image img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .current-images {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 0.75rem;
    }

    .current-images img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
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

    .image-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 0.5rem;
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

    .current-map-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .current-map-label .badge {
        background: #3b82f6;
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 600;
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
    <form action="{{ route('admin.katalog.update', $katalog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label required">Nama Perusahaan</label>
            <input type="text" name="company_name" class="form-input" value="{{ old('company_name', $katalog->company_name) }}" required>
            @error('company_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Bidang Perusahaan</label>
            <input type="text" name="business_field" class="form-input" value="{{ old('business_field', $katalog->business_field) }}" required>
            @error('business_field')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Deskripsi Perusahaan</label>
            <textarea name="description" class="form-textarea" required>{{ old('description', $katalog->description) }}</textarea>
            @error('description')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Logo Perusahaan</label>
            @if($katalog->logo)
                <div class="image-label">Logo saat ini:</div>
                <div class="current-image">
                    <img src="{{ $katalog->logo_url }}" alt="Current Logo">
                </div>
            @endif
            <input type="file" name="logo" class="form-file-input" accept="image/*" onchange="previewLogo(event)" style="margin-top: 0.75rem;">
            <div class="form-hint">Biarkan kosong jika tidak ingin mengubah logo. Format: JPG, PNG, GIF (Max: 2MB)</div>
            <div class="file-preview" id="logoPreview"></div>
            @error('logo')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Galeri (Max 3)</label>
            @if($katalog->images && count($katalog->images_url) > 0)
                <div class="image-label">Gambar saat ini:</div>
                <div class="current-images">
                    @foreach($katalog->images_url as $imageUrl)
                        <img src="{{ $imageUrl }}" alt="Gallery Image">
                    @endforeach
                </div>
            @endif
            <input type="file" name="images[]" class="form-file-input" accept="image/*" multiple onchange="previewImages(event)" style="margin-top: 0.75rem;">
            <div class="form-hint">Biarkan kosong jika tidak ingin mengubah gambar. Upload gambar baru akan mengganti semua gambar lama. Format: JPG, PNG, GIF (Max: 2MB per file)</div>
            <div class="file-preview" id="imagesPreview"></div>
            @error('images.*')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Alamat</label>
            <textarea name="address" class="form-textarea" rows="3" required>{{ old('address', $katalog->address) }}</textarea>
            @error('address')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Nomor Telepon</label>
            <input type="text" name="phone" class="form-input" value="{{ old('phone', $katalog->phone) }}" required>
            @error('phone')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label required">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email', $katalog->email) }}" required>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">
                Lokasi Google Maps
                <span class="format-accepted">Semua format diterima!</span>
            </label>
            
            @if($katalog->map_embed_url)
                <div class="current-map-label">
                    <div class="image-label">Map saat ini:</div>
                    <span class="badge">Aktif</span>
                </div>
                <div class="map-preview-container show">
                    <iframe src="{{ $katalog->map_embed_url }}" allowfullscreen loading="lazy"></iframe>
                </div>
            @endif

            <textarea 
                name="map_embed_url" 
                class="form-textarea" 
                rows="3" 
                placeholder="Paste apapun dari Google Maps di sini..."
                oninput="handleMapInput(this.value)"
                style="margin-top: 0.75rem;">{{ old('map_embed_url', $katalog->map_embed_url) }}</textarea>
            <div class="form-hint">✓ URL biasa, ✓ Link share, ✓ Kode embed, ✓ Iframe - semua otomatis diproses! Biarkan kosong jika tidak ingin mengubah.</div>
            
            <div id="mapStatus"></div>
            
            <div class="map-helper">
                <div class="map-helper-title">📍 Cara mudah ambil link:</div>
                <div class="map-helper-steps">
                    <ol>
                        <li>Buka Google Maps di browser</li>
                        <li>Cari lokasi perusahaan</li>
                        <li>Klik tombol <strong>"Share"</strong> atau <strong>"Bagikan"</strong></li>
                        <li>Copy link yang muncul dan paste di sini</li>
                    </ol>
                    <strong>Atau:</strong> Langsung copy URL dari address bar browser!
                </div>
            </div>

            <div class="map-preview-container" id="mapPreviewContainer">
                <div class="map-preview-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p>Preview map baru akan muncul di sini</p>
                </div>
                <iframe id="mapPreviewFrame" src="" allowfullscreen loading="lazy" style="display: none;"></iframe>
            </div>
            
            @error('map_embed_url')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-checkbox">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $katalog->is_active) ? 'checked' : '' }}>
                <span>Aktifkan katalog ini</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Data</button>
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

    function handleMapPaste(event) {
        setTimeout(() => {
            const input = event.target.value;
            previewMap(input);
        }, 100);
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

    let debounceTimer;
    function handleMapInput(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            previewMap(input);
        }, 500);
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
        
        if (embedUrl) {
            // Cek apakah URL bisa di-preview
            if (embedUrl.includes('output=embed') || embedUrl.includes('maps/embed')) {
                previewFrame.src = embedUrl;
                previewFrame.style.display = 'block';
                placeholder.style.display = 'none';
                previewContainer.classList.add('show');
                showMapStatus('success', '✓ Link berhasil dideteksi! Preview map ditampilkan.');
                
                // Handle iframe load error
                previewFrame.onerror = function() {
                    previewFrame.style.display = 'none';
                    placeholder.style.display = 'flex';
                    showMapStatus('warning', '⚠ Link valid tapi tidak bisa di-preview. Link akan tetap tersimpan dan berfungsi di halaman publik.');
                };
            } else {
                // URL terdeteksi tapi tidak bisa di-preview (short URL, dll)
                placeholder.style.display = 'flex';
                previewFrame.style.display = 'none';
                previewContainer.classList.add('show');
                showMapStatus('warning', '⚠ Link terdeteksi tapi tidak bisa di-preview. Link akan diproses saat disimpan dan akan berfungsi di halaman publik.');
            }
        } else {
            previewContainer.classList.remove('show');
            showMapStatus('error', '✗ Format link tidak dikenali. Pastikan menggunakan link dari Google Maps.');
        }
    }

    function extractMapUrl(input) {
        // Jika sudah format embed yang benar
        if (input.includes('maps/embed') || input.includes('output=embed')) {
            return input;
        }

        // Extract dari iframe
        const iframeMatch = input.match(/src=["']([^"']+)["']/);
        if (iframeMatch) {
            return iframeMatch[1];
        }

        // Extract koordinat dari URL biasa
        const coordMatch = input.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (coordMatch) {
            const lat = coordMatch[1];
            const lng = coordMatch[2];
            // Gunakan format sederhana yang lebih reliable
            return `https://www.google.com/maps?q=${lat},${lng}&output=embed`;
        }

        // Extract place_id
        const placeMatch = input.match(/place_id[=:]([A-Za-z0-9_-]+)/);
        if (placeMatch) {
            const placeId = placeMatch[1];
            return `https://www.google.com/maps?q=place_id:${placeId}&output=embed`;
        }

        // Extract dari search URL
        const searchMatch = input.match(/maps\/search\/([^\/\?&]+)/);
        if (searchMatch) {
            const query = decodeURIComponent(searchMatch[1]);
            return `https://www.google.com/maps?q=${encodeURIComponent(query)}&output=embed`;
        }

        // Detect short URL atau format lain yang valid
        if (input.includes('maps.app.goo.gl') || input.includes('goo.gl/maps') || input.includes('google.com/maps')) {
            return input; // Return untuk di-handle sebagai warning
        }

        return null;
    }

    // Preview on page load jika ada value
    document.addEventListener('DOMContentLoaded', function() {
        const mapInput = document.querySelector('textarea[name="map_embed_url"]');
        if (mapInput && mapInput.value && !mapInput.value.includes('maps/embed')) {
            // Jika bukan embed URL, coba extract dan preview
            previewMap(mapInput.value);
        }
    });
</script>
@endpush
@endsection