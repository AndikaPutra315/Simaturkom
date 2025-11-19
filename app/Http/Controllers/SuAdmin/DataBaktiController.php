<?php

namespace App\Http\Controllers\SuAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataBakti; // MENGGUNAKAN MODEL DataBakti
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class DataBaktiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DataBakti::query();

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode', 'like', '%' . $search . '%')
                  ->orWhere('provider', 'like', '%' . $search . '%')
                  ->orWhere('kecamatan', 'like', '%' . $search . '%');
            });
        }

        // Logika Filter untuk Dropdown
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }


        $dataBakti = $query->latest()->paginate(10)->withQueryString();

        // Ambil data filter untuk dropdown
        $providers = DataBakti::select('provider')->distinct()->orderBy('provider')->get();
        $kecamatans = DataBakti::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        // Kirim semua data dan filter ke view
        return view('suadmin.databakti.index', compact('dataBakti', 'providers', 'kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // PERBAIKAN: Hapus 'pages.'
        return view('suadmin.databakti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validasi disesuaikan dengan skema baru
            'kode' => 'nullable|string|max:255|unique:data_bakti,kode',
            'provider' => 'required|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'tinggi_tower' => 'nullable|integer',
        ]);

        DataBakti::create($validated);

        return redirect()->route('suadmin.databakti.index')->with('success', 'Data Bakti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataBakti $dataBakti)
    {
        // Method ini biasanya tidak dipakai, biarkan saja
    }

    /**
     * UBAH KE MANUAL: Menggunakan $id bukan binding model otomatis
     */
    public function edit($id)
    {
        // Cari data secara manual. Jika tidak ada, akan otomatis melempar 404.
        $dataBakti = DataBakti::findOrFail($id);

        // PERBAIKAN: Hapus 'pages.'
        return view('suadmin.databakti.edit', compact('dataBakti'));
    }

    /**
     * UBAH KE MANUAL: Menggunakan $id
     */
    public function update(Request $request, $id)
    {
        $dataBakti = DataBakti::findOrFail($id); // Cari data secara manual

        $validated = $request->validate([
            // Validasi update, abaikan unique untuk kode milik sendiri
            'kode' => 'nullable|string|max:255|unique:data_bakti,kode,' . $dataBakti->id,
            'provider' => 'required|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'tinggi_tower' => 'nullable|integer',
        ]);

        $dataBakti->update($validated);

        return redirect()->route('suadmin.databakti.index')->with('success', 'Data Bakti berhasil diperbarui.');
    }

    /**
     * UBAH KE MANUAL: Menggunakan $id
     */
    public function destroy($id)
    {
        $dataBakti = DataBakti::findOrFail($id); // Cari data secara manual
        $dataBakti->delete();

        return redirect()->route('suadmin.databakti.index')->with('success', 'Data Bakti berhasil dihapus.');
    }

    /**
     * Membuat file PDF dari data bakti.
     */
    public function generatePDF(Request $request)
    {
        $query = DataBakti::query();

        // Salin logika filter dan pencarian dari method index()
        // agar PDF yang dicetak sesuai dengan yang difilter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode', 'like', '%' . $search . '%')
                  ->orWhere('provider', 'like', '%' . $search . '%')
                  ->orWhere('kecamatan', 'like', '%' . $search . '%');
            });
        }
        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Ambil SEMUA data yang cocok (tanpa paginasi)
        $dataBakti = $query->latest()->get();

        // Memuat view PDF
        $pdf = Pdf::loadView('suadmin.databakti.pdf', compact('dataBakti'));
        $pdf->setPaper('a4', 'landscape'); // Atur ke landscape

        $fileName = 'data-bakti-' . date('Y-m-d') . '.pdf';
        return $pdf->download($fileName);
    }

    // --- (FUNGSI BARU SAYA TAMBAHKAN DI SINI) ---
    /**
     * Mengimpor data dari file Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // PENTING: Kode ini membutuhkan sebuah class Import baru
            // yang bernama 'App\Imports\DataBaktiImport'
            // Jika class itu belum ada, kita harus membuatnya.

            $importClass = '\App\Imports\DataBaktiImport';

            if (!class_exists($importClass)) {
                return redirect()->back()->with('error', 'Gagal: Fitur import belum siap. Class <strong>' . $importClass . '</strong> tidak ditemukan.');
            }

            Excel::import(new $importClass, $request->file('file_excel'));

            return redirect()->route('suadmin.databakti.index')->with('success', 'Data Bakti berhasil diimpor.');

        } catch (Exception $e) {
            // Tangkap semua jenis error (misal: file salah format)
            return redirect()->route('suadmin.databakti.index')->with('error', 'Gagal mengimpor data. Pastikan format file benar. Error: ' . $e->getMessage());
        }
    }
}
