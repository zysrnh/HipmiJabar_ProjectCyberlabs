<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIPMI Jabar</title>
</head>

<body>
    <header>
        <div class="header-container">
            <nav>
                <div class="logo">
                    <img class="logo1" src="{{ asset('images/hipmi-logo.png') }}" alt="Logo 1">
                    <img class="logo2" src="{{ asset('images/maju-babarengan.png') }}" alt="Logo 2">
                </div>

                <div class="menu-toggle" id="menu-toggle">
                    <i class="fa fa-bars"></i>
                </div>

                <div class="menu" id="menu">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('organisasi') }}"
                        class="nav-link {{ Request::routeIs('organisasi') ? 'active' : '' }}">
                        Organisasi
                    </a>
                    <a href="{{ route('e-katalog') }}"
                        class="nav-link {{ Request::routeIs('e-katalog') ? 'active' : '' }}">
                        E-Katalog
                    </a>
                    <a href="{{ route('berita') }}" class="nav-link {{ Request::routeIs('berita') ? 'active' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('umkm') }}" class="nav-link {{ Request::routeIs('umkm') ? 'active' : '' }}">
                        UMKM
                    </a>
                    <div class="buttons-mobile">
                        @auth('anggota')
                            <a href="{{ route('profile-anggota') }}" class="btn-transparent">Profile Anggota</a>
                        @else
                            <a href="{{ route('jadi-anggota') }}" class="btn-transparent">Jadi Anggota</a>
                        @endauth
                        
                        @auth('admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn">Dashboard</a>
                        @else
                            @auth('anggota')
                                {{-- Anggota sudah login, tidak perlu tombol login admin --}}
                            @else
                                <a href="{{ route('admin.login') }}" class="btn">Login</a>
                            @endauth
                        @endauth
                    </div>
                </div>

                <div class="buttons">
                    @auth('anggota')
                        <a href="{{ route('profile-anggota') }}" class="btn-transparent">Profile Anggota</a>
                    @else
                        <a href="{{ route('jadi-anggota') }}" class="btn-transparent">Jadi Anggota</a>
                    @endauth
                    
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn">Dashboard</a>
                    @else
                        @auth('anggota')
                            {{-- Anggota sudah login, tidak perlu tombol login admin --}}
                        @else
                            <a href="{{ route('admin.login') }}" class="btn">Login</a>
                        @endauth
                    @endauth
                </div>
            </nav>
        </div>
    </header>
</body>

</html>