<?php

namespace App\Http\Controllers\SuAdmin;

use App\Http\Controllers\Controller;
use App\Models\HotspotData; // Menggunakan Model HotspotData yang baru
use Illuminate\Http\Request;

class HotspotController extends Controller
{
    /**
     * Menampilkan daftar data hotspot.
     */
    public function index()
    {
        // Mengambil data dari Model HotspotData
        $hotspots = HotspotData::latest()->paginate(15);
        return view('suadmin.hotspot.index', compact('hotspots'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('suadmin.hotspot.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi disesuaikan dengan field baru
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

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(HotspotData $hotspot)
    {
        return view('suadmin.hotspot.edit', compact('hotspot'));
    }

    /**
     * Memperbarui data di database.
     */
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

    /**
     * Menghapus data dari database.
     */
    public function destroy(HotspotData $hotspot)
    {
        $hotspot->delete();

        return redirect()->route('suadmin.hotspot.index')
                         ->with('success', 'Data hotspot berhasil dihapus.');
    }
}

