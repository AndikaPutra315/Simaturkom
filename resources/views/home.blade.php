<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SIMATURKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400;500&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* =================================
           Reset dan Pengaturan Dasar
           ================================= */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins yang modern dan mudah dibaca */
            background-color: #f4f7fc; /* Warna latar belakang yang lebih cerah dan bersih */
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* =================================
           Hero Section - Bagian Utama
           ================================= */
        .hero-container {
            background: linear-gradient(rgba(26, 35, 126, 0.8), rgba(26, 35, 126, 0.8)), url('https://via.placeholder.com/1920x800.png?text=Latar+Belakang+Pemerintahan') no-repeat center center/cover;
            color: #ffffff;
            text-align: center;
            padding: 6rem 2rem;
        }
        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .hero-subtitle {
            font-family: 'Roboto', sans-serif;
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 0;
        }

        /* =================================
           Bagian Konten - Tentang Sistem
           ================================= */
        .content-section {
            padding: 60px 0;
            background-color: #ffffff;
        }
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.25rem;
            font-weight: 700;
            color: #1a237e; /* Warna biru navy khas pemerintah */
            text-align: center;
            margin-bottom: 15px;
        }
        .section-divider {
            width: 80px;
            height: 4px;
            background-color: #ffab00; /* Aksen warna emas untuk kesan premium */
            border: none;
            margin: 0 auto 40px auto;
        }
        .content-section p {
            font-size: 1rem;
            color: #555;
            line-height: 1.8;
            text-align: justify;
            max-width: 800px;
            margin: 0 auto 20px auto;
        }

        /* =================================
           Fitur Utama Section
           ================================= */
        .features-section {
            padding: 60px 0;
            background-color: #f4f7fc;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        .feature-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.1);
        }
        .feature-icon {
            font-size: 3rem;
            color: #1a237e;
            margin-bottom: 20px;
        }
        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0 0 10px 0;
        }
        .feature-card p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #666;
        }

    </style>
</head>
<body>

    @include('includes.header')

    <main>
        <section class="hero-container">
            <div class="container">
                <h1 class="hero-title">SIMATURKOM</h1>
                <p class="hero-subtitle">Sistem Informasi Manajemen Infrastruktur Komunikasi</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <h2 class="section-title">Tentang Sistem Kami</h2>
                <hr class="section-divider">
                <p>
                    SIMATURKOM adalah platform terintegrasi yang dirancang untuk mengelola dan memantau seluruh infrastruktur komunikasi di Kabupaten Tabalong. Sistem ini bertujuan untuk meningkatkan efisiensi, transparansi, dan pengambilan keputusan berbasis data yang akurat.
                </p>
                <p>
                    Dengan memanfaatkan teknologi terkini, kami menyediakan data real-time mengenai menara telekomunikasi, jaringan hotspot, serta peta zona strategis. Hal ini memungkinkan Dinas Komunikasi dan Informatika untuk merencanakan pengembangan infrastruktur secara lebih efektif dan merata bagi seluruh masyarakat.
                </p>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Fitur Unggulan</h2>
                <hr class="section-divider">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-broadcast-tower"></i></div>
                        <h3>Manajemen Menara</h3>
                        <p>Kelola data menara telekomunikasi secara terpusat, mulai dari lokasi, status, hingga perizinan.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-wifi"></i></div>
                        <h3>Pemetaan Hotspot</h3>
                        <p>Visualisasikan persebaran titik hotspot publik untuk analisis jangkauan dan optimalisasi layanan.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h3>Analisis Spasial</h3>
                        <p>Gunakan Peta Zona dan Peta Tower untuk perencanaan strategis dan penempatan infrastruktur baru.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('includes.footer')

</body>
</html>
