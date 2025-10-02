<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi - SIMATURKOM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Sedikit style tambahan untuk menyesuaikan dengan tema */
        body {
            background-color: #f4f7fc;
            font-family: 'Poppins', sans-serif; /* Opsional: Anda bisa gunakan font dari Bootstrap */
        }
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: none;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #333;
            font-weight: 600;
        }
        .card-footer {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    @include('includes.header')

    <main class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="fw-bold">Dokumen Regulasi</h1>
                    <p class="text-muted">Daftar peraturan dan dokumen terkait menara telekomunikasi.</p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body">
                            <h5 class="card-title">Permen No. 5 Tahun 2013</h5>
                        </div>
                        {{-- PERUBAHAN: Menambahkan display flex dan gap agar tombol sejajar --}}
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ asset('pdf/2013permen5..pdf') }}" class="btn btn-outline-primary w-100" download>
                                <i class="fas fa-download me-2"></i> Download
                            </a>
                            <a href="{{ asset('pdf/2013permen5..pdf') }}" class="btn btn-outline-success w-100" target="_blank">
                                <i class="fas fa-eye me-2"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body">
                            <h5 class="card-title">Telecommunications Operations</h5>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ asset('pdf/Telecommunications_Operations.pdf') }}" class="btn btn-outline-primary w-100" download>
                                <i class="fas fa-download me-2"></i> Download
                            </a>
                            <a href="{{ asset('pdf/Telecommunications_Operations.pdf') }}" class="btn btn-outline-success w-100" target="_blank">
                                <i class="fas fa-eye me-2"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body">
                            <h5 class="card-title">Penyelenggaraan Jaringan Telekomunikasi</h5>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ asset('pdf/Penyelenggaraan_Jaringan_Telekomunikasi.pdf') }}" class="btn btn-outline-primary w-100" download>
                                <i class="fas fa-download me-2"></i> Download
                            </a>
                            <a href="{{ asset('pdf/Penyelenggaraan_Jaringan_Telekomunikasi.pdf') }}" class="btn btn-outline-success w-100" target="_blank">
                                <i class="fas fa-eye me-2"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>