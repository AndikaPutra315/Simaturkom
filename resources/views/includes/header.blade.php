<style>
    /* CSS Anda sudah bagus dan tidak perlu diubah */
    .header-nav { background-color: #ffffff; padding: 0.75rem 2rem; border-bottom: 1px solid #e7e7e7; display: flex; justify-content: space-between; align-items: center; font-family: sans-serif; }
    .header-left { display: flex; align-items: center; }
    .logo-group { display: flex; align-items: center; border-right: 2px solid #e0e0e0; padding-right: 20px; margin-right: 20px; }
    .logo-group img { height: 45px; width: auto; margin-right: 15px; }
    .logo-group img:last-child { margin-right: 0; }
    .site-name { font-size: 1.5rem; font-weight: bold; color: #333; }
    .site-name-link { text-decoration: none; }
    .header-menu { list-style-type: none; margin: 0; padding: 0; display: flex; }
    .header-menu li { margin-left: 20px; }
    .header-menu a { text-decoration: none; color: #555; font-weight: 500; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s, color: 0.3s; }
    .header-menu a:hover, .header-menu a.active { background-color: #007bff; color: #ffffff; }

    .admin-bar { background-color: #1a237e; color: white; padding: 0.75rem 2rem; display: flex; justify-content: space-between; align-items: center; font-family: sans-serif; }
    .admin-bar .admin-info { font-weight: 600; }
    .admin-bar .admin-menu { display: flex; align-items: center; gap: 20px; }
    .admin-bar .admin-menu a { color: white; text-decoration: none; font-weight: 500; transition: color 0.2s; padding: 5px 10px; border-radius: 5px; }
    .admin-bar .admin-menu a:hover { color: #ffab00; }
    .admin-bar .admin-menu a.active { background-color: rgba(255, 255, 255, 0.15); color: #ffab00; }
    .admin-bar .btn-logout { background: none; border: 1px solid white; color: white; padding: 5px 15px; border-radius: 20px; cursor: pointer; transition: background-color 0.2s, color 0.2s; }
    .admin-bar .btn-logout:hover { background-color: white; color: #1a237e; }
</style>

<header>
    {{-- Navbar Utama dengan Link Cerdas --}}
    <nav class="header-nav">
        {{-- ... Konten Navbar Anda ... --}}
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
        <ul class="header-menu">
            <li><a href="{{ Auth::check() ? route('suadmin.dashboard') : route('home') }}" class="{{ Request::routeIs('home', 'suadmin.dashboard') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ Auth::check() ? route('suadmin.hotspot.index') : route('hotspot.index') }}" class="{{ Request::routeIs('hotspot.index', 'suadmin.hotspot.*') ? 'active' : '' }}">Hotspot</a></li>
            <li><a href="{{ Auth::check() ? route('suadmin.regulasi.index') : route('regulasi') }}" class="{{ Request::routeIs('regulasi', 'suadmin.regulasi.*') ? 'active' : '' }}">Regulasi</a></li>
            <li><a href="{{ Auth::check() ? route('suadmin.datamenara.index') : route('datamenara') }}" class="{{ Request::routeIs('datamenara', 'suadmin.datamenara.*') ? 'active' : '' }}">Data Menara</a></li>
            <li><a href="{{ route('peta.index') }}" class="{{ Request::routeIs('peta.index') ? 'active' : '' }}">Peta Sebaran</a></li>
            <li><a href="{{ url('/#data-infrastruktur') }}">Statistik</a></li>
        </ul>
    </nav>

    {{-- Admin Bar akan tetap muncul jika admin login --}}
    @auth
        <div class="admin-bar">
            <div class="admin-info">
                <i class="fas fa-user-shield me-2"></i> Selamat Datang, {{ Auth::user()->name }}
            </div>
            <div class="admin-menu">
                <a href="{{ route('suadmin.dashboard') }}" class="{{ Request::routeIs('suadmin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                {{-- Tampilkan menu ini HANYA jika role user adalah 'suadmin' --}}
                @if (Auth::user()->role == 'suadmin')
                    <a href="{{ route('suadmin.users.index') }}" class="{{ Request::routeIs('suadmin.users.*') ? 'active' : '' }}"><i class="fas fa-users-cog me-2"></i>Manajemen Admin</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout ms-3">
                        <i class="fas fa-sign-out-alt me-2"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    @endauth
</header>
