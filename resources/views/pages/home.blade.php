@extends('layouts.app')

@section('title', 'HIPMI Jawa Barat')

@section('content')

<section class="hero">
    <div class="hero-1">
        <h1>HIPMI Jawa Barat</h1>
        <p>Sebagai Jembatan Informasi</p>
        <h3>Hayu, kita maju babarengan!</h3>
        <div class="hero-buttons">
            <a href="#" class="btn">Jadi Anggota</a>
            <a href="#" class="fa fa-instagram social-icons"></a>
            <a href="#" class="fa fa-facebook social-icons"></a>
            <a href="#" class="fa fa-linkedin social-icons"></a>
            <a href="#" class="fa fa-youtube social-icons"></a>
        </div>
    </div>
    <div class="hero-2">
        <img src="{{ asset('images/hipmi-logo.png') }}" alt="HIPMI Logo">
    </div>
</section>

<section class="main-info">
    <div class="info-card">
        <img src="{{ asset('images/icons/users.png') }}" alt="Anggota" class="icon">
        <h2><span class="counter" data-target="{{ $totalAnggota }}">0</span></h2>
        <h3>Anggota</h3>
    </div>
    <div class="info-card">
        <img src="{{ asset('images/icons/building.png') }}" alt="Perusahaan" class="icon">
        <h2><span class="counter" data-target="{{ $totalKatalog }}">0</span></h2>
        <h3>Perusahaan</h3>
    </div>
    <div class="info-card">
        <img src="{{ asset('images/icons/folder.png') }}" alt="Klasifikasi Usaha" class="icon">
        <h2><span class="counter" data-target="1">0</span></h2>
        <h3>Klasifikasi Usaha</h3>
    </div>
</section>

<section class="visi">
    <div class="visi-content">
        <h2>Visi Kami</h2>
        <p>Membantu Pengusaha Muda Naik Kelas melalui HIPMI sebagai kontribusi mewujudkan Indonesia Emas 2045</p>
        <h3>Penjelasan :</h3>
        <p>"Naik kelas" didefinisikan sebagai peningkatan kapasitas bisnis melalui beberapa indikator : </p>
        <ul>
            <li>Peningkatan pendapatan tahunan atau omzet</li>
            <li>Ekspansi pasar lokal dan internasional</li>
            <li>Penambahan jumlah tenaga kerja yang diserap oleh anggota HIPMI</li>
        </ul>
    </div>
    <div class="visi-image">
        <img src="{{ asset('images/indonesia-emas-2045.png') }}" alt="Visi Image">
    </div>
</section>


<section class="misi" id="misi">
    <div class="yellow-accent" style="align-self: center; !important"></div>
    <h2>Misi Kami</h2>

    @if($misi->count() > 0)
    @foreach($misi as $index => $item)
    @if($index % 2 === 0)
    {{-- Misi Content (gambar di kanan) --}}
    <div class="misi-content">
        <div class="misi-text">
            <h2>{{ $item->title }}</h2>
            <p>{!! nl2br(e($item->description)) !!}</p>
        </div>
        <div class="misi-image">
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
        </div>
    </div>
    @else
    {{-- Misi Content Reverse (gambar di kiri) --}}
    <div class="misi-content-reverse">
        <div class="misi-text">
            <h2>{{ $item->title }}</h2>
            <p>{!! nl2br(e($item->description)) !!}</p>
        </div>
        <div class="misi-image">
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
        </div>
    </div>
    @endif
    @endforeach
    @else
    {{-- Tampilkan pesan jika belum ada data --}}
    <div style="text-align: center; padding: 3rem 0; color: #6b7280;">
        <p>Belum ada data misi yang tersedia.</p>
    </div>
    @endif
</section>
<section class="buku-informasi-home">
    <div class="green-accent" style="align-self: center;"></div>
    <h2>Buku Informasi Anggota HIPMI Jabar</h2>
    <div class="buku-informasi-home-content">
        <div class="owl-carousel anggota-carousel">
            @forelse($anggotaList as $anggota)
            <a href="{{ route('detail-buku', $anggota->id) }}">
                <div class="buku-card">
                    <img src="{{ $anggota->photo_url }}" alt="{{ $anggota->nama_usaha }}" loading="lazy">
                    <div class="container">
                        <h4><b>{{ $anggota->nama_usaha }}</b></h4>
                        <p>{{ Str::limit($anggota->nama_usaha_perusahaan ?? 'Perusahaan Tidak Disebutkan', 30, '...') }}</p>
                    </div>
                </div>
            </a>
            @empty
            <a href="{{ route('buku-anggota') }}">
                <div class="buku-card">
                    <img src="{{ asset('images/hipmi-logo.png') }}" alt="HIPMI Logo">
                    <div class="container">
                        <h4><b>Belum Ada Anggota</b></h4>
                        <p>Klik untuk lihat daftar</p>
                    </div>
                </div>
            </a>
            @endforelse
        </div>

        <div style="text-align:center; margin-top:25px;">
            <a href="{{ route('buku-anggota') }}" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
        </div>
    </div>
