@extends('layouts.app')

@section('title', 'E-Katalog - HIPMI Jawa Barat')

@section('content')

    <section class="page-banner">
        <h1>E-Katalog</h1>
        <p>Anggota & Pengurus HIPMI Jawa Barat</p>
    </section>
    
    <section class="search-katalog">
        <!-- Search Box -->
        <div class="search-wrapper">
            <form action="{{ route('e-katalog') }}" method="GET" class="search-box-enhanced">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" name="search" placeholder="Cari nama perusahaan atau bidang usaha..." value="{{ request('search') }}" class="search-input">
                <button type="submit" class="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('e-katalog') }}" method="GET" class="filter-form">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <div class="filter-grid">
                    <!-- Filter Bidang -->
                    <div class="filter-item">
                        <label class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            Bidang
                        </label>
                        <select name="bidang" class="filter-select">
                            <option value="">Semua Bidang</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="bidang_{{ $i }}" {{ request('bidang') == "bidang_$i" ? 'selected' : '' }}>
                                Bidang {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Filter Tipe (Anggota atau Pengurus) -->
                    <div class="filter-item">
                        <label class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Tipe Katalog
                        </label>
                        <select name="tipe" class="filter-select">
                            <option value="">Semua Tipe</option>
                            <option value="anggota" {{ request('tipe') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="pengurus" {{ request('tipe') == 'pengurus' ? 'selected' : '' }}>Pengurus HIPMI</option>
                        </select>
                    </div>

                    <!-- Reset Button -->
                    @if(request('bidang') || request('tipe') || request('search'))
                    <div class="filter-item filter-reset">
                        <a href="{{ route('e-katalog') }}" class="reset-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                                <path d="M21 3v5h-5"></path>
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                                <path d="M3 21v-5h5"></path>
                            </svg>
                            Reset Filter
                        </a>
                    </div>
                    @endif
                </div>
            </form>
        </div>

        <script>
            // Auto submit saat filter dipilih
            const filterForm = document.querySelector('.filter-form');
            const bidangSelect = filterForm?.querySelector('select[name="bidang"]');
            const tipeSelect = filterForm?.querySelector('select[name="tipe"]');

            if (bidangSelect) {
                bidangSelect.addEventListener('change', function() {
                    filterForm.submit();
                });
            }

            if (tipeSelect) {
                tipeSelect.addEventListener('change', function() {
                    filterForm.submit();
                });
            }
        </script>
    </section>

    <section class="e-katalog-content">
        @forelse($katalogs as $katalog)
            <a href="{{ route('e-katalog.detail', $katalog->id) }}">
                <div class="katalog-card">
                    <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}">
                    <div class="container">
                        <h4><b>{{ Str::limit($katalog->company_name, 25, '...') }}</b></h4>
                        <p>{{ Str::limit($katalog->business_field, 30, '...') }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #6b7280;">
                <svg viewBox="0 0 24 24" style="width: 80px; height: 80px; margin: 0 auto 1rem; stroke: #d1d5db;" fill="none" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <line x1="9" y1="9" x2="15" y2="9"/>
                    <line x1="9" y1="15" x2="15" y2="15"/>
                </svg>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #374151; margin-bottom: 0.5rem;">
                    {{ request('search') || request('bidang') || request('tipe') ? 'Tidak ada hasil yang ditemukan' : 'Belum ada katalog tersedia' }}
                </h3>
                <p style="font-size: 0.9375rem; color: #6b7280;">
                    {{ request('search') || request('bidang') || request('tipe') ? 'Coba ubah filter atau kata kunci pencarian Anda' : 'Silakan cek kembali nanti' }}
                </p>
            </div>
        @endforelse
    </section>

    @if($katalogs->hasPages())
        <div style="display: flex; justify-content: center; padding: 2rem 100px 4rem;">
            {{ $katalogs->links() }}
        </div>
    @endif

<style>
    /* ========== SEARCH & FILTER STYLES ========== */
    
    .search-katalog {
        max-width: 1200px;
        margin: 0 auto 3rem;
        padding: 0 2rem;
    }

    /* Search Box Enhanced */
    .search-wrapper {
        margin-bottom: 1.5rem;
    }

    .search-box-enhanced {
        position: relative;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(10, 37, 64, 0.12);
        display: flex;
        align-items: center;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .search-box-enhanced:focus-within {
        box-shadow: 0 12px 40px rgba(10, 37, 64, 0.18);
        transform: translateY(-2px);
    }

    .search-icon {
        position: absolute;
        left: 1.5rem;
        color: #9ca3af;
        transition: color 0.3s ease;
        pointer-events: none;
        z-index: 2;
    }

    .search-box-enhanced:focus-within .search-icon {
        color: #ffd700;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 1rem 1rem 1rem 3.5rem;
        font-size: 1rem;
        color: #1f2937;
        font-family: 'Montserrat', sans-serif;
        background: transparent;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .search-button {
        background: linear-gradient(135deg, #0a2540 0%, #0d2f52 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(10, 37, 64, 0.3);
    }

    .search-button:hover {
        background: linear-gradient(135deg, #0d2f52 0%, #0a2540 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(10, 37, 64, 0.4);
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(10, 37, 64, 0.08);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        align-items: end;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.25rem;
        font-family: 'Montserrat', sans-serif;
    }

    .filter-label svg {
        color: #ffd700;
    }

    .filter-select {
        width: 100%;
        padding: 0.875rem 1rem;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        background: #f9fafb;
        color: #1f2937;
        font-weight: 500;
        font-size: 0.9375rem;
        font-family: 'Montserrat', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%230a2540' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-color: #f9fafb;
        padding-right: 2.5rem;
    }

    .filter-select:hover {
        border-color: #ffd700;
        background: white;
    }

    .filter-select:focus {
        outline: none;
        border-color: #0a2540;
        background: white;
        box-shadow: 0 0 0 3px rgba(10, 37, 64, 0.1);
    }

    .filter-reset {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.875rem 1.5rem;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9375rem;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        margin-top: 1.875rem;
    }

    .reset-btn:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
    }

    .reset-btn svg {
        transition: transform 0.3s ease;
    }

    .reset-btn:hover svg {
        transform: rotate(180deg);
    }

    /* Responsive - Search & Filter */
    @media (max-width: 768px) {
        .search-katalog {
            padding: 0 1rem;
        }

        .search-box-enhanced {
            flex-direction: column;
            padding: 0.75rem;
            gap: 0.75rem;
        }

        .search-input {
            padding: 0.875rem 1rem;
        }

        .search-icon {
            display: none;
        }

        .search-button {
            width: 100%;
        }

        .filter-section {
            padding: 1.5rem;
        }

        .filter-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .reset-btn {
            margin-top: 0.5rem;
        }
    }
</style>

@endsection