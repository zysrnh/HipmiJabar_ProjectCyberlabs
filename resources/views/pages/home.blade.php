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
            <img src="{{  asset('images/hipmi-logo.png') }}" alt="HIPMI Logo">
        </div>
    </section>

    <section class="main-info">
        <div class="info-card">
            <img src="{{ asset('images/icons/users.png')  }}" alt="Anggota" class="icon">
            <h2><span class="counter" data-target="23">0</span></h2>
            <h3>Anggota</h3>
        </div>
        <div class="info-card">
            <img src="{{ asset('images/icons/building.png')  }}" alt="Perusahaan" class="icon">
            <h2><span class="counter" data-target="23">0</span></h2>
            <h3>Perusahaan</h3>
        </div>
        <div class="info-card">
            <img src="{{ asset('images/icons/folder.png')  }}" alt="Klasifikasi Usaha" class="icon">
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

    <section class="misi">
        <div class="yellow-accent" style="align-self: center; !important"></div>
        <h2>Misi Kami</h2>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Peningkatan standar kualitas berbisnis anggota.</h2>
                <p>1. Pelatihan Bisnis Berkala <br>2. Kolaborasi dengan lembaga pelatihan kredibel</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-1.png') }}" alt="Misi Image">
            </div>
        </div>
        <div class="misi-content-reverse">
            <div class="misi-text">
                <h2>Penguatan Kaderisasi anggota.</h2>
                <p>Memperkuat program kaderisasi berkelanjutan dan berkualitas</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-2.png') }}" alt="Misi Image">
            </div>
        </div>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Pengelolaan organisasi yang profesional dan akuntabel.</h2>
                <p>Penerapan sistem manajemen organisasi sesuai standar</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-3.png') }}" alt="Misi Image">
            </div>
        </div>
        <div class="misi-content-reverse">
            <div class="misi-text">
                <h2>Pengembangan struktur ekonomi BPC yang mandiri, produktif, dan kolaboratif.</h2>
                <p>1. Mendorong kemandirian keuangan BPC <br>2. Kolaborasi antar BPC dalam kegiatan ekonomi bersama</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-4.png') }}" alt="Misi Image">
            </div>
        </div>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Mendorong kemandirian keuangan BPC kolaborasi antar BPC dalam kegiatan ekonomi bersama.</h2>
                <p>Membangun jaringan kolaborasi HIPMI, BUMN, SWASTA dan Pemerintah daerah</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-5.png') }}" alt="Misi Image">
            </div>
        </div>
    </section>
    <section class="pengumuman">
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>Pengumuman</h2>
        <div class="pengumuman-content">
            <div class="pengumuman-lastest">
                <div class="pengumuman-banner-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="pengumuman-banner-bg">

                    <div class="pengumuman-overlay"></div>

                    <div class="pengumuman-banner-content">
                        <!-- <span class="pengumuman-badge">Pengumuman</span> -->
                        <h2>Presiden Joko Widodo Buka Rakernas HIPMI Ke-XVIII</h2>
                        <p class="pengumuman-date">Oktober 28, 2025</p>

                        <a href="#" class="pengumuman-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>
            <div class="pengumuman-others">
                <div class="pengumuman-others-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="pengumuman-others-banner">

                    <div class="pengumuman-others-content">
                        <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                        <p class="pengumuman-date">Oktober 28, 2025</p>

                        <a href="#" class="pengumuman-others-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
                <div class="pengumuman-others-card">
                    <img src="{{ asset('images/missions/mission-1.png') }}" class="pengumuman-others-banner">

                    <div class="pengumuman-others-content">
                        <h2>HIPMI Banten Diminta Jawab Tantangan Besar Pengangguran</h2>
                        <p class="pengumuman-date">Oktober 28, 2025</p>

                        <a href="#" class="pengumuman-others-btn-more">Lihat Lebih Banyak</a>
                    </div>
                </div>
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
    </section>
    <section class="events">
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>Acara Kami di HIPMI</h2>
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

    </section>

    <section class="ekatalog-home">
        <div class="green-accent" style="align-self: center; !important"></div>
        <h2>E-Katalog Bisnis HIPMI Jabar</h2>
        <div class="e-katalog-content-home">
            <!-- Looping dari sini cuy -->
            <a href="{{ route('e-katalog.detail') }}">
                <div class="katalog-card">
                    <img src="{{ asset('images/hipmi-logo.png') }}">
                    <div class="container">
                        <h4><b>{{ Str::limit('Nama Perusahaan', 20, '...') }}</b></h4>
                        <p>Bidang Perusahaan</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('e-katalog.detail') }}">
                <div class="katalog-card">
                    <img src="{{ asset('images/hipmi-logo.png') }}">
                    <div class="container">
                        <h4><b>{{ Str::limit('Nama Perusahaan', 20, '...') }}</b></h4>
                        <p>Bidang Perusahaan</p>
                    </div>
                </div>
            </a>
        </div>
        <div style="margin-top: 50px;">
            <a href="#" class="btn-ekatalog-home">Lihat Lebih Banyak</a>
        </div>
    </section>
    <section class="daftarkan-bisnis-anda">
        <img src="{{ asset('images/maju-babarengan.png') }}" alt="">
        <h1>DAFTARKAN BISNIS ANDA</h1>
        <a href="#" class="btn">Lihat Lebih Banyak</a>

    </section>
@endsection