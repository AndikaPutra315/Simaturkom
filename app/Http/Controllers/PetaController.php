<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        // Di sini Anda bisa mengambil data awal untuk filter dari database
        // Misalnya, daftar semua provider, operator, dan kecamatan
        return view('pages.peta');
    }
}
