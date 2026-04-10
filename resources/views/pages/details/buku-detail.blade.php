@extends('layouts.app')
@section('title', $anggota->nama_usaha . ' - Buku Informasi Pengurus HIPMI Jawa Barat')
@section('content')
    <section class="page-banner-2">
        <div class="detail-katalog-info">
            <a href="{{ route('buku-anggota') }}" class="fa fa-arrow-left back-button"></a>
            <h1>{{ $anggota->nama_usaha }}</h1>
            <p>{{ $anggota->jabatan_usaha }}</p>
            <br>

            {{-- Info Publik: selalu tampil tanpa login --}}
            <div class="public-info-grid" style="margin-bottom: 16px;">

                {{-- Nama --}}
                <div class="footer-item-child">
                    <i class="fa fa-user footer-social-icons"></i>
                    <p>{{ $anggota->nama_usaha }}</p>
                </div>

                {{-- Jabatan di Organisasi --}}
                @if($anggota->organisasi)
                    <div class="footer-item-child">
                        <i class="fa fa-sitemap footer-social-icons"></i>
                        <p>{{ $anggota->organisasi->jabatan }}</p>
                    </div>
                @endif

                {{-- Jabatan di Usaha & Nama Usaha --}}
                @if($anggota->jabatan_usaha || $anggota->nama_usaha_perusahaan)
                    <div class="footer-item-child">
                        <i class="fa fa-briefcase footer-social-icons"></i>
                        <p>{{ implode(' — ', array_filter([$anggota->jabatan_usaha, $anggota->nama_usaha_perusahaan])) }}</p>
                    </div>
                @endif

            </div>

            {{-- Kontak: hanya tampil jika sudah login --}}
            <div class="detail-katalog-contact">
                @if(
                    auth()->guard('admin')->check() ||
                    auth()->guard('anggota')->check() ||
                    auth()->guard('web')->check()
                )
                    <div>
                        <div class="footer-item-child">
                            <i class="fa fa-map-marker footer-social-icons"></i>
                            <p>{{ $anggota->alamat_kantor }}</p>
                        </div>
                        <div class="footer-item-child">
                            <i class="fa fa-phone footer-social-icons"></i>
                            <p>{{ $anggota->nomor_telepon }}</p>
                        </div>
                        <div class="footer-item-child">
                            <i class="fa fa-envelope footer-social-icons"></i>
                            <p>{{ $anggota->email }}</p>
                        </div>
                    </div>
                @else
                    <div style="background: #f3f4f6; padding: 15px; border-radius: 8px;">
                        <p style="margin: 0; color: #6b7280;">
                            <a href="/anggota/login">Login</a> untuk melihat informasi alamat dan kontak dari {{ $anggota->nama_usaha }}.
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="detail-katalog-photo">
            <img src="{{ $anggota->photo_url }}" alt="{{ $anggota->nama_usaha }}">
        </div>
    </section>

    @if($anggota->deskripsi_detail)
        <section class="detail-katalog-text">
            <p>{{ $anggota->deskripsi_detail }}</p>
        </section>
    @else
        <section class="detail-katalog-text">
            <p style="text-align: center; color: #6b7280; font-style: italic;">
                Deskripsi belum tersedia untuk anggota ini.
            </p>
        </section>
    @endif

    @if($anggota->detail_image_1 || $anggota->detail_image_2 || $anggota->detail_image_3)
        <section class="detail-katalog-images">
            @if($anggota->detail_image_1)
                <img src="{{ $anggota->detail_image_1_url }}" alt="{{ $anggota->nama_usaha }} - Image 1">
            @endif
            @if($anggota->detail_image_2)
                <img src="{{ $anggota->detail_image_2_url }}" alt="{{ $anggota->nama_usaha }} - Image 2">
            @endif
            @if($anggota->detail_image_3)
                <img src="{{ $anggota->detail_image_3_url }}" alt="{{ $anggota->nama_usaha }} - Image 3">
            @endif
        </section>
    @endif
@endsection