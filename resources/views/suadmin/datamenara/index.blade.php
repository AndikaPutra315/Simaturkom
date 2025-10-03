<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Menara - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        main { flex: 1; padding: 40px 0; }
        .container-fluid { max-width: 1800px; padding: 0 30px; }
        .content-card { background-color: #ffffff; border-radius: 12px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07); overflow: hidden; }
        .card-header { padding: 25px 30px; border-bottom: 1px solid #eef2f9; }
        .card-header h1 { margin: 0; font-size: 1.75rem; font-weight: 600; color: #1a237e; }
        .card-header p { margin: 5px 0 0 0; color: #66789a; font-size: 0.95rem; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; padding: 20px 30px; gap: 15px; }
        .filter-group { display: flex; gap: 15px; }
        .filter-group select { padding: 10px 15px; border: 1px solid #dcdfe6; border-radius: 6px; font-size: 0.9rem; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; white-space: nowrap; }
        .data-table th, .data-table td { padding: 15px 20px; text-align: left; font-size: 0.9rem; vertical-align: middle; }
        .data-table thead { background-color: #f8f9fc; }
        .data-table th { font-weight: 600; color: #33425e; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table tbody tr { border-bottom: 1px solid #eef2f9; }
        .data-table tbody tr:hover { background-color: #f4f7fc; }
        .status-badge { display: inline-block; padding: 5px 12px; border-radius: 15px; font-weight: 500; font-size: 0.8rem; text-transform: capitalize; }
        .status-aktif { background-color: #e7f5e8; color: #28a745; }
        .status-nonaktif { background-color: #f8d7da; color: #721c24; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 20px 30px; border-top: 1px solid #eef2f9; }
        .entries-info { color: #66789a; font-size: 0.9rem; }
    </style>
</head>
<body>
    @include('includes.header')

    <main>
        <div class="container-fluid">
            <div class="content-card">
                <div class="card-header">
                    <h1>Kelola Data Menara</h1>
                    <p>Tambah, edit, atau hapus data menara telekomunikasi di Kabupaten Tabalong.</p>
                </div>

                <form action="{{ route('suadmin.datamenara.index') }}" method="GET">
                    <div class="toolbar">
                        <div class="filter-group">
                            <select name="provider" onchange="this.form.submit()">
                                <option value="">Semua Provider</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->provider }}" @if(request('provider') == $provider->provider) selected @endif>{{ $provider->provider }}</option>
                                @endforeach
                            </select>
                            <select name="kecamatan" onchange="this.form.submit()">
                                <option value="">Semua Kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->kecamatan }}" @if(request('kecamatan') == $kecamatan->kecamatan) selected @endif>{{ $kecamatan->kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('suadmin.datamenara.create') }}" class="btn btn-primary fw-bold">
                            <i class="fas fa-plus me-2"></i>Tambah Data Baru
                        </a>
                    </div>
                </form>

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
                                <th>Tinggi Tower</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menara as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->provider }}</td>
                                    <td>{{ $item->kelurahan }}</td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td style="white-space: normal; min-width: 250px;">{{ $item->alamat }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->tipe_ukuran }}</td>
                                    <td>{{ $item->tinggi_tower }} m</td>
                                    <td>
                                        @if (strtolower($item->status) == 'aktif')
                                            <span class="status-badge status-aktif">Aktif</span>
                                        @else
                                            <span class="status-badge status-nonaktif">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('suadmin.datamenara.edit', $item->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('suadmin.datamenara.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <h5>Data Tidak Ditemukan</h5>
                                        <p>Coba ubah filter Anda atau <a href="{{ route('suadmin.datamenara.create') }}">tambahkan data baru</a>.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="entries-info">
                        Menampilkan {{ $menara->firstItem() }} sampai {{ $menara->lastItem() }} dari {{ $menara->total() }} entri
                    </div>
                    {{ $menara->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi Tooltip Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>