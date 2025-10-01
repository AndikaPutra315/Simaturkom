<style>
    /* Basic Styling untuk Header */
    .header-nav {
        background-color: #ffffff;
        padding: 0.75rem 2rem; /* Sedikit mengurangi padding vertikal agar tidak terlalu tinggi */
        border-bottom: 1px solid #e7e7e7;
        display: flex;
        justify-content: space-between; /* Mendorong item ke ujung kiri dan kanan */
        align-items: center; /* Menyelaraskan semua item secara vertikal di tengah */
        font-family: sans-serif;
    }

    /* BARU: Kontainer untuk semua item di sisi kiri (logo + nama) */
    .header-left {
        display: flex;
        align-items: center;
    }

    /* BARU: Grup untuk tiga logo */
    .logo-group {
        display: flex;
        align-items: center;
        border-right: 2px solid #e0e0e0; /* Garis pemisah */
        padding-right: 20px; /* Jarak dari garis pemisah */
        margin-right: 20px; /* Jarak ke tulisan "simartukom" */
    }

    /* BARU: Aturan untuk setiap logo di dalam grup */
    .logo-group img {
        height: 45px; /* KETINGGIAN SERAGAM UNTUK SEMUA LOGO */
        width: auto;  /* Lebar menyesuaikan agar proporsional */
        margin-right: 15px; /* Jarak antar logo */
    }

    /* Menghapus margin-right pada logo terakhir di grup */
    .logo-group img:last-child {
        margin-right: 0;
    }

    /* Styling untuk tulisan "simartukom" */
    .site-name {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    /* Styling untuk menu navigasi (tidak berubah) */
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
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Hotspot</a></li>
            <li><a href="#">Regulasi</a></li>
            <li><a href="#">Peta Tower</a></li>
            <li><a href="#">Data Menara</a></li>
            <li><a href="#">Peta Zona</a></li>
            <li><a href="#">Statistik</a></li>
        </ul>
    </nav>
</header>
