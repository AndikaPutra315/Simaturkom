<?php

namespace App\Http\Controllers\SuAdmin;

use App\Http\Controllers\Controller;
use App\Models\HotspotData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <-- 1. Import class PDF

class HotspotController extends Controller
{
    public function index()
    {
        $hotspots = HotspotData::latest()->paginate(15);
        return view('suadmin.hotspot.index', compact('hotspots'));
    }

    public function create()
    {
        return view('suadmin.hotspot.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'keterangan' => 'required|string|max:255',
        ]);

        HotspotData::create($request->all());

        return redirect()->route('suadmin.hotspot.index')
                         ->with('success', 'Data hotspot baru berhasil ditambahkan.');
    }

    public function edit(HotspotData $hotspot)
    {
        return view('suadmin.hotspot.edit', compact('hotspot'));
    }

    public function update(Request $request, HotspotData $hotspot)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'keterangan' => 'required|string|max:255',
        ]);

        $hotspot->update($request->all());

        return redirect()->route('suadmin.hotspot.index')
                         ->with('success', 'Data hotspot berhasil diperbarui.');
    }

    public function destroy(HotspotData $hotspot)
    {
        $hotspot->delete();

        return redirect()->route('suadmin.hotspot.index')
                         ->with('success', 'Data hotspot berhasil dihapus.');
    }

    /**
     * BARU: Method untuk membuat dan men-download PDF dari halaman admin.
     */
    public function generatePDF()
    {
        // Ambil SEMUA data hotspot (tanpa paginasi)
        $hotspots = HotspotData::latest('tahun')->get(); 

        // Load view PDF dengan data (kita gunakan view yang sama dengan halaman publik)
        $pdf = Pdf::loadView('pages.hotspot_pdf', compact('hotspots'));

        // Buat nama file dinamis
        $fileName = 'data-hotspot-admin-' . date('Y-m-d') . '.pdf';
        
        // Download file PDF
        return $pdf->download($fileName);
    }
}

