<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hotspot - SIMATURKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        main { flex: 1; padding: 40px 0; }
        .container { max-width: 1600px; margin: 0 auto; padding: 0 20px; }
        .content-card { background-color: #ffffff; border-radius: 12px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07); overflow: hidden; }
        .card-header { padding: 25px 30px; border-bottom: 1px solid #eef2f9; }
        .card-header h1 { margin: 0; font-size: 1.75rem; font-weight: 600; color: #1a237e; }
        .card-header p { margin: 5px 0 0 0; color: #66789a; font-size: 0.95rem; }
        .tabs-container { display: flex; border-bottom: 1px solid #eef2f9; padding: 0 30px; }
        .tab-link { padding: 15px 25px; cursor: pointer; text-decoration: none; color: #66789a; font-weight: 500; border-bottom: 3px solid transparent; transition: all 0.3s ease; }
        .tab-link:hover { color: #1a237e; }
        .tab-link.active { color: #1a237e; border-bottom-color: #1a237e; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { padding: 15px 20px; text-align: left; font-size: 0.9rem; }
        .data-table thead { background-color: #f8f9fc; }
        .data-table th { font-weight: 600; color: #33425e; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table tbody tr { border-bottom: 1px solid #eef2f9; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 20px 30px; border-top: 1px solid #eef2f9; }
        .entries-info { color: #66789a; font-size: 0.9rem; }
    </style>
</head>
<body>
    @include('includes.header')
    <main>
        <div class="container">
            <div class="content-card">
                <div class="card-header">
                    <h1>Data Hotspot</h1>
                    <p>Daftar titik hotspot SKPD dan hotspot publik gratis di Kabupaten Tabalong.</p>
                </div>

                <div class="tabs-container">
                    {{-- Link tab sekarang menggunakan parameter 'kategori' untuk filtering --}}
                    <a href="{{ route('hotspot.index', ['kategori' => 'skpd']) }}"
                        class="tab-link {{ $kategoriAktif == 'skpd' ? 'active' : '' }}">Hotspot SKPD</a>
                    <a href="{{ route('hotspot.index', ['kategori' => 'free']) }}"
                        class="tab-link {{ $kategoriAktif == 'free' ? 'active' : '' }}">Hotspot RTH/Layanan Publik</a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            {{-- Menyesuaikan header tabel dengan database --}}
                            <tr>
                                <th>Nama Tempat</th>
                                <th>Alamat</th>
                                <th>Tahun</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hotspots as $hotspot)
                                <tr>
                                    {{-- Menyesuaikan nama field dengan database --}}
                                    <td>{{ $hotspot->nama_tempat }}</td>
                                    <td>{{ $hotspot->alamat }}</td>
                                    <td>{{ $hotspot->tahun }}</td>
                                    <td>{{ $hotspot->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px;">
                                        Tidak ada data hotspot untuk kategori ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="entries-info">
                        {{-- Info paginasi dinamis --}}
                        Menampilkan {{ $hotspots->firstItem() }} sampai {{ $hotspots->lastItem() }} dari {{ $hotspots->total() }} entri
                    </div>
                    {{-- Render link paginasi otomatis dari Laravel --}}
                    {{ $hotspots->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>
</html>