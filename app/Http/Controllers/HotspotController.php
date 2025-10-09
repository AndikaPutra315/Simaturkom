<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotspotData;
use Barryvdh\DomPDF\Facade\Pdf; // Import class PDF

class HotspotController extends Controller
{
    /**
     * Menampilkan halaman data hotspot publik dengan filter kategori dan pencarian.
     */
    public function index(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'skpd');
        $searchTerm = $request->query('search');

        $query = HotspotData::query();

        if ($kategoriAktif == 'skpd') {
            $query->where('keterangan', 'SKPD');
        } else {
            // Kita perbaiki logikanya agar lebih spesifik
            $query->where('keterangan', 'RTH/Layanan Publik');
        }

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_tempat', 'like', "%{$searchTerm}%")
                  ->orWhere('alamat', 'like', "%{$searchTerm}%")
                  ->orWhere('tahun', 'like', "%{$searchTerm}%");
            });
        }

        $hotspots = $query->latest('tahun')->paginate(15);
        $hotspots->appends($request->only(['kategori', 'search']));

        return view('pages.hotspot', compact('hotspots', 'kategoriAktif', 'searchTerm'));
    }

    /**
     * Mengambil data autocomplete berdasarkan nama, alamat, atau tahun.
     */
    public function autocomplete(Request $request)
    {
        $searchTerm = $request->query('term');
        
        if (!$searchTerm) {
            return response()->json([]);
        }

        $data = HotspotData::where('nama_tempat', 'LIKE', '%'. $searchTerm . '%')
                           ->orWhere('alamat', 'LIKE', '%'. $searchTerm . '%')
                           ->orWhere('tahun', 'LIKE', '%'. $searchTerm . '%')
                           ->limit(10)
                           ->distinct()
                           ->pluck('nama_tempat');

        return response()->json($data);
    }

    /**
     * Method untuk membuat dan men-download PDF.
     */
    public function generatePDF(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'skpd');
        $searchTerm = $request->query('search');

        // Mengambil data dengan filter yang sama seperti di halaman index
        $query = HotspotData::query();
        if ($kategoriAktif == 'skpd') {
            $query->where('keterangan', 'SKPD');
        } else {
            $query->where('keterangan', 'RTH/Layanan Publik');
        }
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_tempat', 'like', "%{$searchTerm}%")
                  ->orWhere('alamat', 'like', "%{$searchTerm}%")
                  ->orWhere('tahun', 'like', "%{$searchTerm}%");
            });
        }
        
        // Ambil SEMUA data yang cocok (tanpa paginasi)
        $hotspots = $query->latest('tahun')->get(); 

        // Load view PDF dengan data
        $pdf = Pdf::loadView('pages.hotspot_pdf', compact('hotspots'));

        // Buat nama file dinamis
        $fileName = 'data-hotspot-' . date('Y-m-d') . '.pdf';
        
        // Download file PDF
        return $pdf->download($fileName);
    }
}