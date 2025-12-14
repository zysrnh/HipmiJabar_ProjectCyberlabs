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
            <h2><span class="counter" data-target="23">0</span></h2>
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

   {{-- Ganti section misi yang lama dengan kode ini --}}

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
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>Buku Informasi Anggota HIPMI Jabar</h2>
        <div class="buku-informasi-home-content">
            <div class="owl-carousel anggota-carousel">
                @forelse($katalogs as $katalog)
                    <a href="{{ route('e-katalog.detail', $katalog->id) }}">
                        <div class="buku-card">
                            <img src="{{ $katalog->logo_url }}" alt="{{ $katalog->company_name }}">
                            <div class="container">
                                <h4><b>{{ Str::limit($katalog->company_name, 20, '...') }}</b></h4>
                                <p>{{ Str::limit($katalog->business_field, 25, '...') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <a href="{{ route('e-katalog') }}">
                        <div class="buku-card">
                            <img src="{{ asset('images/hipmi-logo.png') }}">
                            <div class="container">
                                <h4><b>Belum Ada Data</b></h4>
                                <p>Klik untuk lihat katalog</p>
                            </div>
                        </div>
                    </a>
                @endforelse
            </div>

            <div style="text-align:center; margin-top:25px;">
                <a href="{{ route('e-katalog') }}" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
            </div>
        </div>
    </section>

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

    <section class="events">
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>Informasi Kegiatan BPD</h2>
        <div class="events-content">
            <div class="events-lastest">
                <div class="events-banner-card-lastest">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="events-banner-bg">

                    <div class="events-overlay"></div>

                    <div class="events-banner-content">
                        <!-- <span class="events-badge">events</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="events-date">Oktober 28, 2025</p>

                        <a href="#" class="events-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>
            <div class="events-others">
                <div class="events-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="events-banner-bg">

                    <div class="events-overlay"></div>

                    <div class="events-banner-content">
                        <!-- <span class="events-badge">events</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="events-date">Oktober 28, 2025</p>

                        <a href="#" class="events-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
                <div class="events-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="events-banner-bg">

                    <div class="events-overlay"></div>

                    <div class="events-banner-content">
                        <!-- <span class="events-badge">events</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="events-date">Oktober 28, 2025</p>

                        <a href="#" class="events-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
                <div class="events-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="events-banner-bg">

                    <div class="events-overlay"></div>

                    <div class="events-banner-content">
                        <!-- <span class="events-badge">events</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="events-date">Oktober 28, 2025</p>

                        <a href="#" class="events-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
                <div class="events-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="events-banner-bg">

                    <div class="events-overlay"></div>

                    <div class="events-banner-content">
                        <!-- <span class="events-badge">events</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="events-date">Oktober 28, 2025</p>

                        <a href="#" class="events-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>
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
        <a href="#" class="btn">Lihat Lebih Banyak</a>
    </section>

    <section class="berita-home">
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>Berita & Dokumentasi</h2>
        <div class="berita-home-content">
            <div class="berita-home-lastest">
                <div class="berita-home-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-banner-bg">

                    <div class="berita-home-overlay"></div>

                    <div class="berita-home-banner-content">
                        <!-- <span class="berita-home-badge">berita-home</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <a href="#" class="berita-home-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>
            <div class="berita-home-others">
                <div class="berita-home-others-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-others-banner">

                    <div class="berita-home-others-content">
                        <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <a href="#" class="berita-home-others-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
                <div class="berita-home-others-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-others-banner">

                    <div class="berita-home-others-content">
                        <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <a href="#" class="berita-home-others-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="berita-home-more">
            <div class="berita-home-others-card">
                <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-others-banner">

                <div class="berita-home-others-content">
                    <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                    <p class="berita-home-date">Oktober 28, 2025</p>

                    <a href="#" class="berita-home-others-btn-more">Lihat Lebih Banyak</a>
                </div>
            </div>
            <div class="berita-home-others-card">
                <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-others-banner">

                <div class="berita-home-others-content">
                    <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                    <p class="berita-home-date">Oktober 28, 2025</p>

                    <a href="#" class="berita-home-others-btn-more">Lihat Lebih Banyak</a>
                </div>
            </div>
            <div class="berita-home-others-card">
                <img src="{{ asset('images/missions/mission-1.png') }}" class="berita-home-others-banner">

                <div class="berita-home-others-content">
                    <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                    <p class="berita-home-date">Oktober 28, 2025</p>

                    <a href="#" class="berita-home-others-btn-more">Lihat Lebih Banyak</a>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;">
            <a href="#" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
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
    }, { threshold: 0.5 });
    
    counters.forEach(counter => {
        observer.observe(counter);
    });
});
</script>
@endpush