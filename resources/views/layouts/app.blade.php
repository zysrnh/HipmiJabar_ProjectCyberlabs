<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ekatalog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/organisasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadi-anggota.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

</head>

<body>

    @include('layouts.components.header')

    @yield('content')

    @include('layouts.components.footer')

    @include('layouts.components.footer-after')

    <button id="btnTop"><i class="fa fa-arrow-up"></i></button>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.anggota-carousel').owlCarousel({
                margin: 20,
                dots: true,
                autoplay: false,
                autoplayTimeout: 3000,
                responsive: {
                    0: { items: 1 },
                    480: { items: 2 },
                    768: { items: 3 },
                    1024: { items: 4 }
                }
            });
        });
    </script>
    <script>
        const btnTop = document.getElementById("btnTop");

        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 200) {
                btnTop.style.display = "block";
            } else {
                btnTop.style.display = "none";
            }
        });

        btnTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

</body>

</html>