<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenara;
use App\Models\Regulasi;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan baris ini ada

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama.
     */
    public function index()
    {
        $data = [
            'title' => 'Selamat Datang!',
            'description' => 'Ini adalah halaman utama website yang dibuat dengan Laravel.'
        ];
        return view('pages.home', $data);
    }

    /**
     * Menampilkan halaman data menara dengan data dari database dan filter.
     */
    public function dataMenara(Request $request)
    {
        $query = DataMenara::query();

        // Menerapkan filter provider jika ada
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        
        // Menerapkan filter kecamatan jika ada
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        $menaraData = $query->latest()->paginate(10);
        
        // Menjaga agar filter tetap aktif saat berpindah halaman paginasi
        $menaraData->appends($request->only(['provider', 'kecamatan']));

        // Mengambil data unik untuk mengisi dropdown filter
        $providers = DataMenara::select('provider')->distinct()->orderBy('provider')->get();
        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();
        
        return view('pages.datamenara', compact('menaraData', 'providers', 'kecamatans'));
    }

    /**
     * Menampilkan halaman regulasi.
     */
    public function regulasi()
    {
        $regulasiData = Regulasi::latest()->get();
        return view('pages.regulasi', ['regulasiData' => $regulasiData]);
    }
    
    /**
     * Method baru untuk membuat dan men-download PDF Data Menara.
     */
    public function generateMenaraPDF(Request $request)
    {
        $query = DataMenara::query();

        // Menerapkan filter yang sama dari halaman publik
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Ambil SEMUA data yang cocok (tanpa paginasi)
        $menaraData = $query->latest()->get();

        // Load view PDF dengan data
        $pdf = Pdf::loadView('pages.datamenara_pdf', compact('menaraData'));
        
        // Atur orientasi kertas menjadi landscape karena tabelnya lebar
        $pdf->setPaper('a4', 'landscape'); 

        $fileName = 'data-menara-telekomunikasi-' . date('Y-m-d') . '.pdf';
        
        // Download file PDF
        return $pdf->download($fileName);
    }
}