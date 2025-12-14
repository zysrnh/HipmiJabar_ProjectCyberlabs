@extends ('layouts.app')

@section('title', 'Berita - HIPMI Jawa Barat')

@section('content')
    <section class="page-banner">
        <h1>Berita & Dokumentasi</h1>
        <p>Berita & Kegiatan seputar HIPMI Jawa Barat</p>
    </section>
    <section class="search-katalog">
        <form action="{{ route('e-katalog') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Cari berita ..." value="{{ request('search') }}">
            <button type="submit" style="background: none; border: none; cursor: pointer;">
            </button>
        </form>
    </section>

    <section class="berita">
        <div class="berita-left">
            <div class="berita-item">
                <a href="{{ route('berita-detail') }}" class="berita-item-image">
                    <img src="{{ asset('images/missions/mission-1.png') }}" alt="Berita">
                </a>
                <div class="berita-item-content">
                    <div>
                        <h3>Pengenalan HIPMI dan Peran Ketua Umum</h3>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <p>{{ Str::limit('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper sapien bibendum, dapibus felis ac, blandit velit. Cras molestie nulla quis leo dignissim, vitae vulputate neque ultricies. Nunc rutrum justo in sem dignissim, non pulvinar leo accumsan. Nulla aliquet, eros ut feugiat consequat, velit leo viverra massa, ac pellentesque massa libero a magna. Cras sed nisl ac ante rutrum consequat ut et turpis. Phasellus nec felis auctor erat maximus laoreet. Maecenas pellentesque pellentesque justo ultrices semper. Suspendisse ut interdum elit. Vestibulum dignissim condimentum quam, sed mollis erat posuere sit amet. Aliquam ut eros vitae nulla convallis rhoncus. Proin quis urna ligula. Nullam nec arcu sit amet ipsum ullamcorper viverra eu sed lorem.
                                Pellentesque et sem aliquam, dignissim tellus non, rutrum enim. Suspendisse congue ante auctor dolor semper, ultrices semper dui ullamcorper. Nulla eleifend sem ut mi euismod hendrerit. Curabitur dictum a mi nec auctor. Aenean pharetra interdum diam feugiat pellentesque. Curabitur non felis ac enim sodales interdum sit amet in erat. Ut lacinia odio id commodo dignissim. Aenean pulvinar risus quis massa facilisis, ut bibendum ex varius. Nunc pulvinar elementum cursus. Proin eget ante tellus. Nulla feugiat sollicitudin erat. Nulla bibendum quam et purus tristique molestie.', 150, '...') }}
                        </p>
                    </div>
                    <a href="#" class="berita-home-others-btn-more">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="berita-right">
            <h1 class="berita-badge">Berita Populer</h1>
            <div class="berita-right-item">
                <a href="#" class="berita-right-item-image">
                    <img src="{{ asset('images/missions/mission-3.png') }}" alt="">
                </a>
                <div class="berita-right-item-content">
                    <div>
                        <h3>Pengenalan HIPMI dan Peran Ketua Umum</h3>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <p>{{ Str::limit('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper sapien bibendum, dapibus felis ac, blandit velit. Cras molestie nulla quis leo dignissim, vitae vulputate neque ultricies. Nunc rutrum justo in sem dignissim, non pulvinar leo accumsan. Nulla aliquet, eros ut feugiat consequat, velit leo viverra massa, ac pellentesque massa libero a magna. Cras sed nisl ac ante rutrum consequat ut et turpis. Phasellus nec felis auctor erat maximus laoreet. Maecenas pellentesque pellentesque justo ultrices semper. Suspendisse ut interdum elit. Vestibulum dignissim condimentum quam, sed mollis erat posuere sit amet. Aliquam ut eros vitae nulla convallis rhoncus. Proin quis urna ligula. Nullam nec arcu sit amet ipsum ullamcorper viverra eu sed lorem.
                                Pellentesque et sem aliquam, dignissim tellus non, rutrum enim. Suspendisse congue ante auctor dolor semper, ultrices semper dui ullamcorper. Nulla eleifend sem ut mi euismod hendrerit. Curabitur dictum a mi nec auctor. Aenean pharetra interdum diam feugiat pellentesque. Curabitur non felis ac enim sodales interdum sit amet in erat. Ut lacinia odio id commodo dignissim. Aenean pulvinar risus quis massa facilisis, ut bibendum ex varius. Nunc pulvinar elementum cursus. Proin eget ante tellus. Nulla feugiat sollicitudin erat. Nulla bibendum quam et purus tristique molestie.', 100, '...') }}
                        </p>
                    </div>
                </div>
            </div>
            <h1 class="berita-badge">Berita Terbaru</h1>
            <div class="berita-right-item">
                <a href="#" class="berita-right-item-image">
                    <img src="{{ asset('images/missions/mission-3.png') }}" alt="">
                </a>
                <div class="berita-right-item-content">
                    <div>
                        <h3>Pengenalan HIPMI dan Peran Ketua Umum</h3>
                        <p class="berita-home-date">Oktober 28, 2025</p>

                        <p>{{ Str::limit('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper sapien bibendum, dapibus felis ac, blandit velit. Cras molestie nulla quis leo dignissim, vitae vulputate neque ultricies. Nunc rutrum justo in sem dignissim, non pulvinar leo accumsan. Nulla aliquet, eros ut feugiat consequat, velit leo viverra massa, ac pellentesque massa libero a magna. Cras sed nisl ac ante rutrum consequat ut et turpis. Phasellus nec felis auctor erat maximus laoreet. Maecenas pellentesque pellentesque justo ultrices semper. Suspendisse ut interdum elit. Vestibulum dignissim condimentum quam, sed mollis erat posuere sit amet. Aliquam ut eros vitae nulla convallis rhoncus. Proin quis urna ligula. Nullam nec arcu sit amet ipsum ullamcorper viverra eu sed lorem.
                                Pellentesque et sem aliquam, dignissim tellus non, rutrum enim. Suspendisse congue ante auctor dolor semper, ultrices semper dui ullamcorper. Nulla eleifend sem ut mi euismod hendrerit. Curabitur dictum a mi nec auctor. Aenean pharetra interdum diam feugiat pellentesque. Curabitur non felis ac enim sodales interdum sit amet in erat. Ut lacinia odio id commodo dignissim. Aenean pulvinar risus quis massa facilisis, ut bibendum ex varius. Nunc pulvinar elementum cursus. Proin eget ante tellus. Nulla feugiat sollicitudin erat. Nulla bibendum quam et purus tristique molestie.', 100, '...') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection