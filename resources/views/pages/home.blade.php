@extends('layouts.app')

@section('title', 'HIPMI Jawa Barat')

@section('content')

<section class="hero">
    <div class="hero-1">
        <h1>HIPMI Jawa Barat</h1>
        <p>Sebagai Jembatan Informasi</p>
        <h3>Hayu, kita maju babarengan!</h3>
        <div class="hero-buttons">
            <a href="{{ route('jadi-anggota') }}" class="btn">Jadi Anggota</a>
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
        <h2>
            @if($totalAnggota == 0)
                0
            @else
                <span class="counter" data-target="{{ $totalAnggota }}">0</span>
            @endif
        </h2>
        <h3>Anggota</h3>
    </div>
    <div class="info-card">
        <img src="{{ asset('images/icons/building.png') }}" alt="Perusahaan" class="icon">
        <h2>
            @if($totalKatalog == 0)
                0
            @else
                <span class="counter" data-target="{{ $totalKatalog }}">0</span>
            @endif
        </h2>
        <h3>Perusahaan</h3>
    </div>
    <div class="info-card">
        <img src="{{ asset('images/icons/folder.png') }}" alt="Klasifikasi Usaha" class="icon">
        <h2>
            @if($totalUmkm == 0)
                0
            @else
                <span class="counter" data-target="{{ $totalUmkm }}">0</span>
            @endif
        </h2>
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
    <div class="yellow-accent" style="align-self: center;"></div>
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
            <img src="{{ asset('images/strategic-plan1.png') }}" alt="Strategic Plan Image">
        </div>
        <div class="strategic-plan-wrapper">
            <div class="green-accent"></div>
            <h1>Strategic Plan HIPMI JABAR</h1>
            <div class="strategic-plan-cards">
                @forelse($tataKelola as $plan)
                <a href="{{ route('strategic-plan.detail', $plan->id) }}" class="strategic-plan-card">
                    <h2>{{ $plan->title }}</h2><i class="fa fa-arrow-right"></i>
                </a>
                @empty
                <!-- Jika belum ada data, tampilkan placeholder -->
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
                    <p>Belum ada data Strategic Plan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="strategic-plan-content-reverse">
        <div class="strategic-plan-image-reverse">
            <img src="{{ asset('images/strategic-plan2.png') }}" alt="Program dan Layanan Image">
        </div>
        <div class="strategic-plan-wrapper">
            <div class="green-accent"></div>
            <h1>Program dan Layanan</h1>
            <div class="strategic-plan-cards">
                @forelse($programLayanan as $plan)
                <a href="{{ route('strategic-plan.detail', $plan->id) }}" class="strategic-plan-card">
                    <h2>{{ $plan->title }}</h2><i class="fa fa-arrow-right"></i>
                </a>
                @empty
                <!-- Jika belum ada data, tampilkan placeholder -->
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
                    <p>Belum ada data Program dan Layanan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
{{-- SECTION INFORMASI KEGIATAN BPD - FIXED VERSION --}}
<section class="events">
    <div class="green-accent" style="align-self: center;"></div>
    <h2>Informasi Kegiatan BPD</h2>

    {{-- DEBUG: Cek apakah data ada --}}
    @php
    $hasData = isset($kegiatanBerita) && $kegiatanBerita->count() > 0;
    @endphp

    @if($hasData)
    {{-- Ada data kegiatan --}}
    <div class="events-content" id="kegiatan-container">
        {{-- Initial loading state --}}
        <div style="text-align: center; padding: 3rem; color: #ffffff;">
            <p>Memuat {{ $kegiatanBerita->count() }} kegiatan...</p>
        </div>
    </div>

    {{-- Indikator dots --}}
    <div style="text-align: center; margin-top: 20px;">
        <div id="kegiatan-indicators" style="display: inline-flex; gap: 10px;"></div>
    </div>

    {{-- Hidden Data untuk JavaScript --}}
    <script id="kegiatan-data" type="application/json">
        @php
        $kegiatanArray = $kegiatanBerita->map(function($item) {
            return [
                'judul' => $item->judul,
                'slug' => $item->slug,
                'gambar_url' => $item->gambar_url ?? asset('images/hipmi-logo.png'),
                'tanggal_format' => $item->tanggal_format ?? $item->tanggal_publish->format('d M Y'),
            ];
        })->toArray();
        @endphp {
            !!json_encode($kegiatanArray) !!
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Kegiatan auto-rotate script started');

            // Ambil data kegiatan dari script tag
            const dataElement = document.getElementById('kegiatan-data');
            if (!dataElement) {
                console.error('❌ Element kegiatan-data tidak ditemukan!');
                return;
            }

            let kegiatanData;
            try {
                kegiatanData = JSON.parse(dataElement.textContent);
                console.log('✅ Data kegiatan berhasil di-parse:', kegiatanData.length, 'items');
            } catch (e) {
                console.error('❌ Error parsing JSON:', e);
                return;
            }

            if (kegiatanData.length === 0) {
                console.warn('⚠️ Tidak ada data kegiatan');
                return;
            }

            const container = document.getElementById('kegiatan-container');
            const indicatorsContainer = document.getElementById('kegiatan-indicators');
            let currentIndex = 0;
            let autoRotateInterval;

            // Fungsi untuk membuat HTML konten kegiatan
            function createKegiatanHTML(startIndex) {
                const featured = kegiatanData[startIndex];
                const others = [];

                // Ambil 4 kegiatan berikutnya (wrap around jika perlu)
                for (let i = 1; i <= 4; i++) {
                    const index = (startIndex + i) % kegiatanData.length;
                    others.push(kegiatanData[index]);
                }

                return `
                    <div class="events-lastest">
                        <a class="events-hover" href="/informasi-kegiatan/${featured.slug}" style="text-decoration: none; color: white;">
                            <div class="events-banner-card-lastest">
                                <img src="${featured.gambar_url}" class="events-banner-bg" alt="${escapeHtml(featured.judul)}" onerror="this.src='{{ asset('images/hipmi-logo.png') }}'">
                                <div class="events-overlay"></div>
                                <div class="events-banner-content">
                                    <h2>${truncate(escapeHtml(featured.judul), 80)}</h2>
                                    <p class="events-date">${escapeHtml(featured.tanggal_format)}</p>
                                    <a href="/informasi-kegiatan/${featured.slug}" class="events-btn-more">Lihat Lebih Banyak</a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="events-others">
                        ${others.map(item => `
                            <a href="/informasi-kegiatan/${item.slug}" style="text-decoration: none; color: white;">
                                <div class="events-banner-card">
                                    <img src="${item.gambar_url}" class="events-banner-bg" alt="${escapeHtml(item.judul)}" onerror="this.src='{{ asset('images/hipmi-logo.png') }}'">
                                    <div class="events-overlay"></div>
                                    <div class="events-banner-content" style="left: 20px; bottom: 20px;">
                                        <h2>${truncate(escapeHtml(item.judul), 60)}</h2>
                                        <p class="events-date">${escapeHtml(item.tanggal_format)}</p>
                                        <span class="events-btn-more">Lihat Lebih Banyak</span>
                                    </div>
                                </div>
                            </a>
                        `).join('')}
                    </div>
                `;
            }

            // Fungsi helper untuk escape HTML
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Fungsi helper untuk truncate text
            function truncate(str, length) {
                return str.length > length ? str.substring(0, length) + '...' : str;
            }

            // Fungsi untuk render kegiatan dengan fade effect
            function renderKegiatan(index, useFade = true) {
                if (useFade) {
                    container.classList.add('fade-out');
                }

                setTimeout(() => {
                    container.innerHTML = createKegiatanHTML(index);

                    if (useFade) {
                        container.classList.remove('fade-out');
                        container.classList.add('fade-in');
                    }

                    updateIndicators(index);
                    console.log('✅ Kegiatan rendered, index:', index);
                }, useFade ? 500 : 0);
            }

            // Buat indicator dots
            function createIndicators() {
                // Hanya buat indicator jika ada lebih dari 5 kegiatan
                if (kegiatanData.length <= 5) {
                    console.log('ℹ️ Tidak membuat indicator (data <= 5)');
                    return;
                }

                indicatorsContainer.innerHTML = kegiatanData.map((_, index) =>
                    `<span class="kegiatan-indicator ${index === 0 ? 'active' : ''}" data-index="${index}"></span>`
                ).join('');

                // Add click event ke indicators
                document.querySelectorAll('.kegiatan-indicator').forEach(indicator => {
                    indicator.addEventListener('click', function() {
                        const newIndex = parseInt(this.getAttribute('data-index'));
                        currentIndex = newIndex;
                        renderKegiatan(currentIndex);
                        resetAutoRotate();
                    });
                });

                console.log('✅ Indicators created:', kegiatanData.length, 'dots');
            }

            // Update active indicator
            function updateIndicators(activeIndex) {
                document.querySelectorAll('.kegiatan-indicator').forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === activeIndex);
                });
            }

            // Auto rotate ke kegiatan berikutnya
            function autoRotate() {
                currentIndex = (currentIndex + 1) % kegiatanData.length;
                renderKegiatan(currentIndex);
                console.log('🔄 Auto-rotate to index:', currentIndex);
            }

            // Reset auto rotate timer
            function resetAutoRotate() {
                clearInterval(autoRotateInterval);
                autoRotateInterval = setInterval(autoRotate, 10000); // 10 detik
                console.log('⏱️ Auto-rotate timer reset');
            }

            // Pause saat hover
            container.addEventListener('mouseenter', () => {
                clearInterval(autoRotateInterval);
                console.log('⏸️ Auto-rotate paused');
            });

            container.addEventListener('mouseleave', () => {
                resetAutoRotate();
                console.log('▶️ Auto-rotate resumed');
            });

            // Initialize
            console.log('🎬 Initializing...');
            createIndicators();
            renderKegiatan(0, false); // Render pertama tanpa fade

            // Start auto rotate hanya jika ada lebih dari 5 kegiatan
            if (kegiatanData.length > 5) {
                autoRotateInterval = setInterval(autoRotate, 10000);
                console.log('✅ Auto-rotate started (10 seconds interval)');
            } else {
                console.log('ℹ️ Auto-rotate disabled (data <= 5)');
            }
        });
    </script>
    @else
    {{-- Tidak ada data kegiatan --}}
    <div style="text-align: center; padding: 3rem 0; color: #ffffff;">
        <p>Belum ada informasi kegiatan yang tersedia.</p>
        @if(!isset($kegiatanBerita))
        <p style="color: #ff6b6b; margin-top: 10px;">
            <strong>Debug:</strong> Variable $kegiatanBerita tidak terdefinisi!
        </p>
        @endif
    </div>
    @endif

    <div style="text-align:center; margin-top: 50px;">
        <a href="{{ route('informasi-kegiatan') }}" class="btn">Lihat Lebih Banyak</a>
    </div>
