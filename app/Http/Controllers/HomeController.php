<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenara;
use App\Models\Regulasi;
use App\Models\HotspotData;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan data awal untuk chart.
     */
    public function index()
    {
        // Query awal untuk chart (Semua Kecamatan)
        $chartPemilikData = DataMenara::query()
            ->select('provider', DB::raw('count(*) as total'))
            ->groupBy('provider')
            ->orderBy('total', 'desc')
            ->get();

        $initialChartData = [
            'labels' => $chartPemilikData->pluck('provider'),
            'data' => $chartPemilikData->pluck('total'),
        ];
        
        $totalMenara = DataMenara::count();
        $rencanaPembangunan = 12;

        // Mengambil daftar kecamatan untuk filter dropdown
        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        return view('pages.home', compact('initialChartData', 'totalMenara', 'rencanaPembangunan', 'kecamatans'));
    }

    /**
     * BARU: Method untuk menyediakan data chart via AJAX.
     */
    public function getChartData(Request $request)
    {
        $kecamatan = $request->query('kecamatan');

        $query = DataMenara::query()
            ->select('provider', DB::raw('count(*) as total'))
            ->groupBy('provider')
            ->orderBy('total', 'desc');

        // Terapkan filter kecamatan jika bukan 'semua'
        if ($kecamatan && $kecamatan !== 'semua') {
            $query->where('kecamatan', $kecamatan);
        }

        $data = $query->get();

        // Siapkan data untuk dikirim sebagai JSON
        $chartData = [
            'labels' => $data->pluck('provider'),
            'data' => $data->pluck('total'),
        ];

        return response()->json($chartData);
    }

    /**
     * Menampilkan halaman data menara dengan data dari database dan filter.
     */
    public function dataMenara(Request $request)
    {
        $query = DataMenara::query();

        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        $menaraData = $query->latest()->paginate(10);
        $menaraData->appends($request->only(['provider', 'kecamatan']));

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
     * Method untuk membuat dan men-download PDF Data Menara.
     */
    public function generateMenaraPDF(Request $request)
    {
        $query = DataMenara::query();

        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        $menaraData = $query->latest()->get();

        $pdf = Pdf::loadView('pages.datamenara_pdf', compact('menaraData'));
        $pdf->setPaper('a4', 'landscape'); 

        $fileName = 'data-menara-telekomunikasi-' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($fileName);
    }
}