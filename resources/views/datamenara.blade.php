<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menara - SIMATURKOM</title>
    {{-- Menggunakan font yang sama dengan halaman Home untuk konsistensi --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* =================================
           Reset dan Pengaturan Dasar
           ================================= */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
            padding: 40px 0;
        }
        .container {
            max-width: 1600px; /* Diperlebar lagi untuk banyak kolom */
            margin: 0 auto;
            padding: 0 20px;
        }

        /* =================================
           Card Utama untuk Konten
           ================================= */
        .content-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .card-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eef2f9;
        }
        .card-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a237e;
        }
        .card-header p {
            margin: 5px 0 0 0;
            color: #66789a;
            font-size: 0.95rem;
        }

        /* =================================
           Toolbar untuk Filter dan Aksi
           ================================= */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px 30px;
            gap: 15px;
        }
        .filter-group {
            display: flex;
            gap: 15px;
        }
        .filter-group select, .search-input input {
            padding: 10px 15px;
            border: 1px solid #dcdfe6;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            background-color: #fdfdfd;
        }
        .action-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        .btn-refresh {
            background-color: #1a237e;
            color: white;
        }
        .btn-refresh:hover {
            background-color: #151c68;
        }
        .btn-pdf {
            background-color: #c82333;
            color: white;
        }
        .btn-pdf:hover {
            background-color: #a21b29;
        }
        .action-buttons i {
            margin-right: 8px;
        }

        /* =================================
           Styling Tabel Data
           ================================= */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap; /* Mencegah teks turun baris */
        }
        .data-table th, .data-table td {
            padding: 15px 20px; /* Sedikit mengurangi padding horizontal */
            text-align: left;
            font-size: 0.9rem;
        }
        .data-table thead {
            background-color: #f8f9fc;
        }
        .data-table th {
            font-weight: 600;
            color: #33425e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table tbody tr {
            border-bottom: 1px solid #eef2f9;
        }
        .data-table tbody tr:last-child {
            border-bottom: none;
        }
        .data-table tbody tr:hover {
            background-color: #f4f7fc;
        }

        /* Styling untuk status 'Aktif' */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: capitalize;
        }
        .status-aktif {
            background-color: #e7f5e8;
            color: #28a745;
        }
        .status-nonaktif {
            background-color: #f8d7da;
            color: #721c24;
        }


        /* =================================
           Footer Tabel (Paginasi dan Info)
           ================================= */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            border-top: 1px solid #eef2f9;
        }
        .entries-info {
            color: #66789a;
            font-size: 0.9rem;
        }
        .pagination-nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 5px;
        }
        .pagination-nav a {
            display: block;
            padding: 8px 14px;
            text-decoration: none;
            color: #555;
            background-color: #fff;
            border: 1px solid #dcdfe6;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .pagination-nav a:hover {
            background-color: #f4f7fc;
            border-color: #b8c1d3;
        }
        .pagination-nav li.active a {
            background-color: #1a237e;
            color: white;
            border-color: #1a237e;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

    @include('includes.header')

    <main>
        <div class="container">
            <div class="content-card">
                <div class="card-header">
                    <h1>Data Menara Telekomunikasi</h1>
                    <p>Jelajahi dan kelola data menara telekomunikasi yang terdaftar di Kabupaten Tabalong.</p>
                </div>

                <div class="toolbar">
                    <div class="filter-group">
                        <select id="filter-provider">
                            <option value="">Filter Provider</option>
                            <option value="telkomsel">Telkomsel</option>
                            <option value="prolindo">Prolindo</option>
                        </select>
                        <select id="filter-kecamatan">
                            <option value="">Filter Kecamatan</option>
                            <option value="banua-lawas">Banua Lawas</option>
                            <option value="pugaan">Pugaan</option>
                        </select>
                    </div>
                    <div class="action-buttons">
                        <button id="refresh-button" class="btn-refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
                        <button class="btn-pdf"><i class="fas fa-file-pdf"></i> Generate PDF</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Provider</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Alamat</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Tipe Ukuran</th>
                                <th>Status</th>
                                <th>Tinggi Tower</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- CONTOH DATA - Ganti bagian ini dengan loop dari database Anda --}}
                            <tr>
                                <td>60935-PTPROTELIN-79</td>
                                <td>PT PROTELINDO</td>
                                <td>SUNGAI DURIAN</td>
                                <td>BANUA LAWAS</td>
                                <td>Desa Sungai durian RT 05 RW</td>
                                <td>115.27807</td>
                                <td>-2.34552</td>
                                <td>makrocell</td>
                                <td><span class="status-badge status-aktif">aktif</span></td>
                                <td>72</td>
                            </tr>
                            <tr>
                                <td>60940-PTDAYAMITR-164</td>
                                <td>PT.DAYAMITRA TELEKOMUNIKASI</td>
                                <td>BANGKILING RAYA</td>
                                <td>BANUA LAWAS</td>
                                <td>JL. Bangkiling Raya RT.04</td>
                                <td>115.2561389</td>
                                <td>-2.331777778</td>
                                <td>mikrocell</td>
                                <td><span class="status-badge status-aktif">aktif</span></td>
                                <td>52</td>
                            </tr>
                             <tr>
                                <td>60941-PT-CENTRAT-139</td>
                                <td>PT. CENTRATAMA MENARA INDONESIA</td>
                                <td>BANUA LAWAS</td>
                                <td>BANUA LAWAS</td>
                                <td>Pematang RT.005 RW 00 Desa Pematang K</td>
                                <td>115.2915277778</td>
                                <td>-2.338861111</td>
                                <td>mikrocell</td>
                                <td><span class="status-badge status-aktif">aktif</span></td>
                                <td>52</td>
                            </tr>
                             <tr>
                                <td>60942-TELKOMSEL-76</td>
                                <td>TELKOMSEL</td>
                                <td>BANUA LAWAS</td>
                                <td>BANUA LAWAS</td>
                                <td>Jl. Lapangan 17 mei Rt.02 Kel. Desa Banua L</td>
                                <td>115.278028</td>
                                <td>-2.320083</td>
                                <td>makrocell</td>
                                <td><span class="status-badge status-aktif">aktif</span></td>
                                <td>71</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="entries-info">
                        Menampilkan 1 sampai 4 dari 153 entri
                    </div>
                    <nav class="pagination-nav">
                        <ul>
                            <li><a href="#">Sebelumnya</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">16</a></li>
                            <li><a href="#">Selanjutnya</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <script>
        const refreshButton = document.getElementById('refresh-button');
        refreshButton.addEventListener('click', function() {
            console.log('Tombol refresh diklik!');
            location.reload();
        });
    </script>

    @include('includes.footer')

</body>
</html>

