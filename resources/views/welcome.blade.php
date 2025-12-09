@extends('layouts.app')

@section('title', 'Welcome - Frontend Hipmi Jabar')

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
        <div class="yellow-accent"></div>
        <h2>Misi Kami</h2>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Peningkatan standar kualitas berbisnis anggota.</h2>
                <p>1. Pelatihan Bisnis Berkala <br>2. Kolaborasi dengan lembaga pelatihan kredibel</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-1.png') }}" alt="Misi Image 1">
            </div>
        </div>
        <div class="misi-content-reverse">
            <div class="misi-text">
                <h2>Penguatan Kaderisasi anggota.</h2>
                <p>Memperkuat program kaderisasi berkelanjutan dan berkualitas</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-2.png') }}" alt="Misi Image 1">
            </div>
        </div>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Pengelolaan organisasi yang profesional dan akuntabel.</h2>
                <p>Penerapan sistem manajemen organisasi sesuai standar</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-3.png') }}" alt="Misi Image 1">
            </div>
        </div>
        <div class="misi-content-reverse">
            <div class="misi-text">
                <h2>Pengembangan struktur ekonomi BPC yang mandiri, produktif, dan kolaboratif.</h2>
                <p>1. Mendorong kemandirian keuangan BPC <br>2. Kolaborasi antar BPC dalam kegiatan ekonomi bersama</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-4.png') }}" alt="Misi Image 1">
            </div>
        </div>
        <div class="misi-content">
            <div class="misi-text">
                <h2>Mendorong kemandirian keuangan BPC kolaborasi antar BPC dalam kegiatan ekonomi bersama.</h2>
                <p>Membangun jaringan kolaborasi HIPMI, BUMN, SWASTA dan Pemerintah daerah</p>
            </div>
            <div class="misi-image">
                <img src="{{ asset('images/missions/mission-5.png') }}" alt="Misi Image 1">
            </div>
        </div>

    </section>
@endsection