</section>

<style>
    /* ================== BUKU INFORMASI HOME SECTION ================== */
    .buku-informasi-home {
        display: flex;
        flex-direction: column;
        padding: 100px;
        background-color: #f9f9f9;
        text-align: center;
    }

    .buku-informasi-home>h2 {
        font-size: 30px;
        color: #04293B;
        margin-bottom: 50px;
        text-align: center;
    }

    .buku-informasi-home-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .anggota-carousel a {
        color: #04293B;
        text-decoration: none;
    }

    /* Buku Card Styling */
    .buku-card {
        padding: 30px;
        text-align: center;
        border: 1px solid #04293B;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .buku-card:hover {
        cursor: pointer;
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(4, 41, 59, 0.2);
    }

    .buku-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        object-position: center;
        margin-bottom: 20px;
        border: #04293B 1px solid;
        border-radius: 10px;
        background-color: #f0f0f0;
    }

    .buku-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #04293B;
        font-weight: 600;
    }

    .buku-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    .buku-card .container {
        padding: 0 10px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Button */
    .btn-ekatalog-home {
        display: inline-block;
        padding: 12px 30px;
        background: #04293B;
        border: #04293B 1px solid;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-ekatalog-home:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(4, 41, 59, 0.3);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .buku-informasi-home {
            padding: 50px 30px;
            justify-content: center;
        }

        .buku-informasi-home>h2 {
            font-size: 25px;
            margin-bottom: 30px;
        }

        .buku-card {
            padding: 20px;
        }

        .buku-card img {
            height: 180px;
        }

        .buku-card h4 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .buku-card p {
            font-size: 13px;
        }

        .btn-ekatalog-home {
            padding: 10px 20px;
            font-size: 14px;
        }
    }

    @media (max-width: 768px) {
        .buku-informasi-home {
            padding: 40px 20px;
        }

        .buku-informasi-home>h2 {
            font-size: 22px;
        }

        .buku-card img {
            height: 150px;
        }

        .buku-card h4 {
            font-size: 15px;
        }

        .buku-card p {
            font-size: 12px;
        }
    }
</style>

<section class="strategic-plan">
    <div class="strategic-plan-content">
        <div class="strategic-plan-image">
            <img src="{{ asset('images/strategic-plan1.png') }}" alt="Misi Image">
        </div>
        <div class="strategic-plan-wrapper">
            <div class="green-accent" style="background-color: red; !important"></div>
            <h1>Strategic Plan HIPMI JABAR</h1>
            <div href="#" class="strategic-plan-cards">
                <!-- Looping satu disini -->
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <!-- Looping sampe sini -->
            </div>
        </div>
    </div>
    <div class="strategic-plan-content-reverse">
        <div class="strategic-plan-image-reverse">
            <img src="{{ asset('images/strategic-plan2.png') }}" alt="Misi Image">
        </div>
        <div class="strategic-plan-wrapper">
            <div class="green-accent"></div>
            <h1>Program dan Layanan</h1>

            <div href="#" class="strategic-plan-cards">
                <!-- Looping satu disini -->
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <!-- Looping sampe sini -->

                <!-- Dummy -->
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <a href="#" class="strategic-plan-card">
                    <h2>Tata Kelola organisasi</h2><i class="fa fa-arrow-right"></i>
                </a>
                <!-- Dummy -->
            </div>
        </div>
    </div>
</section>

{{-- SECTION INFORMASI KEGIATAN BPD --}}
<section class="events">
    <div class="green-accent" style="align-self: center;"></div>
    <h2>Informasi Kegiatan BPD</h2>
    <div class="events-content">
        @if($kegiatanBerita->count() > 0)
            {{-- Berita Featured (Terbesar) --}}
            <div class="events-lastest">
                <a class="events-hover" href="{{ route('berita-detail', $kegiatanBerita->first()->slug) }}" style="text-decoration: none; color: white;">
                    <div class="events-banner-card-lastest">
                        <img src="{{ $kegiatanBerita->first()->gambar_url }}" class="events-banner-bg" alt="{{ $kegiatanBerita->first()->judul }}">

                        <div class="events-overlay"></div>

                        <div class="events-banner-content">
                            <h2>{{ Str::limit($kegiatanBerita->first()->judul, 80) }}</h2>
                            <p class="events-date">{{ $kegiatanBerita->first()->tanggal_format }}</p>
                            <a href="{{ route('berita-detail', $kegiatanBerita->first()->slug) }}" class="events-btn-more">Lihat Lebih Banyak</a>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Berita Lainnya (4 berita dalam grid) --}}
            <div class="events-others">
                @foreach($kegiatanBerita->skip(1)->take(4) as $berita)
                    <a href="{{ route('berita-detail', $berita->slug) }}" style="text-decoration: none; color: white;">
                        <div class="events-banner-card">
                            <img src="{{ $berita->gambar_url }}" class="events-banner-bg" alt="{{ $berita->judul }}">

                            <div class="events-overlay"></div>

                            <div class="events-banner-content" style="left: 20px; bottom: 20px;">
                                <h2>{{ Str::limit($berita->judul, 60) }}</h2>
                                <p class="events-date">{{ $berita->tanggal_format }}</p>
                                <span class="events-btn-more">Lihat Lebih Banyak</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 3rem 0; color: #ffffff;">
                <p>Belum ada informasi kegiatan yang tersedia.</p>
            </div>
        @endif
    </div>
    <div style="text-align:center; margin-top: 50px;">
        <a href="{{ route('informasi-kegiatan') }}" class="btn">Lihat Lebih Banyak</a>
    </div>
