<?php

namespace App\Http\Controllers\SuAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataMenara;
use Illuminate\Http\Request;

class DataMenaraController extends Controller
{
    /**
     * Menampilkan daftar semua data menara dengan filter dan paginasi.
     */
    public function index(Request $request)
    {
        $query = DataMenara::query();

        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        $menara = $query->latest()->paginate(10)->withQueryString();

        $providers = DataMenara::select('provider')->distinct()->orderBy('provider')->get();
        $kecamatans = DataMenara::select('kecamatan')->distinct()->orderBy('kecamatan')->get();

        return view('suadmin.datamenara.index', compact('menara', 'providers', 'kecamatans'));
    }

    /**
     * Menampilkan form untuk membuat data menara baru.
     */
    public function create()
    {
        return view('suadmin.datamenara.create');
    }

    /**
     * Menyimpan data menara baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255|unique:data_menara',
            'provider' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'tipe_ukuran' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tinggi_tower' => 'required|integer',
        ]);

        DataMenara::create($request->all());

        return redirect()->route('suadmin.datamenara.index')
                         ->with('success', 'Data menara baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data menara.
     */
    public function edit(DataMenara $datamenara)
    {
        return view('suadmin.datamenara.edit', compact('datamenara'));
    }

    /**
     * Memperbarui data menara di database.
     */
    public function update(Request $request, DataMenara $datamenara)
    {
        $request->validate([
            'kode' => 'required|string|max:255|unique:data_menara,kode,' . $datamenara->id,
            'provider' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'tipe_ukuran' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tinggi_tower' => 'required|integer',
        ]);

        $datamenara->update($request->all());

        return redirect()->route('suadmin.datamenara.index')
                         ->with('success', 'Data menara berhasil diperbarui.');
    }

    /**
     * Menghapus data menara dari database.
     */
    public function destroy(DataMenara $datamenara)
    {
        $datamenara->delete();

        return redirect()->route('suadmin.datamenara.index')
                         ->with('success', 'Data menara berhasil dihapus.');
    }
}
