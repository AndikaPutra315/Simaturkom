<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hotspot - SIMATURKOM</title>
    {{-- Menggunakan font yang sama dengan halaman lainnya untuk konsistensi --}}
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
            max-width: 1600px;
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
           Tabulasi Hotspot SKPD & Free
           ================================= */
        .tabs-container {
            display: flex;
            border-bottom: 1px solid #eef2f9;
            padding: 0 30px;
        }
        .tab-link {
            padding: 15px 25px;
            cursor: pointer;
            text-decoration: none;
            color: #66789a;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .tab-link:hover {
            color: #1a237e;
        }
        .tab-link.active {
            color: #1a237e;
            border-bottom-color: #1a237e;
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
            white-space: nowrap;
        }
        .data-table th, .data-table td {
            padding: 15px 20px;
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
                    <h1>Data Hotspot</h1>
                    <p>Kelola dan pantau titik hotspot SKPD dan hotspot publik gratis di Kabupaten Tabalong.</p>
                </div>

                <div class="tabs-container">
                    <a href="{{ route('hotspot.index', ['kategori' => 'skpd']) }}" class="tab-link {{ $kategoriAktif == 'skpd' ? 'active' : '' }}">Hotspot SKPD</a>
                    <a href="{{ route('hotspot.index', ['kategori' => 'free']) }}" class="tab-link {{ $kategoriAktif == 'free' ? 'active' : '' }}">Hotspot Free</a>
                </div>

                <div class="toolbar">
                    <div class="filter-group">
                        <select id="filter-status">
                            <option value="">Filter Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <select id="filter-kecamatan">
                            <option value="">Filter Kecamatan</option>
                            <option value="tanjung">Tanjung</option>
                            <option value="murung-pudak">Murung Pudak</option>
                            <option value="haruai">Haruai</option>
                        </select>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
                        <button class="btn-pdf"><i class="fas fa-file-pdf"></i> Generate PDF</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Lokasi</th>
                                <th>Kategori</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hotspots as $hotspot)
                                <tr>
                                    <td>{{ $hotspot['lokasi'] }}</td>
                                    <td>{{ $hotspot['kategori'] }}</td>
                                    <td>{{ $hotspot['alamat'] }}</td>
                                    <td>{{ $hotspot['kecamatan'] }}</td>
                                    <td>
                                        @if ($hotspot['status'] == 'aktif')
                                            <span class="status-badge status-aktif">aktif</span>
                                        @else
                                            <span class="status-badge status-nonaktif">nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 20px;">
                                        Tidak ada data untuk kategori ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="entries-info">
                        Menampilkan data yang difilter.
                    </div>
                    <nav class="pagination-nav">
                        <ul>
                            <li><a href="#">Sebelumnya</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">9</a></li>
                            <li><a href="#">Selanjutnya</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')

</body>
</html>