<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SIMATURKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        /* Reset margin default dari browser */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif; /* Font dasar yang bersih */
            background-color: #f4f6f9; /* Warna latar belakang abu-abu muda */
            color: #333;
        }

        /* Kontainer Utama untuk Hero Section */
        .hero-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* Mengambil tinggi layar penuh dikurangi tinggi header (estimasi 70px) */
            height: calc(100vh - 75px);
            padding: 0 2rem;
        }

        /* Styling Judul Utama: SIMATURKOM */
        .hero-title {
            font-family: 'Montserrat', sans-serif; /* Font yang tegas dan modern */
            font-size: 4rem; /* Ukuran font sangat besar */
            font-weight: 700;
            color: #1a237e; /* Biru tua khas instansi */
            letter-spacing: 2px;
            margin: 0;
            margin-bottom: 0.5rem;
        }

        /* Styling Sub-judul: Sistem Informasi... */
        .hero-subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem; /* Ukuran lebih kecil dari judul */
            font-weight: 400;
            color: #555;
            letter-spacing: 4px; /* Jarak huruf lebih lebar untuk kesan formal */
            text-transform: uppercase;
            margin-top: 0;
        }

        /* Garis pemisah dekoratif */
        .hero-divider {
            width: 100px;
            height: 3px;
            background-color: #1a237e;
            border: none;
            margin: 2rem 0;
        }

    </style>
</head>
<body>

    {{-- Memanggil Header --}}
    @include('includes.header')

    {{-- Konten Utama Halaman --}}
    <main>
        <div class="hero-container">
            <h1 class="hero-title">SIMATURKOM</h1>
            <p class="hero-subtitle">SISTEM INFORMASI MANAJEMEN INFRASTRUKTUR KOMUNIKASI</p>
            <hr class="hero-divider">
        </div>
    </main>

    {{-- Footer tidak dipanggil agar fokus pada tampilan hero --}}
    {{-- Jika ingin footer tetap ada, hapus komentar di baris bawah ini --}}
    {{-- @include('includes.footer') --}}

</body>
</html>
