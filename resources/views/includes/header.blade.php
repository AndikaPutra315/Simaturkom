<style>
    /* -- CSS ASLI ANDA -- */
    .header-nav {
        background-color: #ffffff;
        padding: 0.75rem 2rem;
        border-bottom: 1px solid #e7e7e7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: sans-serif;
        position: relative;
    }
    .header-left { display: flex; align-items: center; }
    .logo-group { display: flex; align-items: center; border-right: 2px solid #e0e0e0; padding-right: 20px; margin-right: 20px; }
    .logo-group img { height: 45px; width: auto; margin-right: 15px; }
    .logo-group img:last-child { margin-right: 0; }
    .site-name { font-size: 1.5rem; font-weight: bold; color: #333; }
    .site-name-link { text-decoration: none; }
    .header-menu { list-style-type: none; margin: 0; padding: 0; display: flex; }
    .header-menu li { margin-left: 20px; }
    .header-menu a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 5px;
        /* TRANSISI DITAMBAHKAN/DIPASTIKAN ADA */
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .header-menu a:hover, .header-menu a.active { background-color: #007bff; color: #ffffff; }
    .admin-bar { background-color: #1a237e; color: white; padding: 0.75rem 2rem; display: flex; justify-content: space-between; align-items: center; font-family: sans-serif; }
    .admin-bar .admin-info { font-weight: 600; }
    .admin-bar .admin-menu { display: flex; align-items: center; gap: 20px; }
    .admin-bar .admin-menu a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 5px;
        /* TRANSISI DIPERLENGKAP */
        transition: color 0.3s ease, background-color 0.3s ease;
    }
    .admin-bar .admin-menu a:hover { color: #ffab00; }
    .admin-bar .admin-menu a.active { background-color: rgba(255, 255, 255, 0.15); color: #ffab00; }
    .admin-bar .btn-logout {
        background: none; border: 1px solid white; color: white; padding: 5px 15px; border-radius: 20px; cursor: pointer;
        /* TRANSISI DIPASTIKAN ADA */
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .admin-bar .btn-logout:hover { background-color: white; color: #1a237e; }

    /* -- CSS BARU UNTUK DROPDOWN (VERSI SMOOTH) -- */
    .header-menu .header-dropdown {
        position: relative;
    }
    .header-menu .header-dropdown .dropdown-menu-nav {
        /* MENGGANTI 'display: none' DENGAN INI */
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px); /* Efek geser dari atas */
        transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;

        position: absolute;
        top: 100%;
        left: 0;
        background-color: #ffffff;
        min-width: 200px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        z-index: 1001;
        list-style: none;
        padding: 5px 0;
        margin: 0;
        border-radius: 5px;
    }
    .header-menu .header-dropdown:hover .dropdown-menu-nav {
        /* MENGGANTI 'display: block' DENGAN INI */
        opacity: 1;
        visibility: visible;
        transform: translateY(0); /* Kembali ke posisi normal */
    }
    .header-menu .header-dropdown .dropdown-menu-nav li { margin: 0; width: 100%; }
    .header-menu .header-dropdown .dropdown-menu-nav a {
        padding: 10px 15px;
        display: block;
        border-radius: 0;
        color: #333;
        transition: background-color 0.3s ease, color 0.3s ease; /* Transisi untuk item di dalam dropdown */
    }
    .header-menu .header-dropdown .dropdown-menu-nav a:hover,
    .header-menu .header-dropdown .dropdown-menu-nav a.active {
        background-color: #007bff;
        color: #ffffff;
    }
    /* -- AKHIR CSS DROPDOWN -- */

    /* -- CSS UNTUK RESPONSIVITAS -- */
    .mobile-menu-toggle {
        display: none;
        font-size: 1.5rem;
        color: #333;
        background: none;
        border: none;
        cursor: pointer;
        transition: transform 0.3s ease; /* Transisi untuk ikon */
    }
    .mobile-menu-toggle.active {
        transform: rotate(90deg); /* Opsi: putar ikon saat aktif */
    }

    @media (max-width: 992px) {
        .header-nav { padding: 0.75rem 1rem; }
        .header-menu {
            /* MENGGANTI 'display: none' DENGAN INI UNTUK EFEK SLIDE */
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;

            max-height: 0; /* Awalnya tinggi 0 */
            overflow: hidden; /* Sembunyikan isinya */
            transition: max-height 0.4s ease-out; /* Transisi slide */
        }
        .header-menu.active {
            /* MENGGANTI 'display: flex' DENGAN INI */
            max-height: 100vh; /* Set tinggi maksimum (cukup besar) */
            padding: 10px 0; /* Tambahkan padding saat terbuka */
        }
        .header-menu li { margin: 0; width: 100%; }
        .header-menu a { padding: 15px 20px; border-radius: 0; border-bottom: 1px solid #f0f0f0; display: block; }
        .mobile-menu-toggle { display: block; }
        .admin-bar { flex-direction: column; gap: 10px; padding: 0.75rem 1rem; }
        .admin-menu { flex-wrap: wrap; justify-content: center; }

        /* Perbaikan Dropdown untuk Mobile (tetap sama) */
        .header-menu .header-dropdown { position: static; }
        .header-menu .header-dropdown .dropdown-menu-nav {
            display: block;
            position: static;
            box-shadow: none;
            min-width: 100%;
            border-radius: 0;
            padding-left: 20px;
            background-color: #f9f9f9;
            /* Hapus transisi di mobile agar tidak bentrok */
            opacity: 1;
            visibility: visible;
            transform: none;
            transition: none;
        }
         .header-menu .header-dropdown .dropdown-menu-nav a { padding: 12px 20px; border-bottom: 1px solid #e9e9e9; }
         .header-menu .header-dropdown .dropdown-menu-nav li:last-child a { border-bottom: none; }
    }
    @media (max-width: 576px) {
        .logo-group { padding-right: 10px; margin-right: 10px; }
        .logo-group img { height: 35px; }
        .site-name { font-size: 1.2rem; }
    }
</style>

<header>
    <nav class="header-nav">
        <div class="header-left">
            <div class="logo-group">
                <img src="{{ asset('images/logotabalong.png') }}" alt="Logo Kabupaten Tabalong">
                <img src="{{ asset('images/logokominfo.png') }}" alt="Logo Diskominfo">
                <img src="{{ asset('images/logosmart.png') }}" alt="Logo Smart City">
            </div>
            <a href="{{ route('home') }}" class="site-name-link">
                <span class="site-name">SIMATURKOM</span>
            </a>
        </div>

        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="header-menu" id="headerMenu">
            <li><a href="{{ Auth::check() ? route('suadmin.dashboard') : route('home') }}" class="{{ Request::routeIs('home', 'suadmin.dashboard') ? 'active' : '' }}">Home</a></li>

            <li><a href="{{ Auth::check() ? route('suadmin.hotspot.index') : route('hotspot.index') }}"
                   class="{{ (Request::routeIs('hotspot.index') || Request::routeIs('suadmin.hotspot.*')) ? 'active' : '' }}">Hotspot</a>
            </li>

            <li><a href="{{ Auth::check() ? route('suadmin.regulasi.index') : route('regulasi') }}" class="{{ Request::routeIs('regulasi', 'suadmin.regulasi.*') ? 'active' : '' }}">Regulasi</a></li>

            <li class="header-dropdown">
                <a href="javascript:void(0);"
                   class="dropdown-toggle {{ (
                       Request::routeIs('datamenara', 'suadmin.datamenara.*') ||
                       Request::routeIs('databakti', 'suadmin.databakti.*') ||
                       Request::routeIs('blankspot.index', 'suadmin.blankspot.*')
                   ) ? 'active' : '' }}">
                   Data Infrastruktur
                </a>

                <ul class="dropdown-menu-nav">
                    <li>
                        <a href="{{ Auth::check() ? route('suadmin.datamenara.index') : route('datamenara') }}"
                           class="{{ (Request::routeIs('datamenara') || Request::routeIs('suadmin.datamenara.*')) ? 'active' : '' }}">Data Menara</a>
                    </li>
                    <li>
                        <a href="{{ Auth::check() ? route('suadmin.databakti.index') : route('databakti') }}"
                           class="{{ (Request::routeIs('databakti') || Request::routeIs('suadmin.databakti.*')) ? 'active' : '' }}">Data Bakti</a>
                    </li>
                    <li>
                        <a href="{{ Auth::check() ? route('suadmin.blankspot.index') : route('blankspot.index') }}"
                           class="{{ (Request::routeIs('blankspot.index') || Request::routeIs('suadmin.blankspot.*')) ? 'active' : '' }}">Blankspot</a>
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('peta.index') }}" class="{{ Request::routeIs('peta.index') ? 'active' : '' }}">Peta Sebaran</a></li>
            <li><a href="{{ url('/#data-infrastruktur') }}">Statistik</a></li>
        </ul>
    </nav>

    @auth
        <div class="admin-bar">
            <div class="admin-info">
                <i class="fas fa-user-shield me-2"></i> Selamat Datang, {{ Auth::user()->name }}
            </div>
            <div class="admin-menu">
                <a href="{{ route('suadmin.dashboard') }}" class="{{ Request::routeIs('suadmin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                @if (Auth::user()->role == 'suadmin')
                    <a href="{{ route('suadmin.users.index') }}" class="{{ Request::routeIs('suadmin.users.*') ? 'active' : '' }}"><i class="fas fa-users-cog me-2"></i>Manajemen Admin</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout ms-3"><i class="fas fa-sign-out-alt me-2"></i> Log Out</button>
                </form>
            </div>
        </div>
    @endauth
</header>

<script>
    // KODE JS INI TIDAK PERLU DIUBAH SAMA SEKALI.
    // CSS akan menangani animasi 'slide-down' secara otomatis
    // saat kelas '.active' ditambahkan.
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('mobileMenuToggle');
        const menu = document.getElementById('headerMenu');
        const icon = toggleButton.querySelector('i');

        toggleButton.addEventListener('click', function () {
            // Toggle kelas 'active' pada menu
            menu.classList.toggle('active');

            // Toggle kelas 'active' pada tombol (untuk efek putar)
            toggleButton.classList.toggle('active');

            // Ganti ikon hamburger menjadi 'X' dan sebaliknya
            if (menu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    });
</script>
