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
        <div class="filter-container">
            <form action="{{ route('informasi-kegiatan') }}" method="GET" class="filter-form">
                <!-- Hidden search value -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                
                <div class="filter-group">
                    <!-- Filter Bidang -->
                    <div class="filter-wrapper">
                        <svg class="filter-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <select name="bidang" class="filter-select">
                            <option value="">Semua Bidang</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="Bidang {{ $i }}" {{ request('bidang') == "Bidang $i" ? 'selected' : '' }}>
                                    Bidang {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="filter-wrapper">
                        <svg class="filter-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-date" placeholder="Pilih Tanggal">
                    </div>

                    <!-- Tombol Reset Filter -->
                    @if(request('bidang') || request('tanggal') || request('search'))
                    <a href="{{ route('informasi-kegiatan') }}" class="reset-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                            <path d="M21 3v5h-5"></path>
                            <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                            <path d="M3 21v-5h5"></path>
                        </svg>
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <script>
            // Auto submit saat bidang atau tanggal dipilih
            const filterForm = document.querySelector('.filter-form');
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
        /* Filter Container - Clean & Simple */
        .filter-container {
            margin-top: 1.5rem;
        }

        .filter-form {
            width: 100%;
        }

        .filter-group {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-wrapper {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .filter-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #ffd700;
            z-index: 1;
            pointer-events: none;
        }

        /* Filter Select - Dark Elegant */
        .filter-select {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border-radius: 8px;
            border: none;
            background: #0a2540;
            color: white;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23ffd700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 20px;
            padding-right: 3rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-select:hover {
            background: #0d2f52;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-1px);
        }

        .filter-select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.3);
        }

        .filter-select option {
            background: #0a2540;
            color: white;
            padding: 0.5rem;
        }

        /* Filter Date - Dark Elegant */
        .filter-date {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border-radius: 8px;
            border: none;
            background: #0a2540;
            color: white;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-date::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .filter-date:hover {
            background: #0d2f52;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-1px);
        }

        .filter-date:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.3);
        }

        /* Reset Button - Compact & Clear */
        .reset-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.25rem;
            background: #ef4444;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9375rem;
            white-space: nowrap;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
            flex-shrink: 0;
        }

        .reset-btn:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .reset-btn:active {
            transform: translateY(0);
        }

        .reset-btn svg {
            transition: transform 0.3s ease;
        }

        .reset-btn:hover svg {
            transform: rotate(180deg);
        }

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

        /* Responsive Design */
        @media (max-width: 768px) {
            .filter-group {
                flex-direction: column;
                align-items: stretch;
                gap: 0.75rem;
            }

            .filter-wrapper {
                min-width: 100%;
                width: 100%;
            }

            .reset-btn {
                width: 100%;
                justify-content: center;
            }

            .filter-select,
            .filter-date {
                font-size: 0.875rem;
                padding: 0.75rem 0.875rem 0.75rem 2.75rem;
            }

            .filter-icon {
                left: 0.875rem;
            }
        }
    </style>
@endsection