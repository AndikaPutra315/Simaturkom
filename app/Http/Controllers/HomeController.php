<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama.
     */
    public function index()
    {
        // Data yang ingin dikirim ke view (opsional)
        $data = [
            'title' => 'Selamat Datang!',
            'description' => 'Ini adalah halaman utama website yang dibuat dengan Laravel.'
        ];

        // Memanggil view 'home.blade.php' dan mengirim data
        return view('home', $data);
    }
}