</section>{{-- Hidden Data untuk JavaScript --}}
<script id="kegiatan-data" type="application/json">
    {
        !!json_encode($kegiatanBerita - > map(function($item) {
            return [
                'judul' => $item - > judul,
                'slug' => $item - > slug,
                'gambar_url' => $item - > gambar_url,
                'tanggal_format' => $item - > tanggal_format,
            ];
        })) !!
    }
</script>

<style>
    /* Indicator Dots */
    .kegiatan-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid #04293B;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .kegiatan-indicator.active {
        background: #04293B;
        transform: scale(1.2);
    }

    .kegiatan-indicator:hover {
        background: rgba(4, 41, 59, 0.7);
    }

    /* Fade Animation */
    .events-content {
        transition: opacity 0.5s ease-in-out;
    }

    .events-content.fade-out {
        opacity: 0;
    }

    .events-content.fade-in {
        opacity: 1;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data kegiatan dari script tag
        const kegiatanData = JSON.parse(document.getElementById('kegiatan-data').textContent);

        if (kegiatanData.length === 0) return;

        const container = document.getElementById('kegiatan-container');
        const indicatorsContainer = document.getElementById('kegiatan-indicators');
        let currentIndex = 0;
        let autoRotateInterval;

        // Fungsi untuk membuat HTML konten kegiatan
        function createKegiatanHTML(startIndex) {
            const featured = kegiatanData[startIndex];
            const others = [];

            // Ambil 4 kegiatan berikutnya (wrap around jika perlu)
            for (let i = 1; i <= 4; i++) {
                const index = (startIndex + i) % kegiatanData.length;
                others.push(kegiatanData[index]);
            }

            return `
            <div class="events-lastest">
                <a class="events-hover" href="/berita/${featured.slug}" style="text-decoration: none; color: white;">
                    <div class="events-banner-card-lastest">
                        <img src="${featured.gambar_url}" class="events-banner-bg" alt="${featured.judul}">
                        <div class="events-overlay"></div>
                        <div class="events-banner-content">
                            <h2>${truncate(featured.judul, 80)}</h2>
                            <p class="events-date">${featured.tanggal_format}</p>
                            <a href="/berita/${featured.slug}" class="events-btn-more">Lihat Lebih Banyak</a>
                        </div>
                    </div>
                </a>
            </div>

            <div class="events-others">
                ${others.map(item => `
                    <a href="/berita/${item.slug}" style="text-decoration: none; color: white;">
                        <div class="events-banner-card">
                            <img src="${item.gambar_url}" class="events-banner-bg" alt="${item.judul}">
                            <div class="events-overlay"></div>
                            <div class="events-banner-content" style="left: 20px; bottom: 20px;">
                                <h2>${truncate(item.judul, 60)}</h2>
                                <p class="events-date">${item.tanggal_format}</p>
                                <span class="events-btn-more">Lihat Lebih Banyak</span>
                            </div>
                        </div>
                    </a>
                `).join('')}
            </div>
        `;
        }

        // Fungsi helper untuk truncate text
        function truncate(str, length) {
            return str.length > length ? str.substring(0, length) + '...' : str;
        }

        // Fungsi untuk render kegiatan dengan fade effect
        function renderKegiatan(index, useFade = true) {
            if (useFade) {
                container.classList.add('fade-out');
            }

            setTimeout(() => {
                container.innerHTML = createKegiatanHTML(index);

                if (useFade) {
                    container.classList.remove('fade-out');
                    container.classList.add('fade-in');
                }

                updateIndicators(index);
            }, useFade ? 500 : 0);
        }

        // Buat indicator dots
        function createIndicators() {
            // Hanya buat indicator jika ada lebih dari 5 kegiatan
            if (kegiatanData.length <= 5) return;

            indicatorsContainer.innerHTML = kegiatanData.map((_, index) =>
                `<span class="kegiatan-indicator ${index === 0 ? 'active' : ''}" data-index="${index}"></span>`
            ).join('');

            // Add click event ke indicators
            document.querySelectorAll('.kegiatan-indicator').forEach(indicator => {
                indicator.addEventListener('click', function() {
                    const newIndex = parseInt(this.getAttribute('data-index'));
                    currentIndex = newIndex;
                    renderKegiatan(currentIndex);
                    resetAutoRotate();
                });
            });
        }

        // Update active indicator
        function updateIndicators(activeIndex) {
            document.querySelectorAll('.kegiatan-indicator').forEach((indicator, index) => {
                indicator.classList.toggle('active', index === activeIndex);
            });
        }

        // Auto rotate ke kegiatan berikutnya
        function autoRotate() {
            currentIndex = (currentIndex + 1) % kegiatanData.length;
            renderKegiatan(currentIndex);
        }

        // Reset auto rotate timer
        function resetAutoRotate() {
            clearInterval(autoRotateInterval);
            autoRotateInterval = setInterval(autoRotate, 10000); // 10 detik
        }

        // Pause saat hover (opsional)
        container.addEventListener('mouseenter', () => {
            clearInterval(autoRotateInterval);
        });

        container.addEventListener('mouseleave', () => {
            resetAutoRotate();
        });

        // Initialize
        createIndicators();
        renderKegiatan(0, false); // Render pertama tanpa fade

        // Start auto rotate hanya jika ada lebih dari 5 kegiatan
        if (kegiatanData.length > 5) {
            autoRotateInterval = setInterval(autoRotate, 10000);
        }
    });
</script>
@endpush
<section class="ekatalog-home">
    <div class="green-accent" style="align-self: center;"></div>
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