@extends('layouts.app')

@section('title', 'E-Katalog - HIPMI Jawa Barat')

@section('content')

    <section class="page-banner">
        <h1>E-Katalog</h1>
        <p>Anggota & Pengurus HIPMI Jawa Barat</p>
    </section>
    
    <section class="search-katalog">
        <form action="{{ route('e-katalog') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Cari nama perusahaan atau bidang..." value="{{ request('search') }}">
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <i class="fa fa-search"></i>
            </button>
        </form>
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
                <h3>{{ request('search') ? 'Tidak ada hasil pencarian' : 'Belum ada katalog tersedia' }}</h3>
                <p>{{ request('search') ? 'Coba kata kunci lain' : 'Silakan cek kembali nanti' }}</p>
            </div>
        @endforelse
    </section>

    @if($katalogs->hasPages())
        <div style="display: flex; justify-content: center; padding: 2rem 100px 4rem;">
            {{ $katalogs->links() }}
        </div>
    @endif

@endsection