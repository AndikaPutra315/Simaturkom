<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Hotspot - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        .content-card { background-color: #ffffff; border-radius: 12px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07); }
        .card-header h1 { color: #1a237e; }
        .table thead th { text-transform: uppercase; font-weight: 600; color: #33425e;}
        .table td { vertical-align: middle; }
    </style>
</head>
<body>
    @include('includes.header')
    <main class="py-5">
        <div class="container">
            <div class="content-card">
                <div class="card-header p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-0 fw-bold">Kelola Data Hotspot</h1>
                            <p class="text-muted mb-0">Tambah, edit, atau hapus data titik hotspot.</p>
                        </div>
                        <a href="{{ route('suadmin.hotspot.create') }}" class="btn btn-primary fw-bold"><i class="fas fa-plus me-2"></i>Tambah Hotspot</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Tempat</th>
                                    <th>Alamat</th>
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hotspots as $hotspot)
                                    <tr>
                                        <td>{{ $hotspot->nama_tempat }}</td>
                                        <td>{{ $hotspot->alamat }}</td>
                                        <td>{{ $hotspot->tahun }}</td>
                                        <td>{{ $hotspot->keterangan }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('suadmin.hotspot.edit', $hotspot->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('suadmin.hotspot.destroy', $hotspot->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Data hotspot belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>