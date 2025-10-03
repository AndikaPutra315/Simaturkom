<?php

namespace App\Http\Controllers\SuAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataMenara;
use Illuminate\Http\Request;

class DataMenaraController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar untuk mengambil data menara
        $query = DataMenara::query();

        // Terapkan filter jika ada input dari request
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Ambil data yang sudah difilter, urutkan, dan paginasi
        $menara = $query->latest()->paginate(10)->withQueryString();

        // Ambil data unik untuk mengisi dropdown filter
        $providers = DataMenara::select('provider')->distinct()->orderBy('provider')->get();
        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        return view('suadmin.datamenara.index', compact('menara', 'providers', 'kecamatans'));
    }

    // ... (metode lainnya biarkan kosong dulu) ...
}
