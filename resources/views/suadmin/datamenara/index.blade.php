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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    @include('includes.header')

    <main>
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="content-card">
                <div class="card-header">
                    <h1>Kelola Data Menara</h1>
                    <p>Tambah, edit, atau hapus data menara telekomunikasi di Kabupaten Tabalong.</p>
                </div>
                <div class="toolbar">
                    <form action="{{ route('suadmin.datamenara.index') }}" method="GET" class="filter-group">
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

                        {{-- DITAMBAHKAN: Kotak pencarian --}}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari data..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <div class="action-buttons">
                        <a href="{{ route('suadmin.datamenara.index') }}" class="btn-custom btn-refresh">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </a>
                        <a href="{{ route('suadmin.datamenara.pdf', request()->query()) }}" class="btn-custom btn-pdf" target="_blank">
                            <i class="fas fa-file-pdf"></i> Generate PDF
                        </a>
                        <a href="{{ route('suadmin.datamenara.create') }}" class="btn-custom btn-add">
                            <i class="fas fa-plus"></i>Tambah Data
                        </a>
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
                                    <td colspan="10" class="text-center py-5">
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