</section>
<section class="ekatalog-home">
    <div class="green-accent" style="align-self: center; !important"></div>
    <h2>E-Katalog Bisnis HIPMI Jabar</h2>
    <div class="e-katalog-content-home">
        @forelse($katalogs->take(2) as $katalog)
        <a href="{{ route('e-katalog.detail', $katalog->id) }}">
            <div class="katalog-card">
                <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}">
                <div class="container">
                    <h4><b>{{ Str::limit($katalog->company_name, 20, '...') }}</b></h4>
                    <p>{{ Str::limit($katalog->business_field, 25, '...') }}</p>
                </div>
            </div>
        </a>
        @empty
        <a href="{{ route('e-katalog') }}">
            <div class="katalog-card">
                <img src="{{ asset('images/hipmi-logo.png') }}">
                <div class="container">
                    <h4><b>Belum Ada Data</b></h4>
                    <p>Klik untuk lihat katalog</p>
                </div>
            </div>
        </a>
        @endforelse
    </div>
    <div style="margin-top: 50px;">
        <a href="{{ route('e-katalog') }}" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
    </div>
</section>

<section class="daftarkan-bisnis-anda">
    <img src="{{ asset('images/maju-babarengan.png') }}" alt="">
    <h1>DAFTARKAN BISNIS ANDA</h1>
    <a href="{{ route('umkm') }}" class="btn">Daftar Bisnis</a>
</section>

{{-- SECTION BERITA & DOKUMENTASI --}}
<section class="berita-home">
    <div class="green-accent" style="align-self: center;"></div>
    <h2>Berita & Dokumentasi</h2>
    
    @if($dokumentasiBerita->count() > 0)
        <div class="berita-home-content">
            {{-- Berita Featured (Terbesar) --}}
            <div class="berita-home-lastest">
                <a href="{{ route('berita-detail', $dokumentasiBerita->first()->slug) }}" style="text-decoration: none; color: white;">
                    <div class="berita-home-banner-card">
                        <img src="{{ $dokumentasiBerita->first()->gambar_url }}" class="berita-home-banner-bg" alt="{{ $dokumentasiBerita->first()->judul }}">

                        <div class="berita-home-overlay"></div>

                        <div class="berita-home-banner-content">
                            <h2>{{ Str::limit($dokumentasiBerita->first()->judul, 80) }}</h2>
                            <p class="berita-home-date">{{ $dokumentasiBerita->first()->tanggal_format }}</p>
                            <span class="berita-home-btn-more">Lihat Lebih Banyak</span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Berita Others (2 berita tengah) --}}
            <div class="berita-home-others">
                @foreach($dokumentasiBerita->skip(1)->take(2) as $berita)
                    <a href="{{ route('berita-detail', $berita->slug) }}" style="text-decoration: none; color: #04293B;">
                        <div class="berita-home-others-card">
                            <img src="{{ $berita->gambar_url }}" class="berita-home-others-banner" alt="{{ $berita->judul }}">

                            <div class="berita-home-others-content">
                                <h2>{{ Str::limit($berita->judul, 60) }}</h2>
                                <p class="berita-home-date">{{ $berita->tanggal_format }}</p>
                                <span class="berita-home-others-btn-more">Lihat Lebih Banyak</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Berita More (3 berita bawah) --}}
        @if($dokumentasiBerita->count() > 3)
            <div class="berita-home-more">
                @foreach($dokumentasiBerita->skip(3)->take(3) as $berita)
                    <a href="{{ route('berita-detail', $berita->slug) }}" style="text-decoration: none; color: #04293B;">
                        <div class="berita-home-others-card">
                            <img src="{{ $berita->gambar_url }}" class="berita-home-others-banner" alt="{{ $berita->judul }}">

                            <div class="berita-home-others-content">
                                <h2>{{ Str::limit($berita->judul, 60) }}</h2>
                                <p class="berita-home-date">{{ $berita->tanggal_format }}</p>
                                <span class="berita-home-others-btn-more">Lihat Lebih Banyak</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 3rem 0; color: #6b7280;">
            <p>Belum ada berita dan dokumentasi yang tersedia.</p>
        </div>
    @endif

    <div style="margin-top: 50px;">
        <a href="{{ route('berita') }}" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 detik
            const increment = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        };

        // Intersection Observer untuk animasi saat scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>
@endpush