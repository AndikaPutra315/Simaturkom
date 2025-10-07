<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotspotData; // Menggunakan Model HotspotData yang baru

class HotspotController extends Controller
{
    /**
     * Menampilkan halaman data hotspot publik dengan filter kategori.
     */
    public function index(Request $request)
    {
        // 1. Ambil kategori aktif dari URL, default-nya adalah 'skpd'
        $kategoriAktif = $request->query('kategori', 'skpd');

        // 2. Siapkan query ke database
        $query = HotspotData::query();

        // 3. Terapkan filter berdasarkan tab yang aktif
        if ($kategoriAktif == 'skpd') {
            // Jika tab SKPD aktif, cari yang keterangannya 'SKPD'
            $query->where('keterangan', 'SKPD');
        } else {
            // Jika tab Layanan Gratis aktif, cari yang keterangannya BUKAN 'SKPD'
            // (misal: Ruang Terbuka Hijau, Fasilitas Umum, dll)
            $query->where('keterangan', '!=', 'SKPD');
        }

        // 4. Ambil data, urutkan dari tahun terbaru, dan gunakan paginasi
        $hotspots = $query->latest('tahun')->paginate(15); // Menampilkan 15 data per halaman

        // 5. Kirim data dan kategori aktif ke view
        return view('hotspot', compact('hotspots', 'kategoriAktif'));
    }
}