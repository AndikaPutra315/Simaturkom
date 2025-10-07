<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hotspot Baru - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        .content-card { background-color: #ffffff; border-radius: 12px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07); }
        .card-header h1 { color: #1a237e; }
    </style>
</head>
<body>
    @include('includes.header')
    <main class="py-5">
        <div class="container">
            <div class="content-card">
                 <div class="card-header p-4 border-bottom"><h1 class="mb-0 fw-bold">Tambah Data Hotspot Baru</h1></div>
                 <div class="card-body p-4">
                    <form action="{{ route('suadmin.hotspot.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_tempat" class="form-label">Nama Tempat</label>
                            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" required placeholder="Contoh: 2024">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                {{-- PERUBAHAN DARI INPUT MENJADI SELECT --}}
                                <select class="form-select" id="keterangan" name="keterangan" required>
                                    <option value="SKPD">SKPD</option>
                                    <option value="RTH/Layanan Publik">RTH/Layanan Publik</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('suadmin.hotspot.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>
</html>