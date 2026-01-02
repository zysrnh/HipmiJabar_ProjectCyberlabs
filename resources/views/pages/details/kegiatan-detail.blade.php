{{-- resources/views/pages/details/kegiatan-detail.blade.php --}}
@extends ('layouts.app')

@section('title', $kegiatan->judul . ' - Kegiatan HIPMI Jawa Barat')

@section('content')

    <section class="page-banner">
        <h1>{{ $kegiatan->judul }}</h1>
        <p>{{ $kegiatan->tanggal_publish->format('d F Y') }}</p>
    </section>

    <section class="detail-berita">
        <div class="detail-berita-content">
            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}">
            
            {{-- Tampilkan konten dengan format paragraf --}}
            <p>{!! nl2br(e($kegiatan->konten)) !!}</p>

            {{-- Galeri Dokumentasi --}}
            @if($kegiatan->gambar_dokumentasi && count($kegiatan->gambar_dokumentasi) > 0)
            <div class="dokumentasi-section">
                <h2 class="dokumentasi-title">Dokumentasi Kegiatan</h2>
                <div class="dokumentasi-grid">
                    @foreach($kegiatan->gambar_dokumentasi as $index => $gambar)
                    <div class="dokumentasi-item" onclick="openLightbox({{ $index }})">
                        <img src="{{ asset('storage/' . $gambar) }}" alt="Dokumentasi {{ $index + 1 }}">
                        <div class="dokumentasi-overlay">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                                <line x1="11" y1="8" x2="11" y2="14"></line>
                                <line x1="8" y1="11" x2="14" y2="11"></line>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <div class="berita-detail-right">
            <h1 class="berita-badge">Kegiatan Lainnya</h1>
            
            @forelse($kegiatanLainnya as $item)
            <div class="berita-detail-right-item">
                <a href="{{ route('detail-kegiatan', $item->slug) }}" class="berita-detail-right-item-image">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                </a>
                <div class="berita-detail-right-item-content">
                    <div>
                        <h3>{{ $item->judul }}</h3>
                        <p class="berita-home-date">{{ $item->tanggal_publish->format('F d, Y') }}</p>
                        <p>{{ Str::limit($item->konten, 100, '...') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p style="text-align: center; color: #6b7280; padding: 1rem;">Belum ada kegiatan lainnya</p>
            @endforelse
        </div>
    </section>

    {{-- Lightbox Modal --}}
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <button class="lightbox-prev" onclick="changeImage(-1); event.stopPropagation();">&#10094;</button>
        <button class="lightbox-next" onclick="changeImage(1); event.stopPropagation();">&#10095;</button>
        <img class="lightbox-content" id="lightbox-img" onclick="event.stopPropagation()">
        <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>

    <style>
        /* Dokumentasi Section */
        .dokumentasi-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
        }

        .dokumentasi-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .dokumentasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .dokumentasi-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        .dokumentasi-item {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .dokumentasi-item:hover {
            transform: scale(1.05);
        }

        .dokumentasi-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .dokumentasi-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dokumentasi-item:hover .dokumentasi-overlay {
            opacity: 1;
        }

        .dokumentasi-overlay svg {
            color: white;
            width: 32px;
            height: 32px;
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            overflow: auto;
        }

        .lightbox-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 85vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: zoom 0.3s;
        }

        @keyframes zoom {
            from { transform: translate(-50%, -50%) scale(0.8); }
            to { transform: translate(-50%, -50%) scale(1); }
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
            transition: color 0.3s;
        }

        .lightbox-close:hover {
            color: #bbb;
        }

        .lightbox-prev,
        .lightbox-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            font-size: 30px;
            padding: 16px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            z-index: 10000;
        }

        .lightbox-prev:hover,
        .lightbox-next:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }

        .lightbox-caption {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            text-align: center;
            font-size: 16px;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .lightbox-content {
                max-width: 95%;
                max-height: 80vh;
            }

            .lightbox-close {
                top: 10px;
                right: 20px;
                font-size: 30px;
            }

            .lightbox-prev,
            .lightbox-next {
                padding: 12px 16px;
                font-size: 24px;
            }

            .lightbox-prev {
                left: 10px;
            }

            .lightbox-next {
                right: 10px;
            }
        }
    </style>

    <script>
        const images = @json($kegiatan->gambar_dokumentasi_url ?? []);
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const caption = document.getElementById('lightbox-caption');
            
            lightbox.style.display = 'block';
            img.src = images[currentIndex];
            caption.textContent = `Dokumentasi ${currentIndex + 1} dari ${images.length}`;
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function changeImage(direction) {
            currentIndex += direction;
            
            if (currentIndex >= images.length) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = images.length - 1;
            }
            
            const img = document.getElementById('lightbox-img');
            const caption = document.getElementById('lightbox-caption');
            
            img.src = images[currentIndex];
            caption.textContent = `Dokumentasi ${currentIndex + 1} dari ${images.length}`;
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox.style.display === 'block') {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                }
            }
        });
    </script>

@endsection