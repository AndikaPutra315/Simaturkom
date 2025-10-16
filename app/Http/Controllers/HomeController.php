<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenara;
use App\Models\Regulasi;
use App\Models\HotspotData;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class HomeController extends Controller
{
    public function index()
    {
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
        $rencanaPembangunan = 12; // Data statis

        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        return view('pages.home', compact('initialChartData', 'totalMenara', 'rencanaPembangunan', 'kecamatans'));
    }

    public function getChartData(Request $request)
    {
        $kecamatan = $request->query('kecamatan');

        $query = DataMenara::query()
            ->select('provider', DB::raw('count(*) as total'))
            ->groupBy('provider')
            ->orderBy('total', 'desc');

        if ($kecamatan && $kecamatan !== 'semua') {
            $query->where('kecamatan', $kecamatan);
        }

        $data = $query->get();

        $chartData = [
            'labels' => $data->pluck('provider'),
            'data' => $data->pluck('total'),
        ];

        return response()->json($chartData);
    }

    /**
     * DIUBAH: Menampilkan halaman data menara dengan filter DAN PENCARIAN.
     */
    public function dataMenara(Request $request)
    {
        $query = DataMenara::query();

        // Logika Pencarian Baru
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('provider', 'like', "%{$search}%")
                  ->orWhere('kelurahan', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Logika filter yang sudah ada
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Paginasi diubah agar menyertakan semua parameter (filter & search)
        $menaraData = $query->latest()->paginate(10)->withQueryString();

        $providers = DataMenara::select('provider')->distinct()->orderBy('provider')->get();
        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        return view('pages.datamenara', compact('menaraData', 'providers', 'kecamatans'));
    }

    public function regulasi()
    {
        $regulasiData = Regulasi::latest()->get();
        return view('pages.regulasi', ['regulasiData' => $regulasiData]);
    }

    public function generateMenaraPDF(Request $request)
    {
        $query = DataMenara::query();

        // Logika filter dan pencarian ditambahkan ke PDF juga
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('provider', 'like', "%{$search}%")
                  ->orWhere('kelurahan', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }
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

    public function trackRegulasiView(Regulasi $regulasi)
    {
        $regulasi->increment('view_count');
        return redirect()->to(Storage::disk('public')->url($regulasi->file_path));
    }

    public function trackRegulasiDownload(Regulasi $regulasi)
    {
        $regulasi->increment('download_count');
        return Storage::disk('public')->download($regulasi->file_path, $regulasi->nama_file_asli);
    }
}
