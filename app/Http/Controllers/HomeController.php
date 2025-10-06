<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenara; // <-- IMPORT MODEL DATA MENARA
use App\Models\Regulasi;

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
        return view('home', $data);
    }

    /**
     * Menampilkan halaman data menara dengan data dari database.
     */
    public function dataMenara()
    {
        // Ambil data dari database dengan paginasi (10 data per halaman)
        $menaraData = DataMenara::paginate(10);

        // Kirim data ke view
        return view('datamenara', ['menaraData' => $menaraData]);
    }

    /**
     * Menampilkan halaman regulasi.
     */
    public function regulasi()
    {
        // 2. Ambil semua data regulasi dari database
        $regulasiData = Regulasi::latest()->get();

        // 3. Kirim data ke view 'regulasi'
        return view('regulasi', ['regulasiData' => $regulasiData]);
    }
}
