<style>
    /* Basic Styling untuk Header */
    .header-nav {
        background-color: #ffffff;
        padding: 0.75rem 2rem;
        border-bottom: 1px solid #e7e7e7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: sans-serif;
    }

    .header-left {
        display: flex;
        align-items: center;
    }

    .logo-group {
        display: flex;
        align-items: center;
        border-right: 2px solid #e0e0e0;
        padding-right: 20px;
        margin-right: 20px;
    }

    .logo-group img {
        height: 45px;
        width: auto;
        margin-right: 15px;
    }

    .logo-group img:last-child {
        margin-right: 0;
    }

    .site-name {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .header-menu {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .header-menu li {
        margin-left: 20px;
    }

    .header-menu a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .header-menu a:hover, .header-menu a.active {
        background-color: #007bff;
        color: #ffffff;
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

            <span class="site-name">SIMATURKOM</span>

        </div>

        <ul class="header-menu">
            {{-- Menggunakan Request::is() untuk mengecek URL aktif --}}
            <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/hotspot') }}" class="{{ Request::is('hotspot') ? 'active' : '' }}">Hotspot</a></li>
            <li><a href="{{ route('regulasi') }}" class="{{ Request::routeIs('regulasi') ? 'active' : '' }}">Regulasi</a></li>
            <li><a href="#" class="{{ Request::is('peta-tower') ? 'active' : '' }}">Peta Tower</a></li>
            <li><a href="{{ url('/data-menara') }}" class="{{ Request::is('data-menara') ? 'active' : '' }}">Data Menara</a></li>
            <li><a href="#" class="{{ Request::is('peta-zona') ? 'active' : '' }}">Peta Zona</a></li>
            <li><a href="{{ url('/#data-infrastruktur') }}" class="{{ Request::is('statistik') ? 'active' : '' }}">Statistik</a></li>
        </ul>
    </nav>
</header>
