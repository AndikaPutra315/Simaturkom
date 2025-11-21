<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Bakti - Admin</title>
    {{-- Bootstrap & Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }
        main { flex: 1; padding: 40px 0; }

        /* Layout Container yang Ramping & Fokus */
        .container-fluid { max-width: 1100px; padding: 0 30px; }

        /* Card Styling Profesional */
        .content-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: none;
        }

        /* Header dengan Aksen Diskominfo (Biru Tua) */
        .card-header {
            padding: 25px 40px;
            border-bottom: 1px solid #eee;
            background: linear-gradient(to right, #ffffff, #f8f9fa);
            border-left: 5px solid #1a237e; /* Aksen Identitas */
        }
        .card-header h1 { margin: 0; font-size: 1.5rem; font-weight: 700; color: #1a237e; }
        .card-header p { margin: 5px 0 0 0; color: #6c757d; font-size: 0.9rem; }

        .card-body { padding: 40px; }

        /* Form Styling */
        .form-label { font-weight: 600; color: #495057; font-size: 0.9rem; margin-bottom: 8px; }
        .form-control, .form-select {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #1a237e;
            box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.15);
        }
        .form-section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #adb5bd;
            font-weight: 700;
            margin-bottom: 20px;
            margin-top: 10px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
        }

        /* Footer & Buttons */
        .card-footer {
            background-color: #ffffff;
            padding: 20px 40px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }
        /* Tombol Simpan (Primary) */
        .btn-save {
            background-color: #1a237e;
            color: white;
            box-shadow: 0 4px 6px rgba(26, 35, 126, 0.2);
        }
        .btn-save:hover {
            background-color: #121858;
            transform: translateY(-1px);
            box-shadow: 0 6px 8px rgba(26, 35, 126, 0.25);
        }
        /* Tombol Batal (Secondary) */
        .btn-cancel {
            background-color: #fff;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }
        .btn-cancel:hover {
            background-color: #f8f9fa;
            color: #333;
            border-color: #d3d9df;
        }
    </style>
</head>
<body>
    @include('includes.header')

    <main>
        <div class="container-fluid">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fs-4 me-3"></i>
                        <div>
                            <h6 class="alert-heading fw-bold mb-1">Terdapat Kesalahan Input</h6>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('suadmin.databakti.update', $dataBakti->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="content-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Edit Data Bakti</h1>
                                <p>Memperbarui data untuk Provider: <strong>{{ $dataBakti->provider }}</strong></p>
                            </div>
                            <div class="text-muted opacity-50">
                                <i class="fas fa-pen-to-square fa-3x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- BAGIAN 1: INFORMASI UMUM --}}
                        <div class="form-section-title">1. Informasi Umum</div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label for="provider" class="form-label">Provider (Nama Penyedia) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-building text-muted"></i></span>
                                    <input type="text" class="form-control" id="provider" name="provider" value="{{ old('provider', $dataBakti->provider) }}" required placeholder="Contoh: Telkomsel">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="kode" class="form-label">Kode Unik / Site ID</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-barcode text-muted"></i></span>
                                    <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $dataBakti->kode) }}" placeholder="Contoh: BKT-001">
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 2: LOKASI & ALAMAT --}}
                        <div class="form-section-title">2. Lokasi & Alamat</div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $dataBakti->kecamatan) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="kelurahan" class="form-label">Kelurahan/Desa</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $dataBakti->kelurahan) }}">
                            </div>

                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $dataBakti->alamat) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude (Garis Lintang)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $dataBakti->latitude) }}" placeholder="-2.xxxxx">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude (Garis Bujur)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $dataBakti->longitude) }}" placeholder="115.xxxxx">
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 3: STATUS & TEKNIS --}}
                        <div class="form-section-title">3. Data Teknis & Status</div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status Operasional</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Aktif" {{ old('status', $dataBakti->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status', $dataBakti->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="Lainnya" {{ old('status', $dataBakti->status) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="tinggi_tower" class="form-label">Tinggi Tower</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="tinggi_tower" name="tinggi_tower" value="{{ old('tinggi_tower', $dataBakti->tinggi_tower) }}">
                                    <span class="input-group-text bg-light">Meter</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TOMBOL AKSI --}}
                    <div class="card-footer">
                        <a href="{{ route('suadmin.databakti.index') }}" class="btn-custom btn-cancel me-3">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn-custom btn-save">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
