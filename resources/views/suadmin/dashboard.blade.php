<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIMATURKOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f4f7fc; font-family: 'Poppins', sans-serif; }
        .stat-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.1);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
    @include('includes.header')

    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-xl-3 fade-in-up" style="animation-delay: 0.1s;">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="fa-3x me-4 text-primary"><i class="fas fa-broadcast-tower"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $totalMenara }}</h2>
                            <span class="text-muted">Total Data Menara</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 fade-in-up" style="animation-delay: 0.2s;">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="fa-3x me-4 text-success"><i class="fas fa-wifi"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $totalHotspot }}</h2>
                            <span class="text-muted">Total Titik Hotspot</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 fade-in-up" style="animation-delay: 0.3s;">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="fa-3x me-4 text-warning"><i class="fas fa-file-alt"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $totalRegulasi }}</h2>
                            <span class="text-muted">Total Dokumen Regulasi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 fade-in-up" style="animation-delay: 0.4s;">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="fa-3x me-4 text-danger"><i class="fas fa-users"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $totalUser }}</h2>
                            <span class="text-muted">Total Pengguna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-8 fade-in-up" style="animation-delay: 0.5s;">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title mb-0 fw-bold">Jumlah Menara per Provider</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="providerChart" style="height: 350px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 fade-in-up" style="animation-delay: 0.6s;">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title mb-0 fw-bold">Aksi Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('suadmin.datamenara.create') }}" class="btn btn-primary btn-lg"><i class="fas fa-plus me-2"></i> Tambah Data Menara</a>
                            <a href="{{ route('suadmin.hotspot.create') }}" class="btn btn-outline-success btn-lg"><i class="fas fa-plus me-2"></i> Tambah Data Hotspot</a>
                            <a href="{{ route('suadmin.regulasi.create') }}" class="btn btn-outline-warning btn-lg"><i class="fas fa-plus me-2"></i> Tambah Regulasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('providerChart').getContext('2d');
            const providerChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($menaraPerProvider->pluck('provider')) !!},
                    datasets: [{
                        label: 'Jumlah Menara',
                        data: {!! json_encode($menaraPerProvider->pluck('total')) !!},
                        backgroundColor: 'rgba(26, 35, 126, 0.8)',
                        borderColor: 'rgba(26, 35, 126, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
</body>
</html>
