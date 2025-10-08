<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sebaran - SIMATURKOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
        }
        .main-container {
            display: flex;
            min-height: calc(100vh - 56px); /* Adjust based on header height */
        }
        .filter-sidebar {
            width: 350px;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            z-index: 10;
        }
        .map-content {
            flex-grow: 1;
            padding: 30px;
        }
        .map-placeholder {
            width: 100%;
            height: 100%;
            background-color: #e9ecef;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #6c757d;
            flex-direction: column;
            text-align: center;
        }
        .map-placeholder i {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .nav-pills .nav-link {
            color: #66789a;
            font-weight: 500;
        }
        .nav-pills .nav-link.active {
            background-color: #1a237e;
            color: #ffffff;
        }
        .form-label {
            font-weight: 500;
            color: #33425e;
        }
    </style>
</head>
<body>
    @include('includes.header')

    <div class="main-container">
        <aside class="filter-sidebar">
            <h3 class="fw-bold mb-4" style="color: #1a237e;">Filter Peta</h3>

            <ul class="nav nav-pills nav-fill mb-4" id="petaTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="peta-tower-tab" data-bs-toggle="pill" data-bs-target="#peta-tower" type="button" role="tab">Peta Tower</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="peta-zona-tab" data-bs-toggle="pill" data-bs-target="#peta-zona" type="button" role="tab">Peta Zona</button>
                </li>
            </ul>

            <div class="tab-content" id="petaTabContent">
                <div class="tab-pane fade show active" id="peta-tower" role="tabpanel">
                    <form>
                        <div class="mb-3">
                            <label for="tipePeta" class="form-label">Tipe Peta</label>
                            <select class="form-select" id="tipePeta">
                                <option value="" selected disabled>Pilih Tipe Peta...</option>
                                <option value="provider">Provider (Pemilik Tower)</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                        {{-- Wrapper ini akan disembunyikan/ditampilkan oleh JavaScript --}}
                        <div class="mb-3" id="providerOperatorWrapper" style="display: none;">
                            <label for="providerOperator" class="form-label" id="providerOperatorLabel">Provider</label>
                            <select class="form-select" id="providerOperator"></select>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatanTower" class="form-label">Kecamatan</label>
                            <select class="form-select" id="kecamatanTower">
                                <option>Tanjung</option>
                                <option>Murung Pudak</option>
                                <option>Haruai</option>
                                <option>Kelua</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold" style="background-color: #3f51b5; border:none;">Tampilkan Peta</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="peta-zona" role="tabpanel">
                    <form>
                        <div class="mb-3">
                            <label for="tipeZona" class="form-label">Tipe Zona</label>
                            <select class="form-select" id="tipeZona">
                                <option>Semua</option>
                                <option>Sub Urban</option>
                                <option>Rural</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatanZona" class="form-label">Kecamatan</label>
                            <select class="form-select" id="kecamatanZona">
                                <option>Tanjung</option>
                                <option>Murung Pudak</option>
                                <option>Haruai</option>
                                <option>Kelua</option>
                            </select>
                        </div>
                         <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold" style="background-color: #3f51b5; border:none;">Tampilkan Peta</button>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <main class="map-content">
            <div class="map-placeholder">
                <i class="fas fa-map-marked-alt"></i>
                <p>Peta akan ditampilkan di sini setelah filter diterapkan.</p>
            </div>
        </main>
    </div>

    @include('includes.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipePetaSelect = document.getElementById('tipePeta');
            const providerOperatorWrapper = document.getElementById('providerOperatorWrapper');
            const providerOperatorLabel = document.getElementById('providerOperatorLabel');
            const providerOperatorSelect = document.getElementById('providerOperator');

            const data = {
                provider: ['PT. DAYAMITRA TELEKOMUNIKASI', 'PT. TELKOMSEL', 'PT. PROTELINDO'],
                operator: ['Telkomsel', 'Indosat', 'XL Axiata']
            };

            function updateProviderOperatorDropdown() {
                const selectedType = tipePetaSelect.value;
                if (!selectedType) return; // Jangan lakukan apa-apa jika belum dipilih

                providerOperatorLabel.textContent = selectedType.charAt(0).toUpperCase() + selectedType.slice(1);
                providerOperatorSelect.innerHTML = '';

                const options = data[selectedType];
                options.forEach(optionText => {
                    const option = document.createElement('option');
                    option.value = optionText;
                    option.textContent = optionText;
                    providerOperatorSelect.appendChild(option);
                });
            }

            // Event listener untuk memanggil fungsi setiap kali pilihan 'Tipe Peta' berubah
            tipePetaSelect.addEventListener('change', function() {
                if (this.value) {
                    // Tampilkan wrapper dropdown kedua
                    providerOperatorWrapper.style.display = 'block';
                    // Panggil fungsi untuk mengisi opsi-opsinya
                    updateProviderOperatorDropdown();
                }
            });
        });
    </script>
</body>
</html>