@extends ('layouts.app')

@section('title', 'Informasi Kegiatan - HIPMI Jawa Barat')

@section('content')
    <section class="page-banner">
        <h1>Informasi Kegiatan BPD</h1>
        <p>Anggota & Pengurus HIPMI Jawa Barat</p>
    </section>

    <section class="search-katalog">
        <!-- Search Box -->
        <form action="{{ route('informasi-kegiatan') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Cari kegiatan" value="{{ request('search') }}" style="font-family: 'Montserrat', sans-serif;">
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <i class="fa fa-search"></i>
            </button>
        </form>
        
        <!-- Filter Bidang dan Tanggal -->
        <div class="filter-bidang" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <form action="{{ route('informasi-kegiatan') }}" method="GET" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <!-- Hidden search value -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                
                <!-- Filter Bidang -->
                <select name="bidang" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #ddd; min-width: 150px; background: #0a2540; color: white; font-weight: 500; font-family: 'Montserrat', sans-serif; cursor: pointer;">
                    <option value="">Semua Bidang</option>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="Bidang {{ $i }}" {{ request('bidang') == "Bidang $i" ? 'selected' : '' }}>
                            Bidang {{ $i }}
                        </option>
                    @endfor
                </select>

                <!-- Filter Tanggal -->
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                       placeholder="Pilih Tanggal"
                       style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #ddd; min-width: 150px; background: #0a2540; color: white; font-weight: 500; font-family: 'Montserrat', sans-serif; cursor: pointer;">

                <!-- Tombol Reset Filter -->
                @if(request('bidang') || request('tanggal') || request('search'))
                <a href="{{ route('informasi-kegiatan') }}" 
                   style="padding: 0.75rem 1.25rem; background: #ef4444; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; font-family: 'Montserrat', sans-serif; display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap;">
                    <i class="fa fa-times"></i> Reset
                </a>
                @endif
            </form>
        </div>

        <script>
            // Auto submit saat bidang atau tanggal dipilih
            const filterForm = document.querySelector('.filter-bidang form');
            const bidangSelect = filterForm.querySelector('select[name="bidang"]');
            const tanggalInput = filterForm.querySelector('input[name="tanggal"]');
            
            bidangSelect.addEventListener('change', function() {
                filterForm.submit();
            });
            
            tanggalInput.addEventListener('change', function() {
                filterForm.submit();
            });
        </script>
    </section>

    <section class="informasi-kegiatan">
        <div class="informasi-kegiatan-cards">
            @forelse($kegiatan as $item)
                <div class="informasi-kegiatan-card">
                    <a href="{{ route('detail-kegiatan', $item->slug) }}" class="informasi-kegiatan-card-image">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                    </a>
                    <div class="informasi-kegiatan-card-text">
                        <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span style="background: #0a2540; color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
                                {{ $item->bidang }}
                            </span>
                            @if($item->is_populer)
                            <span style="background: #ffd700; color: #0a2540; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
                                Populer
                            </span>
                            @endif
                        </div>
                        <h3>{{ $item->judul }}</h3>
                        <p style="margin-bottom: 15px; font-size: 0.875rem; color: #6b7280;">{{ $item->tanggal_publish->format('d F Y') }}</p>
                        <p style="color: #374151; line-height: 1.6;">{{ Str::limit(strip_tags($item->konten), 80, '...') }}</p>
                    </div>
                    <a href="{{ route('detail-kegiatan', $item->slug) }}" class="info-kegiatan-btn-more">Baca Selengkapnya</a>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem; width: 100%; color: #6b7280;">
                    <p style="font-size: 1.125rem; font-weight: 600;">Belum ada kegiatan yang tersedia</p>
                    <p>Silakan cek kembali nanti</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($kegiatan->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 2rem;">
            {{ $kegiatan->links() }}
        </div>
        @endif
    </section>

    <style>
        /* Fix thumbnail landscape aspect ratio */
        .informasi-kegiatan-card-image {
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
            display: block;
        }

        .informasi-kegiatan-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .informasi-kegiatan-card-image:hover img {
            transform: scale(1.05);
        }

        /* Adjust card text padding */
        .informasi-kegiatan-card-text {
            padding: 1.25rem;
        }

        .informasi-kegiatan-card-text h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .informasi-kegiatan-card-text p {
            font-size: 0.875rem;
            line-height: 1.6;
            color: #6b7280;
        }

        /* Ensure consistent card height */
        .informasi-kegiatan-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .informasi-kegiatan-card-text {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .info-kegiatan-btn-more {
            margin-top: auto;
        }
    </style>
@endsection