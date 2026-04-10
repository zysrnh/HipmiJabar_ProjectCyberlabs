@extends('layouts.app')

@section('title', $katalog->company_name . ' - E-Katalog HIPMI Jawa Barat')

@section('content')
<style>
    .detail-katalog-public-info {
    padding: 40px 100px;
    max-width: 100%;
    box-sizing: border-box;
}

.public-info-title {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid #e5e7eb;
    text-align: center;
}

.public-info-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.public-info-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 20px;
    background-color: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    transition: background-color 0.2s ease;
}

.public-info-item:hover {
    background-color: #f0f4ff;
    border-color: #c7d2fe;
}

.public-info-icon {
    font-size: 16px;
    color: #6366f1;
    margin-top: 3px;
    flex-shrink: 0;
}

.public-info-item > div {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.public-info-label {
    font-size: 12px;
    font-weight: 500;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.public-info-value {
    font-size: 15px;
    font-weight: 500;
    color: #111827;
}

@media (max-width: 768px) {
    .detail-katalog-public-info {
        padding: 24px 20px;
    }
}
</style>

    <section class="page-banner-2">
        <div class="detail-katalog-info">
            <a href="{{ route('e-katalog') }}" class="fa fa-arrow-left back-button"></a>
            <h1>{{ $katalog->company_name }}</h1>
            <p>{{ $katalog->business_field }}</p>
        </div>
        <div class="detail-katalog-logo">
            <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}">
        </div>
    </section>

    <section class="detail-katalog-text">
        <p>{{ $katalog->description }}</p>
    </section>

    {{-- Info publik: selalu tampil tanpa perlu login --}}
    @if($katalog->anggota)
        <section class="detail-katalog-public-info">
            <h2 class="public-info-title">Informasi Anggota</h2>
            <div class="public-info-grid">

                {{-- Nama --}}
                <div class="public-info-item">
                    <i class="fa fa-user public-info-icon"></i>
                    <div>
                        <span class="public-info-label">Nama</span>
                        <span class="public-info-value">{{ $katalog->anggota->nama_usaha }}</span>
                    </div>
                </div>

                {{-- Jabatan di Organisasi --}}
                @if($katalog->anggota->organisasi)
                    <div class="public-info-item">
                        <i class="fa fa-sitemap public-info-icon"></i>
                        <div>
                            <span class="public-info-label">Jabatan di Organisasi</span>
                            <span class="public-info-value">{{ $katalog->anggota->organisasi->jabatan }}</span>
                        </div>
                    </div>
                @endif

                {{-- Jabatan di Usaha & Nama Usaha --}}
                @if($katalog->anggota->jabatan_usaha || $katalog->anggota->nama_usaha_perusahaan)
                    <div class="public-info-item">
                        <i class="fa fa-briefcase public-info-icon"></i>
                        <div>
                            <span class="public-info-label">Jabatan di Usaha</span>
                            <span class="public-info-value">
                                {{ implode(' — ', array_filter([$katalog->anggota->jabatan_usaha, $katalog->anggota->nama_usaha_perusahaan])) }}
                            </span>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif

    {{-- Hanya tampilkan gambar jika user terverifikasi --}}
    @if($canViewFullDetail && $katalog->images && count($katalog->images_url) > 0)
        <section class="detail-katalog-images">
            @foreach($katalog->images_url as $imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $katalog->company_name }}">
            @endforeach
        </section>
    @endif

    {{-- Hanya tampilkan kontak dan map jika user terverifikasi --}}
    @if($canViewFullDetail)
        <section class="detail-katalog-contact-map">
            <div class="detail-katalog-contact">
                <h1>Kontak</h1>
                <div>
                    <div class="footer-item-child">
                        <i class="fa fa-map-marker footer-social-icons"></i>
                        <p>{{ $katalog->address }}</p>
                    </div>
                    <div class="footer-item-child">
                        <i class="fa fa-phone footer-social-icons"></i>
                        <p>{{ $katalog->phone }}</p>
                    </div>
                    <div class="footer-item-child">
                        <i class="fa fa-envelope footer-social-icons"></i>
                        <p>{{ $katalog->email }}</p>
                    </div>
                </div>
            </div>

            @if($katalog->map_embed_url)
                <div class="detail-catalog-contact">
                    <iframe class="map-embed" src="{{ $katalog->map_embed_url }}" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
        </section>
    @endif

@endsection