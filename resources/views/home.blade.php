<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SIMATURKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400;500&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        html {
            scroll-behavior: smooth;
        }
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
        }
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
        }


        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.25rem;
            font-weight: 700;
            color: #1a237e;
            text-align: center;
            margin-bottom: 15px;
        }
        .section-divider {
            width: 80px;
            height: 4px;
            background-color: #ffab00;
            border: none;
            margin: 0 auto 40px auto;
        }

        .hero-container {
            background-image: linear-gradient(rgba(26, 35, 126, 0.7), rgba(63, 81, 181, 0.7)), url("{{ asset('images/bg-home.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            text-align: center;
            position: relative;

            /* BARU: Membuat section setinggi layar penuh dan menengahkan konten */
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 2rem;
        }
        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
        }
        .hero-subtitle {
            font-family: 'Roboto', sans-serif;
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 0;
        }

        /* =================================
           Bagian Konten - Tentang Sistem
           ================================= */
        .content-section {
            padding: 60px 0;
            background-color: #ffffff;
        }
        .content-section p {
            font-size: 1rem;
            color: #555;
            line-height: 1.8;
            text-align: justify;
            max-width: 800px;
            margin: 0 auto 20px auto;
        }

        /* =================================
           Fitur Utama Section
           ================================= */
        .features-section {
            padding: 60px 0;
            background-color: #f4f7fc;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        .feature-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.1);
        }
        .feature-icon {
            font-size: 3rem;
            color: #1a237e;
            margin-bottom: 20px;
        }
        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0 0 10px 0;
        }
        .feature-card p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #666;
        }

        /* =================================
           Statistik dan Chart Section
           ================================= */
        .stats-and-chart-section {
            padding: 60px 0;
            background-color: #ffffff;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        .stat-card {
            background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%);
            color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 25px;
            box-shadow: 0 8px 20px rgba(26, 35, 126, 0.2);
        }
        .stat-card .icon {
            font-size: 3.5rem;
            opacity: 0.8;
        }
        .stat-card .info .number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }
        .stat-card .info .label {
            font-size: 1rem;
            font-weight: 400;
            margin: 0;
            opacity: 0.9;
        }
        .chart-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Styling untuk Tab Filter Chart */
        .chart-tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        .chart-tab-item {
            padding: 12px 25px;
            cursor: pointer;
            border: none;
            background-color: transparent;
            font-size: 1rem;
            color: #495057;
            position: relative;
            transition: color 0.3s ease;
        }
        .chart-tab-item.active {
            color: #1a237e;
            font-weight: 600;
            background-color: #eef2f9;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        /* Styling untuk Filter Dropdown */
        .chart-filters {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .chart-filters select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dcdfe6;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            background-color: #fdfdfd;
        }

    </style>
</head>
<body>

    @include('includes.header')

    <main>
        <section class="hero-container">
            <div class="container">
                <h1 class="hero-title">SIMATURKOM</h1>
                <p class="hero-subtitle">Sistem Informasi Manajemen Infrastruktur Komunikasi</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <h2 class="section-title">Tentang Sistem Kami</h2>
                <hr class="section-divider">
                <p>
                    SIMATURKOM adalah platform terintegrasi yang dirancang untuk mengelola dan memantau seluruh infrastruktur komunikasi di Kabupaten Tabalong. Sistem ini bertujuan untuk meningkatkan efisiensi, transparansi, dan pengambilan keputusan berbasis data yang akurat.
                </p>
                <p>
                    Dengan memanfaatkan teknologi terkini, kami menyediakan data real-time mengenai menara telekomunikasi, jaringan hotspot, serta peta zona strategis. Hal ini memungkinkan Dinas Komunikasi dan Informatika untuk merencanakan pengembangan infrastruktur secara lebih efektif dan merata bagi seluruh masyarakat.
                </p>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Fitur Unggulan</h2>
                <hr class="section-divider">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-broadcast-tower"></i></div>
                        <h3>Manajemen Menara</h3>
                        <p>Kelola data menara telekomunikasi secara terpusat, mulai dari lokasi, status, hingga perizinan.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-wifi"></i></div>
                        <h3>Pemetaan Hotspot</h3>
                        <p>Visualisasikan persebaran titik hotspot publik untuk analisis jangkauan dan optimalisasi layanan.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h3>Analisis Spasial</h3>
                        <p>Gunakan Peta Zona dan Peta Tower untuk perencanaan strategis dan penempatan infrastruktur baru.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="data-infrastruktur" class="stats-and-chart-section">
            <div class="container">
                <h2 class="section-title">Data Infrastruktur</h2>
                <hr class="section-divider">

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="icon"><i class="fas fa-satellite-dish"></i></div>
                        <div class="info">
                            <p class="number">153</p>
                            <p class="label">Jumlah Tower BTS</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                        <div class="info">
                            <p class="number">12</p>
                            <p class="label">Rencana Pembangunan</p>
                        </div>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-tabs">
                        <button class="chart-tab-item active" data-chart="pemilik">Chart Pemilik Tower</button>
                        <button class="chart-tab-item" data-chart="koneksi">Chart Tipe Koneksi</button>
                        <button class="chart-tab-item" data-chart="operator">Chart Operator</button>
                    </div>

                    <div class="chart-filters">
                        <select id="kecamatanFilter">
                            <option value="semua">Semua Kecamatan</option>
                            <option value="banua-lawas">Banua Lawas</option>
                            <option value="pugaan">Pugaan</option>
                            <option value="haruai">Haruai</option>
                        </select>
                        <select id="kategoriFilter">
                            <option value="semua">Semua Kategori</option>
                            <option value="komersil">Komersil</option>
                            <option value="non-komersil">Non-Komersil</option>
                        </select>
                    </div>

                    <div>
                        <canvas id="towerChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // --- DATA CONTOH UNTUK SEMUA CHART ---
            const chartData = {
                pemilik: {
                    labels: ['Protelindo', 'Dayamitra', 'Tower Bersama', 'Centratama'],
                    data: [40, 35, 30, 25]
                },
                koneksi: {
                    labels: ['3G', '4G', '5G'],
                    data: [50, 85, 18]
                },
                operator: {
                    labels: ['Telkomsel', 'Indosat', 'XL Axiata', 'Smartfren'],
                    data: [95, 40, 35, 15]
                }
            };

            Chart.register(ChartDataLabels);

            // --- Inisialisasi Chart ---
            const ctx = document.getElementById('towerChart').getContext('2d');
            const towerChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.pemilik.labels,
                    datasets: [{
                        label: 'Jumlah',
                        data: chartData.pemilik.data,
                        backgroundColor: 'rgba(26, 35, 126, 0.8)',
                        borderColor: 'rgba(26, 35, 126, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grace: '10%'
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: (value, context) => {
                                const dataset = context.chart.data.datasets[0];
                                const total = dataset.data.reduce((sum, data) => sum + data, 0);
                                const percentage = (value / total * 100).toFixed(1) + '%';
                                return percentage;
                            },
                            color: '#333',
                            font: {
                                weight: 'bold',
                                size: 12,
                            }
                        }
                    }
                }
            });

            // --- Logika untuk mengelola chart ---
            const tabs = document.querySelectorAll('.chart-tab-item');
            const kecamatanFilter = document.getElementById('kecamatanFilter');
            const kategoriFilter = document.getElementById('kategoriFilter');

            let activeChartType = 'pemilik';

            function updateChart() {
                const newData = chartData[activeChartType];

                console.log(`Updating chart for: ${activeChartType}, Kecamatan: ${kecamatanFilter.value}, Kategori: ${kategoriFilter.value}`);

                towerChart.data.labels = newData.labels;
                towerChart.data.datasets[0].data = newData.data;
                towerChart.update();
            }

            // Event listener untuk Tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                    activeChartType = this.dataset.chart;
                    updateChart();
                });
            });

            // Event listener untuk Filter
            kecamatanFilter.addEventListener('change', updateChart);
            kategoriFilter.addEventListener('change', updateChart);
        });
    </script>

    @include('includes.footer')

</body>
</html>
