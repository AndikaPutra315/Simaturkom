<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sebaran - SIMATURKOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        .main-container { display: flex; height: calc(100vh - 72px); }
        .filter-sidebar { width: 350px; background-color: #ffffff; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); z-index: 10; overflow-y: auto; }
        .map-content { flex-grow: 1; position: relative; }
        #map { width: 100%; height: 100%; }
        .nav-pills .nav-link.active { background-color: #1a237e; }
        .form-label { font-weight: 500; color: #33425e; }
        .loader {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            border: 8px solid #f3f3f3; border-radius: 50%; border-top: 8px solid #1a237e;
            width: 60px; height: 60px; animation: spin 1s linear infinite;
            display: none; z-index: 1000;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    @include('includes.header')
    <div class="main-container">
        <aside class="filter-sidebar">
            <h3 class="fw-bold mb-4" style="color: #1a237e;">Filter Peta</h3>
            <ul class="nav nav-pills nav-fill mb-4" id="petaTab" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#peta-tower" type="button">Peta Tower</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#peta-zona" type="button">Peta Zona</button></li>
            </ul>
            <div class="tab-content" id="petaTabContent">
                <div class="tab-pane fade show active" id="peta-tower" role="tabpanel">
                    <form id="formPetaTower">
                        <div class="mb-3">
                            <label for="provider" class="form-label">Provider</label>
                            <select class="form-select" id="provider">
                                <option value="semua">Semua Provider</option>
                                @foreach($providers as $provider)
                                    <option value="{{ $provider->provider }}">{{ $provider->provider }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatanTower" class="form-label">Kecamatan</label>
                            <select class="form-select" id="kecamatanTower">
                                <option value="semua">Semua Kecamatan</option>
                                @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->kecamatan }}">{{ $kecamatan->kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid"><button type="submit" class="btn btn-primary fw-bold" style="background-color: #3f51b5; border:none;">Tampilkan Peta</button></div>
                    </form>
                </div>
                <div class="tab-pane fade" id="peta-zona" role="tabpanel">
                    <p class="text-center text-muted">Fitur Peta Zona sedang dalam pengembangan.</p>
                </div>
            </div>
        </aside>
        <main class="map-content">
            <div id="map"></div>
            <div id="mapLoader" class="loader"></div>
        </main>
    </div>

    @include('includes.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([-2.16, 115.38], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(map);

            // **PERUBAHAN UTAMA DI SINI**
            // Menggunakan L.featureGroup() alih-alih L.layerGroup()
            const markersLayer = L.featureGroup().addTo(map);

            const mapLoader = document.getElementById('mapLoader');
            const formPetaTower = document.getElementById('formPetaTower');

            formPetaTower.addEventListener('submit', function(event) {
                event.preventDefault();
                mapLoader.style.display = 'block';

                const params = new URLSearchParams({
                    provider: document.getElementById('provider').value,
                    kecamatan: document.getElementById('kecamatanTower').value,
                });
                
                fetch(`{{ route('peta.menara_data') }}?${params.toString()}`)
                    .then(response => response.json())
                    .then(dataMenara => {
                        markersLayer.clearLayers();
                        if (dataMenara.length === 0) {
                            alert('Tidak ada data menara yang ditemukan dengan filter ini.');
                            mapLoader.style.display = 'none';
                            return;
                        }

                        dataMenara.forEach(menara => {
                            if (menara.latitude && menara.longitude) {
                                const lat = parseFloat(menara.latitude);
                                const lon = parseFloat(menara.longitude);
                                if (!isNaN(lat) && !isNaN(lon)) {
                                    const marker = L.marker([lat, lon]);
                                    marker.bindPopup(`<b>${menara.provider || 'Data Tower'}</b><br>${menara.alamat}`);
                                    markersLayer.addLayer(marker);
                                }
                            }
                        });

                        if (markersLayer.getLayers().length > 0) {
                            map.fitBounds(markersLayer.getBounds());
                        }
                        
                        mapLoader.style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error fetching map data:', error);
                        alert('Terjadi kesalahan saat mengambil data peta.');
                        mapLoader.style.display = 'none';
                    });
            });
        });
    </script>
</body>
</html>

