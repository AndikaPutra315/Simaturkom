<?php

namespace App\Imports;

use App\Models\DataMenara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation; // DITAMBAHKAN
use Maatwebsite\Excel\Concerns\SkipsOnFailure; // DITAMBAHKAN
use Maatwebsite\Excel\Validators\Failure;      // DITAMBAHKAN
use Maatwebsite\Excel\Concerns\Importable;     // DITAMBAHKAN

class DataMenaraImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure
{
    use Importable; // DITAMBAHKAN

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Mulai membaca data dari baris ke-2
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataMenara([
            'kode'         => $row[0],
            'provider'     => $row[1],
            'kelurahan'    => $row[2],
            'kecamatan'    => $row[3],
            'alamat'       => $row[4],
            'longitude'    => $row[5],
            'latitude'     => $row[6],
            'status'       => $row[7],
            'tinggi_tower' => $row[8],
        ]);
    }

    /**
     * DITAMBAHKAN: Aturan validasi untuk setiap kolom
     */
    public function rules(): array
    {
        return [
            '0' => 'required|string|unique:data_menara,kode', // Kode (harus unik di tabel data_menara)
            '1' => 'required|string', // Provider
            '2' => 'required|string', // Kelurahan
            '3' => 'required|string', // Kecamatan
            '4' => 'required|string', // Alamat
            '5' => 'required|numeric|between:-180,180', // Longitude (harus angka)
            '6' => 'required|numeric|between:-90,90', // Latitude (harus angka)
            '7' => 'required|string', // Status
            '8' => 'required|integer', // Tinggi Tower (harus angka bulat)
        ];
    }

    /**
     * DITAMBAHKAN: Pesan kustom jika validasi gagal
     */
    public function customValidationMessages()
    {
        return [
            '0.unique' => 'Kode menara sudah ada di database.',
            '5.numeric' => 'Longitude harus berupa angka.',
            '6.numeric' => 'Latitude harus berupa angka.',
            '8.integer' => 'Tinggi Tower harus berupa angka bulat.',
        ];
    }

    /**
     * DITAMBAHKAN: Lewati baris yang gagal
     */
    public function onFailure(Failure ...$failures)
    {
        // Biarkan kosong, kita akan tangani error di Controller
    }
}
