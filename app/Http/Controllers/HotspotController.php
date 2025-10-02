<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function index(Request $request)
    {
        $semuaHotspot = [
            ['id' => 'HS-SKPD-001', 'lokasi' => 'Dinas Kominfo', 'kategori' => 'SKPD', 'alamat' => 'Jl. Pahlawan No. 1', 'kecamatan' => 'Tanjung', 'status' => 'aktif'],
            ['id' => 'HS-FREE-012', 'lokasi' => 'Taman Kota', 'kategori' => 'Free', 'alamat' => 'Jl. Jend. Sudirman', 'kecamatan' => 'Tanjung', 'status' => 'aktif'],
            ['id' => 'HS-SKPD-002', 'lokasi' => 'Badan Kepegawaian Daerah', 'kategori' => 'SKPD', 'alamat' => 'Komplek Perkantoran', 'kecamatan' => 'Murung Pudak', 'status' => 'aktif'],
            ['id' => 'HS-FREE-015', 'lokasi' => 'Terminal Murung Pudak', 'kategori' => 'Free', 'alamat' => 'Jl. A. Yani KM. 5', 'kecamatan' => 'Murung Pudak', 'status' => 'nonaktif'],
            ['id' => 'HS-FREE-021', 'lokasi' => 'Alun-Alun', 'kategori' => 'Free', 'alamat' => 'Pusat Kota', 'kecamatan' => 'Tanjung', 'status' => 'aktif'],
            ['id' => 'HS-SKPD-003', 'lokasi' => 'Dinas Pendidikan', 'kategori' => 'SKPD', 'alamat' => 'Jl. Mawar', 'kecamatan' => 'Tanjung', 'status' => 'aktif'],
        ];

        
        $kategoriAktif = $request->query('kategori', 'skpd');

        $hotspots = array_filter($semuaHotspot, function ($hotspot) use ($kategoriAktif) {
            return strtolower($hotspot['kategori']) === $kategoriAktif;
        });

        // Kembalikan ke satu view: 'hotspot.blade.php'
        return view('hotspot', [
            'hotspots' => $hotspots,
            'kategoriAktif' => $kategoriAktif
        ]);
    }
}